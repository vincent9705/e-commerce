<?php

namespace app\forms\back;

use Yii;
use yii\base\Model;
use app\models\Orders;
use app\models\OrdersDetails;
use app\models\Products;
use yii\data\ActiveDataProvider;
use yii\data\ArrayDataProvider;

class OrdersForm extends Model
{
	public $order_number;
	public $user_id;
	public $order_id;
	public $product_id;
	public $price;
	public $quantity;
	public $status;
	public $short_desc;
	public $order_date;

	public function rules()
	{
		return [
			[['order_number', 'user_id', 'order_id', 'product_id', 'price', 'quantity', 'status', 'short_desc', 'order_date'], 'safe'],
		];
	}

	public function attributeLabels()
	{
		return [
			'order_number' => 'Order Number',
			'user_id'      => 'User ID',
			'order_id'      => 'Oder ID',
			'product_id'   => 'Product ID',
			'price'        => 'Price',
			'quantity'     => 'Quantity',
			'status'       => 'Status',
			'short_desc'   => 'Short Desc',
		];
	}

	public function search()
	{
		$query = OrdersDetails::find()->where(['od.deleted_at' => null])->alias('od');
		$query->andFilterWhere(['like', 'od.status', $this->status])
			->leftJoin('orders as o', 'o.id = od.order_id')
			->leftJoin('products as p', 'p.id = od.product_id')
			->andFilterWhere(['like', 'p.short_desc', $this->short_desc])
			->andFilterWhere(['like', 'o.created_at', $this->order_date])
			->andFilterWhere(['od.price' => $this->price]);
		$query->select([
			'id'           => 'od.id',
			'order_number' => 'o.order_number',
			'user_id'      => 'o.user_id',
			'product_id'   => 'od.product_id',
			'short_desc'   => 'p.short_desc',
			'price'        => 'od.price',
			'quantity'     => 'od.quantity',
			'status'       => 'od.status',
			'order_date'   => 'DATE_FORMAT(o.created_at, "%Y-%m-%d")',
		]);
		$query->orderBy(['o.created_at' => SORT_DESC]);
		$query = $query->asArray()->all();

		$dataProvider = new ArrayDataProvider([
			'allModels' => $query,
			'sort' => [
				'attributes' => [
					'order_number',
					'user_id',
					'product_id',
					'short_desc',
					'price',
					'quantity',
					'status',
					'order_date'
				],
			],
		]);

		return $dataProvider;
	}

	public function setStatus($id, $status)
	{
		$model = OrdersDetails::find()->where(['id' => $id])->one();

		if (!empty($model))
		{
			$model->status = $status;
			$model->save(false);

			if (!$model->save(false))
				throw new \Exception(current($model->getFirstErrors()));
		}

		return $model;
	}
}
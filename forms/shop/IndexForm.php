<?php

namespace app\forms\shop;

use Yii;
use yii\base\Model;
use app\models\Products;
use app\models\Stocks;
use app\models\Cart;
use app\models\Orders;
use app\models\OrdersDetails;
use yii\data\ArrayDataProvider;

class IndexForm extends Model
{
	public $limit_per_page  = 6;
	public $page_no         = 1;
	public $total_pages     = 1;
	public $offset          = 1;
	public $date_from;
	public $date_to;

	public function rules()
	{
		return [
			[['limit_per_page', 'page_no', 'total_pages', 'offset', 'date_from', 'date_to'], 'safe']
		];
	}

	public function init()
	{
		parent::init();
		$begin_of_month = strtotime('first day of this month');
		$end_of_month   = strtotime('last day of this month');
		$this->date_from = date('Y-m-d', $begin_of_month);
		$this->date_to   = date('Y-m-d', $end_of_month);
	}

	public function attributeLabels()
	{
		return [
			
		];
	}

	public function displayProducts()
	{
		$this->getPageInfo();

		$model = Products::find()->where(['deleted_at' => null])
			->select([
				'id'    => 'id',
				'product_code' => 'product_code',
				'category'     => 'category',
				'short_desc'   => 'short_desc',
				'long_desc'    => 'long_desc',
				'price'        => 'price',
				'photo_url'    => 'photo_url',
				'stocks'       => '(SELECT SUM(s.quantity) - SUM(IF(od.quantity is null, 0, od.quantity)) FROM stocks AS s LEFT JOIN orders_details AS od ON s.product_id = od.product_id WHERE s.product_id = products.id and (od.status <> "cancel" or od.status is null))'
			])->limit($this->limit_per_page)->offset($this->offset)->asArray()->all();
		return $model;
	}

	public function getPageInfo()
	{
		$model_count = Products::find()->where(['deleted_at' => null])
			->select([
				'rows' => 'count(*)'
			])->asArray()->one();
		
		$total_rows        = (!empty($model_count)) ? $model_count['rows'] : 0;
		$this->total_pages = ceil($total_rows / $this->limit_per_page);
		$this->offset      = ($this->page_no - 1) * $this->limit_per_page; 
	}

	public function getCartCount()
	{
		$user_id = Yii::$app->user->id;
		$model  = Cart::find()->where(['deleted_at' => null, 'user_id' => $user_id])->select([
			'count' => 'count(*)'
		])->asArray()->one();
		$cart_count = (!empty($model)) ? $model['count'] : 0;

		return $cart_count;
	}

	public function addToCart($product_id)
	{
		//check stocks
		$connection = Yii::$app->getDb();
		$command    = $connection->createCommand('SELECT (SUM(s.quantity) - SUM(IF(od.quantity is null, 0, od.quantity))) AS stocks_count FROM stocks AS s LEFT JOIN orders_details AS od ON s.product_id = od.product_id WHERE s.product_id =' . $product_id .' and (od.status <> "cancel" or od.status is null)');

		$result       = $command->queryAll();
		$stocks_count = ($result[0]['stocks_count'] != null) ? $result[0]['stocks_count'] : 0;

		if ($stocks_count > 0)
		{
			$model = Cart::findOne(['deleted_at' => null, 'user_id' => Yii::$app->user->id, 'product_id' => $product_id ]);
			if (!empty($model))
			{
				$model->quantity = $model->quantity + 1;

				if(!$model->save())
					throw new \Exception(current($model->getFirstErrors()));
			}
			else
			{
				$new_model             = new Cart();
				$new_model->user_id    = Yii::$app->user->id;
				$new_model->product_id = $product_id;
				$new_model->quantity   = 1;
				$new_model->created_at = date('Y-m-d H:i:s');

				if (!$new_model->save())
					throw new \Exception(current($new_model->getFirstErrors()));
			}

			return true;//meaning success add to cart
		}
		else {
			return false;//meaning no stock can't add to cart
		}
	}

	public function getUserCartItems()
	{
		$model = Cart::find()->alias('c')->where(['c.deleted_at' => null, 'user_id' => Yii::$app->user->id])
			->leftJoin(['p' => 'products'], 'p.id = c.product_id')
			->select([
				'cart_id'    => 'c.id',
				'product_id' => 'p.id',
				'short_desc' => 'p.short_desc',
				'long_desc'  => 'p.long_desc',
				'price'      => 'p.price',
				'quantity'   => 'c.quantity',
				'photo_url'  => 'p.photo_url'
			])->asArray()->all();
		
		return $model;
	}

	public function cartIncrease($cart_id)
	{
		$cart_model    = Cart::findOne(['id' => $cart_id]);
		if (!empty($cart_model)){
			$product_model = Products::findOne(['id' => $cart_model->product_id]);
			$stocks        = $product_model->getStocks();

			if ($stocks > $cart_model->quantity) //have enough stocks
			{
				$cart_model->quantity = $cart_model->quantity + 1;

				if (!$cart_model->save())
					throw new \Exception(current($cart_model->getFirstErrors()));

				return true;
			}
			else {
				//not enough stocks
				return false;
			}
		}
	}

	public function cartDecrease($cart_id)
	{
		$cart_model    = Cart::findOne(['id' => $cart_id]);
		if (!empty($cart_model) && $cart_model->quantity > 1) {
			$cart_model->quantity = $cart_model->quantity - 1;

			if (!$cart_model->save())
				throw new \Exception(current($cart_model->getFirstErrors()));

			return true;
		}

		return false;
	}

	public function removeFromCart($cart_id)
	{
		$model = Cart::findOne(['id' => $cart_id])->delete();

		if ($model)
			return true;
		else 
			return false;
	}

	public function calCartSubTotal()
	{
		$sub_total = 0;

		$model = Cart::find()->alias('c')->where(['c.deleted_at' => null, 'user_id' => Yii::$app->user->id])
			->leftJoin(['p' => 'products'], 'p.id = c.product_id')
			->select([
				'product_total' => '(c.quantity * p.price)',
			])
			->groupBy(['p.id'])->asArray()->all();
		
		foreach ((array) $model as $value) {
			$sub_total += $value['product_total'];
		}
		
		return $sub_total;
	}

	public function checkOut()
	{
		//query out the cart products
		$cart_model = Cart::find()->alias('c')->where(['c.deleted_at' => null, 'user_id' => Yii::$app->user->id])
			->leftJoin(['p' => 'products'], 'p.id = c.product_id')
			->select([
				'product_id' => 'p.id',
				'price'      => 'p.price',
				'quantity'   => 'c.quantity',
			])
			->asArray()->all();
		
		//create orders
		$order_model = new Orders;
		$order_model->order_number = date("YmdHis");
		$order_model->user_id      = Yii::$app->user->id;
		$order_model->created_at   = date("Y-m-d H:i:s");

		if (!$order_model->save())
			throw new \Exception(current($order_model->getFirstErrors()));
		
		$order_id = $order_model->id;
	
		//create order details
		foreach ((array) $cart_model as $value) {
			$od_model = new OrdersDetails;
			$od_model->order_id   = $order_id;
			$od_model->product_id = $value['product_id'];
			$od_model->price      = $value['price'];
			$od_model->quantity   = $value['quantity'];
			$od_model->status     = 'new';
			$od_model->created_at = date("Y-m-d H:i:s");

			if (!$od_model->save())
				throw new \Exception(current($od_model->getFirstErrors()));
		}

		//delete cart base on the user id
		$model = Cart::findOne(['user_id' => Yii::$app->user->id])->deleteAll();

		return $model;
	}

	public function orderHistory()
	{
		$model = Orders::find()->alias('o')->where(['o.deleted_at' => null, 'user_id' => Yii::$app->user->id])
			->where(['>=' , 'DATE_FORMAT(o.created_at, "%Y-%m-%d")', $this->date_from])
			->where(['<=', 'DATE_FORMAT(o.created_at, "%Y-%m-%d")', $this->date_to])
			->leftJoin(['od' => 'orders_details'], 'od.order_id = o.id')
			->leftJoin(['p' => 'products'], 'p.id = od.product_id')
			->select([
				'product_id' => 'p.id',
				'short_desc' => 'p.short_desc',
				'long_desc'  => 'p.long_desc',
				'price'      => 'od.price',
				'quantity'   => 'od.quantity',
				'photo_url'  => 'p.photo_url',
				'status'     => 'od.status',
				'order_number' => 'o.order_number',
				'order_date'   => 'o.created_at'
			])->asArray()->all();
		
		return $model;
	}
}
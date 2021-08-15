<?php

namespace app\forms\back;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\data\ArrayDataProvider;
use yii\helpers\ArrayHelper;
use app\models\Admin;
use app\models\Products;
use app\models\Users;
use app\models\OrdersDetails;

class DashboardForm extends Model
{
	public $product_count;
	public $user_count;
	public $admin_count;
	public $completed_count;
	public $to_ship_count;
	public $cancelled_count;

	private $_admin = false;

	public function rules()
	{
		return [
			[['product_count', 'user_count', 'admin_count', 'completed_count', 'to_ship_count', 'cancelled_count'], 'safe'],
		];
	}

	public function attributeLabels()
	{
		return [
			
		];
	}

	public function getCount()
	{
		$query               = Products::find()->select('id')->where(['deleted_at' => null]);
		$this->product_count = $query->count();

		$query            = Users::find()->select('id')->where(['deleted_at' => null]);
		$this->user_count = $query->count();

		$query             = Admin::find()->select('id')->where(['deleted_at' => null]);
		$this->admin_count = $query->count();

		$query = OrdersDetails::find()
		->select([
			'completed' => 'COUNT(IF(status= "completed" AND deleted_at is null, 1, 0))',
			'to_ship'   => 'COUNT(IF(status= "to_ship" AND deleted_at is null, 1, 0))',
			'cancelled' => 'COUNT(IF(status= "cancelled" AND deleted_at is null, 1, 0))'
		])->asArray()->one();
		$this->completed_count = $query['completed'];
		$this->to_ship_count   = $query['to_ship'];
		$this->cancelled_count = $query['cancelled'];

	}
}
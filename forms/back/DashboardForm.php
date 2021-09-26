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
	public $new_count;

	private $_admin = false;

	public function rules()
	{
		return [
			[['product_count', 'user_count', 'admin_count', 'completed_count', 'to_ship_count', 'cancelled_count', 'new_count'], 'safe'],
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
			'new'       => 'SUM(case when status = "new" then 1 else 0 end)',
			'completed' => 'SUM(case when status = "completed" then 1 else 0 end)',
			'to_ship'   => 'SUM(case when status = "to_ship" then 1 else 0 end)',
			'cancelled' => 'SUM(case when status = "cancelled" then 1 else 0 end)'
		])->asArray()->one();
		$this->completed_count = (!empty($query['completed'])) ? $query['completed'] : 0;
		$this->to_ship_count   = (!empty($query['to_ship'])) ? $query['to_ship'] : 0;
		$this->cancelled_count = (!empty($query['cancelled'])) ? $query['cancelled'] : 0;
		$this->new_count       = (!empty($query['new'])) ? $query['new'] : 0;

	}
}
<?php

namespace app\forms\back;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\data\ArrayDataProvider;
use yii\helpers\ArrayHelper;
use app\models\Admin;

class LoginForm extends Model
{
	public $admin_id;
	public $user_name;
	public $password;
	
	private $_admin = false;

	public function rules()
	{
		return [
			[['admin_id'], 'safe'],
			[['user_name', 'password'], 'required'],
			['password', 'validatePassword'],
		];
	}

	public function attributeLabels()
	{
		return [
			'user_name' => Yii::t('app', 'User Name'),
			'password'  => Yii::t('app', 'Password'),
		];
	}

	public function validatePassword($attribute, $params)
	{
		if (!$this->hasErrors()) {
			$admin = $this->getAdmin();

			if (!$admin || !$admin->validatePassword($this->password)) {
				$this->addError($attribute, 'Incorrect username or password.');
			}
		}
	}

	/**
	 * Logs in a user using the provided username and password.
	 * @return bool whether the user is logged in successfully
	 */
	public function login()
	{
		if ($this->validate()) {
			return Yii::$app->admin->login($this->getAdmin(), false ? 3600*24*30 : 0);
		}
		return false;
	}

	/**
	 * Finds user by [[username]]
	 *
	 * @return User|null
	 */
	public function getAdmin()
	{
		if ($this->_admin === false) {
			$this->_admin = Admin::findByUsername($this->user_name);
		}

		return $this->_admin;
	}
}
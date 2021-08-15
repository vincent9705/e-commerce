<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "admin".
 *
 * @property int $id
 * @property string|null $user_name
 * @property string|null $password
 * @property string|null $email
 * @property string|null $last_login
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property string|null $deleted_at
 *
 * @property Products[] $products
 * @property Products[] $products0
 * @property Products[] $products1
 * @property Stocks[] $stocks
 * @property Stocks[] $stocks0
 * @property Stocks[] $stocks1
 */
class Admin extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
	/**
	 * {@inheritdoc}
	 */
	public static function tableName()
	{
		return 'admin';
	}

	/**
	 * {@inheritdoc}
	 */
	public function rules()
	{
		return [
			[['last_login', 'created_at', 'updated_at', 'deleted_at'], 'safe'],
			[['user_name', 'password', 'email'], 'string', 'max' => 255],
		];
	}

	/**
	 * {@inheritdoc}
	 */
	public function attributeLabels()
	{
		return [
			'id' => 'ID',
			'user_name' => 'User Name',
			'password' => 'Password',
			'email' => 'Email',
			'last_login' => 'Last Login',
			'created_at' => 'Created At',
			'updated_at' => 'Updated At',
			'deleted_at' => 'Deleted At',
		];
	}

	/**
	 * Gets query for [[Products]].
	 *
	 * @return \yii\db\ActiveQuery
	 */
	public function getProducts()
	{
		return $this->hasMany(Products::className(), ['created_by' => 'id']);
	}

	/**
	 * Gets query for [[Products0]].
	 *
	 * @return \yii\db\ActiveQuery
	 */
	public function getProducts0()
	{
		return $this->hasMany(Products::className(), ['deleted_by' => 'id']);
	}

	/**
	 * Gets query for [[Products1]].
	 *
	 * @return \yii\db\ActiveQuery
	 */
	public function getProducts1()
	{
		return $this->hasMany(Products::className(), ['updated_by' => 'id']);
	}

	/**
	 * Gets query for [[Stocks]].
	 *
	 * @return \yii\db\ActiveQuery
	 */
	public function getStocks()
	{
		return $this->hasMany(Stocks::className(), ['created_by' => 'id']);
	}

	/**
	 * Gets query for [[Stocks0]].
	 *
	 * @return \yii\db\ActiveQuery
	 */
	public function getStocks0()
	{
		return $this->hasMany(Stocks::className(), ['deleted_by' => 'id']);
	}

	/**
	 * Gets query for [[Stocks1]].
	 *
	 * @return \yii\db\ActiveQuery
	 */
	public function getStocks1()
	{
		return $this->hasMany(Stocks::className(), ['updated_by' => 'id']);
	}

		/**
	 * {@inheritdoc}
	 */
	public static function findIdentity($id)
	{
		$result = Admin::find()->where(['id' => $id])->one();

		return $result;
	}

	/**
	 * {@inheritdoc}
	 */
	public static function findIdentityByAccessToken($token, $type = null)
	{
		foreach (self::$users as $user) {
			if ($user['accessToken'] === $token) {
				return new static($user);
			}
		}

		return null;
	}

	/**
	 * Finds user by username
	 *
	 * @param string $username
	 * @return static|null
	 */
	public static function findByUsername($user_name)
	{
		$result = Admin::find()->where(['user_name' => $user_name])->one();

		return $result;
	}

	/**
	 * {@inheritdoc}
	 */
	public function getId()
	{
		return $this->id;
	}

	public function getUsername()
	{
		return $this->user_name;
	}

	/**
	 * {@inheritdoc}
	 */
	public function getAuthKey()
	{
		return "";
	}

	/**
	 * {@inheritdoc}
	 */
	public function validateAuthKey($authKey)
	{
		return $this->authKey === $authKey;
	}

	/**
	 * Validates password
	 *
	 * @param string $password password to validate
	 * @return bool if password provided is valid for current user
	 */
	public function validatePassword($password)
	{
		return $this->password === $password;
	}

	public function setLastLogin()
	{
		$result = Admin::find()->where(['id' => $this->id])->one();
		$result->last_login = date("Y-m-d H:i:s");

		if (!$result->save())
			throw new Exception($result->getFristError(), 1);
	}
}

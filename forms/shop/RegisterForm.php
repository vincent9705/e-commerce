<?php

namespace app\forms\shop;

use Yii;
use yii\base\Model;
use app\models\Users;

class RegisterForm extends Model
{
    public $user_name;
    public $password;
    public $confirm_password;
    public $email;

    public function rules()
    {
        return [
            [['user_name', 'password', 'confirm_password', 'email'], 'required'],
            [['user_name', 'password', 'confirm_password'], 'customValidation'],
            [['email'], 'email']
        ];
    }

    public function attributeLabels()
    {
        return [
            'user_name'        => Yii::t('app', 'User Name'),
            'password'         => Yii::t('app', 'Password'),
            'confirm_password' => Yii::t('app', 'Confirm Password'),
            'email'            => Yii::t('app', 'Email'),
        ];
    }

    public function customValidation($attribute, $params)
    {
        if ($this->password != $this->confirm_password && $attribute == "confirm_password")
            $this->addError($attribute, 'Password not match!');

        if ($attribute == "user_name")
        {
            $query = Users::findOne(['user_name' => $this->user_name]);
            
            if(!empty($query))
                $this->addError($attribute, 'This username has been taken!');
        }
    }

    public function register()
    {
        $model = new Users;
        $model->user_name  = $this->user_name;
        $model->password   = $this->password;
        $model->email      = $this->email;
        $model->created_at = date("Y-m-d H:i:s");

        if (!$model->save())
            throw new \Exception(current($model->getFirstErrors()));

        return $model;
    }
}

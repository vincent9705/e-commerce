<?php

namespace app\forms\shop;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\data\ArrayDataProvider;
use yii\helpers\ArrayHelper;
use app\models\Users;

class LoginForm extends Model
{
    public $user_id;
    public $user_name;
    public $password;
    public $rememberMe = true;
    
    private $_user = false;

    public function rules()
    {
        return [
            [['user_id'], 'safe'],
            [['user_name', 'password'], 'required'],
            ['password', 'validatePassword'],
            [['rememberMe'], 'safe'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'user_name' => Yii::t('app', 'User Name'),
            'password'  => Yii::t('app', 'Password'),
            'rememberMe'  => Yii::t('app', 'Remember Me'),
        ];
    }

    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();

            if (!$user || !$user->validatePassword($this->password)) {
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
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);
        }
        return false;
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = Users::findByUsername($this->user_name);
        }

        return $this->_user;
    }
}

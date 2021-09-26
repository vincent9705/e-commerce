<?php

namespace app\forms\shop;

use Yii;
use yii\base\Model;
use app\models\Users;

class ChangePasswordForm extends Model
{
    public $user_id;
	public $old_password;
    public $new_password;
    public $confirm_password;

	public function rules()
	{
		return [
			[['user_id', 'old_password', 'new_password', 'confirm_password'], 'required'],
            [['old_password', 'new_password', 'confirm_password'], 'customValidation']
		];
	}

	public function attributeLabels()
	{
		return [
            'user_id'      => Yii::t('app', 'User Id'),
            'old_password' => Yii::t('app', 'Old Password'),
            'new_password' => Yii::t('app', 'New Password'),
            'confirm_password' => Yii::t('app', 'Confirm Password'),
		];
	}

/*     public function customValidation($model, $attribute)
    {
        $query = Users::findOne($this->user_id);

        if ($query->password != $this->old_password)
            $this->addError($model, $this->old_password, 'Invalid old password!');

        if ($this->new_password != $this->confirm_password)
            $this->addError($model, $this->confirm_password, 'Password not match!');
    } */

    public function customValidation($attribute, $params)
    {
        $query = Users::findOne($this->user_id);

        if ($query->password != $this->old_password && $attribute == "old_password")
            $this->addError($attribute, 'Invalid old password!');

        if ($this->new_password != $this->confirm_password && $attribute == "confirm_password")
            $this->addError($attribute, 'Password not match!');
    }
    
    public function changePassword()
    {
        $model = Users::findOne($this->user_id);

        $model->password = $this->new_password;
        $model->save();

        return $model;
    }
}
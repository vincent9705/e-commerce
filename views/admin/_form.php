<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Admin */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="admin-form">

	<?= Html::a(Yii::t('app', 'Back'), ['index'], ['class' => 'btn btn-warning']) ?>
	<div style="margin-bottom: 20px"></div>

	<?php $form = ActiveForm::begin(); ?>

	<?= $form->field($model, 'user_name')->textInput(['maxlength' => true]) ?>

	<?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>

	<?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

	<?= $form->field($model, 'created_at')->textInput(['value' => date("Y-m-d H:i:s"), 'class' => 'hide'])->label(false) ?>

	<div class="form-group">
		<?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
	</div>

	<?php ActiveForm::end(); ?>

</div>

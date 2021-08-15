<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use kartik\widgets\FileInput;

/* @var $this yii\web\View */
/* @var $model app\models\Products */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="products-form">
	 <?= Html::a(Yii::t('app', 'Back'), ['index'], ['class' => 'btn btn-warning']) ?>
	<div style="margin-bottom: 20px"></div>

	<?php $form = ActiveForm::begin(); ?>

	<?= $form->field($model, 'product_code')->textInput(['maxlength' => true]) ?>

	<?= $form->field($model, 'category')->textInput(['maxlength' => true]) ?>

	<?= $form->field($model, 'short_desc')->textInput(['maxlength' => true]) ?>

	<?= $form->field($model, 'long_desc')->textarea(['rows' => 6]) ?>

	<?= $form->field($model, 'price')->textInput(['maxlength' => true, 'type' => 'number', 'value' => '0.00']) ?>

	<?= $form->field($model, 'photo_url')->widget(FileInput::classname(), [
		'options' => ['accept' => 'image/*'],
		'pluginOptions' => [
			'showPreview' => false,
			'showCaption' => true,
			'showRemove' => true,
			'showUpload' => false
		]
	]); ?>

	<?= $form->field($model, 'created_at')->textInput(['value' => date("Y-m-d H:i:s"), 'class' => 'hide'])->label(false) ?>

	<?= $form->field($model, 'created_by')->textInput(['value' => Yii::$app->admin->id, 'class' => 'hide'])->label(false) ?>

	<div class="form-group">
		<?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
	</div>

	<?php ActiveForm::end(); ?>

</div>

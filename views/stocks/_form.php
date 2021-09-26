<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use app\models\Products;
use yii\helpers\ArrayHelper;

	$query         = Products::find()->where(['deleted_at' => null])->asArray()->all();
	$products_data = ArrayHelper::map($query, 'id', 'short_desc');
?>

<div class="stocks-form">

	<?php $form = ActiveForm::begin(); ?>

	<?= //$form->field($model, 'product_id')->textInput()
		$form->field($model, 'product_id')->widget(Select2::classname(), [
			'data' => $products_data,
			'options' => ['placeholder' => 'Select a products ...'],
			'pluginOptions' => [
				'allowClear' => true
			],
		]); 
	?>

	<?= $form->field($model, 'quantity')->textInput(['maxlength' => true, 'type' => 'number']) ?>

	<?= $form->field($model, 'created_at')->textInput(['value' => date("Y-m-d H:i:s"), 'class' => 'hide'])->label(false) ?>

	<?= $form->field($model, 'created_by')->textInput(['value' => Yii::$app->admin->id, 'class' => 'hide'])->label(false) ?>

	<div class="form-group">
		<?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
	</div>

	<?php ActiveForm::end(); ?>

</div>
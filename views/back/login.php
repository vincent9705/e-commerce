<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Admin Login</title>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

	<link rel="stylesheet" href="../css/back/login.css">
</head>
<body>
	<div class="back-login col-md-12 container">

		<?php $form = ActiveForm::begin([
			'id' => 'login-form',
			'layout' => 'horizontal',
			'fieldConfig' => [
				'template' => "{label}\n<div class=\"col-md-12\">{input}</div>\n<div class=\"col-md-12\">{error}</div>",
				'labelOptions' => ['class' => 'col-md-8 control-label'],
			],
		]); ?>

			<div class="row">
				<div class="col-md-4"></div>

				<div class="col-md-4 wrapper">
					<h1 class="text-center">Admin Login</h1>
					<br>

					<?= $form->field($model, 'user_name')->textInput(['autofocus' => true]) ?>

					<?= $form->field($model, 'password')->passwordInput() ?>

					<div class="form-group">
						<div class="col-lg-offset-1 col-lg-11">
							<?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
						</div>
					</div>
				</div>
				<div class="col-md-4"></div>
			</div>

		<?php ActiveForm::end(); ?>
	</div>
</body>
</html>
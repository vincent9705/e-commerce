<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Register</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script src="../js/_register.js"></script>
    <link rel="stylesheet" href="../css/back/login.css">
    <link rel="stylesheet" href="../css/loading.css">
</head>

<body>
    <div class="back-login col-md-12 container">

        <?php $form = ActiveForm::begin([
            'id' => 'register-form',
            'layout' => 'horizontal',
            'fieldConfig' => [
                'template' => "{label}\n<div class=\"col-md-12\">{input}</div>\n<div class=\"col-md-12\">{error}</div>",
                'labelOptions' => ['class' => 'col-md-8 control-label'],
            ],
        ]); ?>

        <div class="row">
            <div class="col-md-4"></div>

            <div class="col-md-4 wrapper">
                <h1 class="text-center">E-Commerce Registration</h1>
                <br>

                <?= $form->field($model, 'user_name')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'password')->passwordInput() ?>

                <?= $form->field($model, 'confirm_password')->passwordInput() ?>

                <?= $form->field($model, 'email')->textInput() ?>

                <br />
                <div style="padding: 0 15px 0 15px">
                    <?= Html::submitButton('Register Now!', ['class' => 'btn btn-primary btn-block btn-flat btn-register', 'name' => 'register-button']) ?>
                </div>
            </div>
            <div class="col-md-4"></div>
        </div>
        <?php ActiveForm::end(); ?>

        <div id="form-loading" class="loading">
            <div class='uil-ring-css' style='transform:scale(0.79);'>
                <div></div>
            </div>
        </div>
    </div>
</body>

</html>
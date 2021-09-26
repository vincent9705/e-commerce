<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Alerts;

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
                <h1 class="text-center">Change Password</h1>
                <br>

                <?= $form->field($model, 'old_password')->passwordInput() ?>

                <?= $form->field($model, 'new_password')->passwordInput() ?>

                <?= $form->field($model, 'confirm_password')->passwordInput() ?>

                <br>

                <?= Html::submitButton('Confirm', ['class' => 'btn btn-primary btn-block btn-flat', 'name' => 'confirm-button']) ?>

            </div>
            <div class="col-md-4"></div>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</body>

</html>
<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;


$register_url = Url::to(['register']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>E-Commerce Login</title>

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
                <?= $this->render('@app/views/_template/_alert'); ?>

                <h1 class="text-center">E-Commerce Login</h1>
                <br>

                <?= $form->field($model, 'user_name')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'password')->passwordInput() ?>


                <div style="padding: 0 15px 0 15px">
                    <?= $form->field($model, 'rememberMe')->checkbox() ?>

                    <?= Html::submitButton('Sing in', ['class' => 'btn btn-primary btn-block btn-flat', 'name' => 'login-button']) ?>

                    <br />
                    <a href="<?= $register_url ?>" class="text-center">Register a new membership</a>
                </div>
            </div>
            <div class="col-md-4"></div>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</body>

</html>
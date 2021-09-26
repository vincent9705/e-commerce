<?php

use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AdminSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$css_url = Yii::getAlias('@web') . '/css/shop/css/';
$web_url = Yii::getAlias('@web');
$url_search =  Url::to(['order-history']);
?>



<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">

<head>
    <meta charset="<?= Yii::$app->charset ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>E-Commerce</title>

    <?= $this->render('navbar', ['cart_count' => $cart_count]); ?>

    <link rel="stylesheet" href="<?= $css_url ?>fontawesome.css">
    <link rel="stylesheet" href="<?= $css_url ?>templatemo-sixteen.css">
    <link rel="stylesheet" href="<?= $css_url ?>owl.css">
    <link rel="stylesheet" href="<?= $css_url ?>bootstrap.min.css">
    <link rel="stylesheet" href="<?= $web_url ?>/css/cart.css?v=202109121229">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <script src="<?= $web_url . '/js/_order_history.js' ?>"></script>

    <script type="text/javascript">
        var url_search = <?php echo json_encode($url_search); ?>;
        var date_from = <?php echo json_encode($date_from); ?>;
        var date_to = <?php echo json_encode($date_to); ?>;
    </script>
</head>

<body>
    <div class="col-md-12" style="padding-top: 30px; padding-left: 20px;">
        <label for="date-from" style="margin-right: 10px;">Date From:</label>
        <input type="date" id="date-from" name="date-from">

        <label for="date-to" style="margin-left: 50px; margin-right: 10px;">Date To:</label>
        <input type="date" id="date-to" name="date-to">

        <button type="button" class="btn btn-primary btn-search" style="margin-left:50px;">Search</button>
    </div>

    <div class="col-md-12" style="padding: 50px 20px 50px 20px;">
        <?php foreach ($items as $item) : ?>
            <?= $this->render('_history_item', ['item' => $item]); ?>
        <?php endforeach; ?>
    </div>

    <?php if (empty($items)) : ?>
        <div style="margin: 100px 0px 0px 0px;">
            <h3 style="text-align: center;">No record found</h3>
        </div>
    <?php endif ?>

</body>

</html>
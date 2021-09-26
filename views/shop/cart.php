<?php

use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AdminSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$css_url = Yii::getAlias('@web') . '/css/shop/css/';
$web_url = Yii::getAlias('@web');
$plus_url = Url::to(['cart-increase']);
$minus_url = Url::to(['cart-decrease']);
$remove_url = Url::to(['remove-from-cart']);
$calsub_url = Url::to(['cal-cart-sub-total']);
$checkout_url = Url::to(['check-out']);
$home_url = Url::to(['index']);
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
	<script src="<?= $web_url . '/js/_cart.js?v=202109121544' ?>"></script>

	<script type="text/javascript">
		var plus_url = <?php echo json_encode($plus_url); ?>;
		var minus_url = <?php echo json_encode($minus_url); ?>;
		var remove_url = <?php echo json_encode($remove_url); ?>;
		var calsub_url = <?php echo json_encode($calsub_url); ?>;
		var checkout_url = <?php echo json_encode($checkout_url); ?>;
		var home_url = <?php echo json_encode($home_url); ?>;
	</script>
</head>

<body>
	<?php if (!empty($items)) : ?>
		<div class="col-md-12" style="padding: 0 20px 50px 20px;">
			<?php foreach ($items as $item) : ?>
				<?= $this->render('_cart_item', ['item' => $item]); ?>
			<?php endforeach; ?>
		</div>

		<div class="col-md-12" style="padding: 20px 50px 150px 0px;">
			<div class="check-out-container">
				<h5 class="cart-sub-total"><b>Sub total:</b></h5>
				<div style="padding-top: 20px;">
					<button type="button" class="btn btn-success btn-check-out">Check Out</button>
				</div>
			</div>
		</div>
	<?php else : ?>
		<div style="margin: 100px 0px 0px 0px;">
			<h3 style="text-align: center;">No item in cart</h3>
		</div>
	<?php endif ?>
</body>

</html>
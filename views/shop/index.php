<?php

use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AdminSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$css_url = Yii::getAlias('@web') . '/css/shop/css/';
$web_url = Yii::getAlias('@web');
$url_change_page =  Url::to(['change-page']);
$url_add_cart    =  Url::to(['add-to-cart']);
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
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="<?= $web_url ?>/js/_pagination.js"></script>
	<script src="<?= $web_url ?>/js/_shop.js"></script>

	<script type="text/javascript">
		var url_change_page = <?php echo json_encode($url_change_page); ?>;
		var url_add_cart = <?php echo json_encode($url_add_cart); ?>;
		var current_page = <?php echo json_encode($current_page); ?>;
		var total_pages = <?php echo json_encode($total_pages); ?>;
	</script>
</head>

<body>
	<div class="col-md-12" style="padding-bottom: 30px;">
		<div class="filters-content">
			<div class="row grid" style="padding-top: 50px;">

				<?php foreach ($items as $item) : ?>
					<?= $this->render('_item', ['item' => $item]); ?>
				<?php endforeach; ?>
			</div>
		</div>

		<?= $this->render('_pagination', ['total_pages' => $total_pages, 'current_page' => $current_page]); ?>
	</div>

</body>

</html>
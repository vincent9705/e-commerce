<?php

use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AdminSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$css_url = Yii::getAlias('@web') . '/css/shop/css/';
$web_url = Yii::getAlias('@web');
$url_change_page =  Url::to(['change-page']);
$url_add_cart    =  Url::to(['add-to-cart']);
$url_login       =  Url::to(['login']);
$current_user    =  Yii::$app->user->identity;
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
		var current_user = <?php echo json_encode($current_user); ?>;
		var url_login = <?php echo json_encode($url_login); ?>;
	</script>
</head>

<body>
	<form action="" method="get" id="myForm">
		<div class="col-md-12 row" style="padding-top: 30px; padding-left: 20px;">
			<label for="category" style="margin:5px 10px 0px 10px;">Category:</label>
			<select class="form-control col-md-2" name="category" id="category">
				<option value="Others">Others</option>
				<?php foreach ($categories as $key => $category) : ?>
					<option value="<?= $key ?>"><?= $category ?></option>
				<?php endforeach; ?>
			</select>
			
			<button type="submit" class="btn btn-primary btn-search" style="margin-left:50px;">Search</button>
		</div>

		<div class="col-md-12" style="padding-bottom: 30px;">
			<div class="filters-content">
				<div class="row grid" style="padding-top: 50px;">

					<?php foreach ($items as $item) : ?>
						<?= $this->render('_item', ['item' => $item]); ?>
					<?php endforeach; ?>
				</div>
			</div>
			
			<?php if($total_pages > 0 ): ?>
				<?= $this->render('_pagination', ['total_pages' => $total_pages, 'current_page' => $current_page]); ?>
			<?php endif?>
		</div>
	</form>
</body>

</html>
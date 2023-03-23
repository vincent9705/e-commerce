<?php

use yii\helpers\Url;

$login_url  = Url::to(['shop/login']);
$logout_url = Url::to(['shop/logout']);
$change_password_url = Url::to(['change-password', 'user_id' => Yii::$app->user->id]);
$nav_css_url  = Yii::getAlias('@web') . '/css/';
$home_url     = Url::to(['shop/index']);
$cart_url     = Url::to(['shop/cart']);
$history_url  = Url::to(['shop/order-history']);
$web_url      = Yii::getAlias('@web');
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<title>Bootstrap Example</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="<?= $nav_css_url ?>nav.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

	
	
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">	
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
	
	<script src="<?= $web_url ?>/js/_nav.js"></script>
	<script type="text/javascript">
		var cart_count = <?php echo json_encode($cart_count); ?>;
	</script>
</head>

<body>

	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
		<h3 style="color: white; padding-right: 20px;">E-Commerce</h4>
			<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navb">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="navb">
				<ul class="navbar-nav mr-auto">
					<li class="nav-item">
						<a class="nav-link" href="<?= $home_url; ?>">Home</a>
					</li>
					<!-- <li class="nav-item">
						<a class="nav-link" href="javascript:void(0)">Link</a>
					</li>
					<li class="nav-item">
						<a class="nav-link disabled" href="javascript:void(0)">Disabled</a>
					</li> -->
				</ul>

				<ul class="navbar-nav pull-right">
					<?php if (Yii::$app->user->isGuest) : ?>
						<li class="nav-item">
							<a class="btn btn-success" href="<?= $login_url ?>">Login/ Sign Up</a>
						</li>
					<?php else : ?>
						<button type="button" class="btn btn-primary btn-cart" url="<?= $cart_url; ?>">
							<i class="fa fa-shopping-cart btn-cart" aria-hidden="true" url="<?= $cart_url; ?>"></i>
							Cart <span class="badge badge-light user-cart">0</span>
						</button>
						<h4 style="color: white; padding: 0 30px 0 30px">
							Welcome</a>
						</h4>

						<div class="btn-group">
							<button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<?= ucfirst(Yii::$app->user->identity->user_name) ?>
							</button>
							<div class="dropdown-menu dropdown-menu-right">
								<a class="dropdown-item btn" href="<?= $history_url ?>">Order History</a>
								<a class="dropdown-item btn btn-password" href="<?= $change_password_url ?>">Change Password</a>
								<a class="dropdown-item btn" href="<?= $logout_url ?>">Logout</a>
							</div>
						</div>
					<?php endif ?>
				</ul>

				<br />
				<br />
			</div>
	</nav>

</body>

</html>
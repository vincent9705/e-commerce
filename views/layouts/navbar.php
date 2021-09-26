<?php

use yii\helpers\Url;

$login_url = Url::to(['shop/login']);
$logout_url = Url::to(['shop/logout']);
$change_password_url = Url::to(['change-password', 'user_id' => Yii::$app->user->id]);
$nav_css_url = Yii::getAlias('@web') . '/css/';

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<title>Bootstrap Example</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?= $nav_css_url?>nav.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
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
						<a class="nav-link" href="javascript:void(0)">Link</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="javascript:void(0)">Link</a>
					</li>
					<li class="nav-item">
						<a class="nav-link disabled" href="javascript:void(0)">Disabled</a>
					</li>
				</ul>

				<ul class="navbar-nav pull-right">
					<?php if (Yii::$app->user->isGuest) : ?>
						<li class="nav-item">
							<a class="btn btn-success" href="<?= $login_url ?>">Login/ Sign Up</a>
						</li>
					<?php else : ?>
						<h4 style="color: white; padding-right: 30px">
							Welcome</a>
						</h4>

						<div class="btn-group">
							<button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<?= ucfirst(Yii::$app->user->identity->user_name) ?>
							</button>
							<div class="dropdown-menu dropdown-menu-right">
								<a class="dropdown-item btn" href="<?= $logout_url ?>">Order History</a>
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
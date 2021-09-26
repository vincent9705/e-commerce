<?php
use yii\bootstrap\Nav;

$user_image_url = Yii::getAlias('@web') .  '/img/admin.png';
?>
<aside class="main-sidebar">

	<section class="sidebar">

		<!-- Sidebar user panel -->
		<div class="user-panel">
			<div class="pull-left image">
				<img src=<?= $user_image_url ?> class="img-circle" alt="User Image"/>
			</div>
			<div class="pull-left info">
				<p><?= Yii::$app->admin->identity->username; ?></p>
				<a href="#"><i class="fa fa-circle text-success"></i> Online</a>
			</div>
		</div>
		
		<?=
		Nav::widget(
			[
				'encodeLabels' => false,
				'options' => ['class' => 'sidebar-menu'],
				'items' => [
					['label' => '<i class="fa fa-home"></i><span>Dashboard</span>', 'url' => ['/back/dashboard']],
					['label' => '<i class="fa fa-shopping-bag"></i><span>Products</span>', 'url' => ['/products']],
					['label' => '<i class="fa fa-sitemap"></i><span>Stocks</span>', 'url' => ['/stocks']],
					['label' => '<i class="fa fa-users"></i><span>Admin Users</span>', 'url' => ['/admin']],
					['label' => '<i class="fa fa-users"></i><span>Orders Management</span>', 'url' => ['/orders']],
					[
						'label' => '<i class="fa fa-sign-out"></i><span>Logout</span>', //for basic
						'url' => ['/back/logout'],
						'visible' => !Yii::$app->admin->isGuest
					],
				],
			]
		);
		?>
	</section>

</aside>

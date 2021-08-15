<?php
use yii\bootstrap\Nav;

?>
<aside class="main-sidebar">

	<section class="sidebar">

		<!-- Sidebar user panel -->
		<div class="user-panel">
			<div class="pull-left image">
				<img src="../img/admin.png" class="img-circle" alt="User Image"/>
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
					['label' => '<i class="fa fa-gift"></i><span>Products</span>', 'url' => ['/gii']],
					['label' => '<i class="fa fa-sitemap"></i><span>Stocks</span>', 'url' => ['/debug']],
					['label' => '<i class="fa fa-users"></i><span>Admin Users</span>', 'url' => ['/debug']],
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

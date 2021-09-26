<?php $this->title = "Dashboard"; ?>

<div class="row">
	<div class="col-lg-4 col-xs-6">
		<!-- small box -->
		<div class="small-box bg-aqua">
			<div class="inner">
				<h3><?= $model->product_count ?></h3>
				<p>Products</p>
			</div>
			<div class="icon">
				<i class="fa fa-shopping-bag"></i>
			</div>
		</div>
	</div>

	<div class="col-lg-4 col-xs-6">
		<!-- small box -->
		<div class="small-box bg-maroon">
			<div class="inner">
				<h3><?= $model->user_count ?></h3>
				<p>User Registrations</p>
			</div>
			<div class="icon">
				<i class="fa fa-user"></i>
			</div>
		</div>
	</div>

	<div class="col-lg-4 col-xs-6">
		<!-- small box -->
		<div class="small-box bg-teal">
			<div class="inner">
				<h3><?= $model->admin_count ?></h3>
				<p>Admin Registrations</p>
			</div>
			<div class="icon">
				<i class="fa fa-users"></i>
			</div>
		</div>
	</div>

	<div class="col-lg-4 col-xs-6">
		<!-- small box -->
		<div class="small-box bg-purple">
			<div class="inner">
				<h3><?= $model->new_count ?></h3>
				<p>New Orders</p>
			</div>
			<div class="icon">
				<i class="fa fa-cart-plus"></i>
			</div>
		</div>
	</div>

	<div class="col-lg-4 col-xs-6">
		<!-- small box -->
		<div class="small-box bg-green">
			<div class="inner">
				<h3><?= $model->completed_count ?></h3>
				<p>Completed Orders</p>
			</div>
			<div class="icon">
				<i class="fa fa-check-square-o"></i>
			</div>
		</div>
	</div>

	<div class="col-lg-4 col-xs-6">
		<!-- small box -->
		<div class="small-box bg-orange">
			<div class="inner">
				<h3><?= $model->to_ship_count ?></h3>
				<p>To Ship Orders</p>
			</div>
			<div class="icon">
				<i class="fa fa-plane"></i>
			</div>
		</div>
	</div>

	<div class="col-lg-4 col-xs-6">
		<!-- small box -->
		<div class="small-box bg-red">
			<div class="inner">
				<h3><?= $model->cancelled_count ?></h3>
				<p>Cancelled Orders</p>
			</div>
			<div class="icon">
				<i class="fa fa-ban"></i>
			</div>
		</div>
	</div>
</div>
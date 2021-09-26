<?php

$product_id = $item['id'];
$category   = $item['category'];
$short_desc = $item['short_desc'];
$long_desc  = $item['long_desc'];
$price      = $item['price'];
$photo_url  = Yii::getAlias('@web') . $item['photo_url'];
$stocks     = (isset($item['stocks'])) ? $item['stocks'] : 0;

?>

<div class="col-lg-4 col-md-4 all des">
	<div class="product-item">
		<a href="#"><img src="<?= $photo_url ?>" alt="" width="400px" height="250px"></a>
		<div class="down-content">
			<a href="#">
				<h4><?= $short_desc ?></h4>
			</a>
			<h6><?= number_format($price, 2) ?></h6>
			<p><?= $long_desc ?></p>

			<a class="btn btn-success btn-add-to-cart" product-id="<?= $product_id; ?>">Add To Cart</a>
			<span>Stocks <?= $stocks ?></span>
		</div>
	</div>
</div>

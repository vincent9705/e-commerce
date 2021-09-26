<?php

$product_id = $item['product_id'];
$short_desc = $item['short_desc'];
$long_desc  = $item['long_desc'];
$price      = $item['price'];
$quantity   = $item['quantity'];
$status     = $item['status'];
$order_number = $item['order_number'];
$order_date   = $item['order_date'];
$photo_url  = Yii::getAlias('@web') . $item['photo_url'];

?>

<div class="card" style="margin-top: 20px;">
    <div class=" grid-container">
        <img src="<?= $photo_url; ?>" alt="" width="400px" height="250px" class="cart-image">
        <div class="desc-container">
            <h4><b><?= $short_desc ?></b></h4>
            <p><?= $long_desc; ?></p>
        </div>

        <div class="">
            <h5><b>Order Number:</b> <?= $order_number ?></h5>
            <h5><b>Order Date:</b>  <?= $order_date ?></h5>
            <h5><b>Price:</b>  <?= number_format($price, 2) ?></h5>
            <h5><b>Quantity:</b>  <?= $quantity ?></h5>
            <h5><b>Status:</b>  <?= $status ?></h5>
        </div>

    </div>
</div>
<?php

$cart_id    = $item['cart_id'];
$product_id = $item['product_id'];
$short_desc = $item['short_desc'];
$long_desc  = $item['long_desc'];
$price      = $item['price'];
$quantity   = $item['quantity'];
$photo_url  = Yii::getAlias('@web') . $item['photo_url'];

?>

<div class="card" cart-id=<?= $cart_id; ?> style="margin-top: 20px;">
    <div class=" grid-container">
        <img src="<?= $photo_url; ?>" alt="" width="400px" height="250px" class="cart-image">
        <div class="desc-container">
            <h4><b><?= $short_desc ?></b></h4>
            <p><?= $long_desc; ?></p>
        </div>

        <div class="quantity-container">
            <a class="btn btn-danger btn-plus-minus btn-cart-minus" cart-id=<?= $cart_id; ?>>-</a>
            <span class="quantity-text"><?= $quantity; ?></span>
            <a class="btn btn-success btn-plus-minus btn-cart-plus" cart-id=<?= $cart_id; ?>>+</a>
        </div>

        <div class="delete-cart-container">
            <h4 class="text-center"><b><?= number_format($price, 2); ?></b></h4>
            <br>
            <button type="button" cart-id=<?= $cart_id; ?> class="btn btn-danger btn-delete-cart">Remove</button>
        </div>
    </div>
</div>
<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Products */

$this->title = Yii::t('app', 'Update Products: {name}', [
    'name' => $model->short_desc,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Products'), 'url' => ['/products/index']];
$this->params['breadcrumbs'][] = ['label' => $model->short_desc, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="products-update">

    <?= $this->render('_form_update', [
        'model' => $model,
    ]) ?>

</div>

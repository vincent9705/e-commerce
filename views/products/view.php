<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Products */

$this->title = $model->short_desc;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Products'), 'url' => ['/products/index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="products-view">

    <p>
        <?= Html::a(Yii::t('app', 'Back'), ['index'], ['class' => 'btn btn-warning']) ?>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'product_code',
            'category',
            'short_desc',
            'long_desc:ntext',
            'price',
            [
                'attribute'=>'photo_url',
                'value'    => Yii::getAlias('@web') . $model->photo_url,
                'format'   => ['image',['width'=>'200','height'=>'200']],
            ],
            'created_at',
            'updated_at',
            [
                'attribute' => 'created_by',
                'value' => function ($model) {
                    return  $model->getEditor($model->created_by);
                },
            ],
            [
                'attribute' => 'updated_by',
                'value' => function ($model) {
                    return  $model->getEditor($model->created_by);
                },
            ],
            //'created_by',
            //'updated_by',
        ],
    ]) ?>

</div>

<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Stocks;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProductsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Products');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="products-index">

	<h1><?= Html::encode($this->title) ?></h1>

	<p>
		<?= Html::a(Yii::t('app', 'Create Products'), ['create'], ['class' => 'btn btn-success']) ?>
	</p>

	<?php // echo $this->render('_search', ['model' => $searchModel]); ?>

	<?= GridView::widget([
		'dataProvider' => $dataProvider,
		'filterModel' => $searchModel,
		'columns' => [
			['class' => 'yii\grid\SerialColumn'],
			'product_code',
			'category',
			'short_desc',
			'long_desc:ntext',
			[
				'label' => 'Stocks',
				'value' => function ($model) {
					$query = Stocks::find([])->where(['deleted_at' => null, 'product_id' => $model->id])
					->select(['stocks' => 'sum(quantity)'])->asArray()->one();
					return ($query['stocks'] == null) ? 0 : $query['stocks'];
				}
			],
			['class' => 'yii\grid\ActionColumn'],
		],
	]); ?>


</div>

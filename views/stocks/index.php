<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\Search */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Stocks');
$this->params['breadcrumbs'][] = $this->title;

	/* function getShortDesc($id)
	{
		$query = Products::findOne(['id' => $id]);
		return $query->short_desc
	} */
?>
<div class="stocks-index">

	<h1><?= Html::encode($this->title) ?></h1>

	<p>
		<?= Html::a(Yii::t('app', 'Create Stocks'), ['create'], ['class' => 'btn btn-success']) ?>
	</p>

	<?php Pjax::begin(); ?>
	<?php // echo $this->render('_search', ['model' => $searchModel]); ?>

	<?= GridView::widget([
		'dataProvider' => $dataProvider,
		'filterModel' => $searchModel,
		'columns' => [
			['class' => 'yii\grid\SerialColumn'],
			'short_desc',
			'quantity',
			'created_at',
			'created_by',
			[
				'class'    => 'yii\grid\ActionColumn',
				'template' => '{delete}',
			],
		],
	]); ?>

	<?php Pjax::end(); ?>

</div>

<?php

use yii\helpers\Html;
use yii\grid\GridView;
use \yii\jui\DatePicker;
use yii\widgets\Pjax;
use yii\helpers\Url;

$this->title = Yii::t('app', 'Orders');
$this->params['breadcrumbs'][] = $this->title;

$this->registerJs($this->render('_script.js'));
?>
<div class="products-index">

	<h1><?= Html::encode($this->title) ?></h1>

	<?= $this->render('@app/views/_template/_alert'); ?>

	<p>
		<?= Html::a(Yii::t('app', 'Create Products'), ['create'], ['class' => 'btn btn-success']) ?>
	</p>

	<?php // echo $this->render('_search', ['model' => $searchModel]); 
	?>

	<?php Pjax::begin(['id' => 'pjax-orders']) ?>
	<?= GridView::widget([
		'dataProvider' => $dataProvider,
		'filterModel' => $searchModel,
		'columns' => [
			['class' => 'yii\grid\SerialColumn'],
			//'order_date',
			[
				'attribute' => 'order_date',
				'value'     => 'order_date',
				'filter'    => DatePicker::widget([
					'dateFormat' => 'yyyy-MM-dd',
					'model'      => $searchModel,
					'attribute'  => 'order_date',
				]),
				'format'        => 'html',
				'headerOptions' => ['style' => 'max-width:100px'],
			],
			'order_number',
			'short_desc',
			'price',
			'quantity',
			'status',
			[
				'attribute' => 'status',
				'value'  => function ($model) {
					if ($model['status'] == 'new')
						return 'New';
					else if ($model['status'] == 'to_ship')
						return 'To Ship';
					else if ($model['status'] == 'completed')
						return 'Completed';
					else if ($model['status'] == 'cancel')
						return 'Cancelled';
				},
			],
			//['class' => 'yii\grid\ActionColumn'],
			[
				'class' => yii\grid\ActionColumn::class,
				'template' => '<div class="btn-group align-bottom">{to_ship}{completed}{cancel}</div>',
				'buttons' => [
					// "Stop" Button
					'to_ship' => function ($url, $model) {
						if ($model['status'] == 'new') {
							return Html::a(
								Yii::t('app', 'To Ship'),
								false,
								[
									'url' => Url::to([
										'set-status',
										'id'     => base64_encode($model['id']),
										'status' => base64_encode('to_ship'),
									]),
									'class' => 'btn-set-to-ship btn btn-info btn-xs',
								]
							);
						}
					},	// End "To Ship" button
					'completed' => function ($url, $model) {
						if ($model['status'] == 'to_ship' || $model['status'] == 'new') {
							return Html::a(
								Yii::t('app', 'Completed'),
								false,
								[
									'url' => Url::to([
										'set-status',
										'id'     => base64_encode($model['id']),
										'status' => base64_encode('completed'),
									]),
									'class' => 'btn-set-completed btn btn-success btn-xs',
								]
							);
						}
					},	// End "Complted" button
					'cancel' => function ($url, $model) {
						if ($model['status'] == 'new' || $model['status'] == 'to_ship') {
							return Html::a(
								Yii::t('app', 'Cancel'),
								false,
								[
									'url' => Url::to([
										'set-status',
										'id'     => base64_encode($model['id']),
										'status' => base64_encode('cancel'),
									]),
									'class' => 'btn-set-cancel btn btn-danger btn-xs',
								]
							);
						}
					},	// End "calcel" button
				]
			],
		],
	]); ?>
	<?php Pjax::end() ?>


</div>
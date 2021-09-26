<?php

namespace app\controllers;

use Yii;
use app\models\Stocks;
use app\models\StocksSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class StocksController extends Controller
{
	public function init()
	{
		parent::init();
		$this->layout = 'admin_main';
	}

	public function behaviors()
	{
		return [
			'verbs' => [
				'class' => VerbFilter::className(),
				'actions' => [
					'delete' => ['POST'],
				],
			],
		];
	}

	public function actionIndex()
	{
		$searchModel  = new StocksSearch();
		$dataProvider = $searchModel->search(Yii::$app->request->queryParams);

		return $this->render('index', [
			'searchModel' => $searchModel,
			'dataProvider' => $dataProvider,
		]);
	}

	public function actionView($id)
	{
		return $this->render('view', [
			'model' => $this->findModel($id),
		]);
	}

	public function actionCreate()
	{
		$model = new Stocks();

		if ($model->load(Yii::$app->request->post()) && $model->save()) {
			return $this->redirect(['index']);
		}

		return $this->render('create', [
			'model' => $model,
		]);
	}

	public function actionUpdate($id)
	{
		$model = $this->findModel($id);

		if ($model->load(Yii::$app->request->post()) && $model->save()) {
			return $this->redirect(['view', 'id' => $model->id]);
		}

		return $this->render('update', [
			'model' => $model,
		]);
	}

	public function actionDelete($id)
	{
		$this->findModel($id)->delete();

		return $this->redirect(['index']);
	}

	protected function findModel($id)
	{
		if (($model = Stocks::findOne($id)) !== null) {
			return $model;
		}

		throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
	}
}

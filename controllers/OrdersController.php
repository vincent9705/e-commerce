<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\forms\back\OrdersForm;
use yii\web\Response;

class OrdersController extends Controller
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
		$searchModel  = new OrdersForm();
		$searchModel->load(Yii::$app->request->queryParams);
		$dataProvider = $searchModel->search();

		return $this->render('index', [
			'searchModel' => $searchModel,
			'dataProvider' => $dataProvider,
		]);
	}

	public function actionSetStatus($id, $status)
	{
		Yii::$app->response->format = Response::FORMAT_JSON;
		$model = new OrdersForm([]);

		try {
			$model->setStatus(base64_decode($id), base64_decode($status));
			return ['success' => $model];
		} catch (\Exception $e) {
			return ['error' => $e->getMessage()];
		}
	}
}
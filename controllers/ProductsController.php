<?php

namespace app\controllers;

use Yii;
use app\models\Products;
use app\models\ProductsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

class ProductsController extends Controller
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
		$searchModel = new ProductsSearch();
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
		$model = new Products();

		if ($model->load(Yii::$app->request->post()) && $model->save()) {				
			$this->uploadImg($model);		
			return $this->redirect(['view', 'id' => $model->id]);
		}

		return $this->render('create', [
			'model' => $model,
		]);
	}

	public function actionUpdate($id)
	{
		$model = $this->findModel($id);

		if ($model->load(Yii::$app->request->post()) && $model->save()) {
			$this->uploadImg($model);
			return $this->redirect(['view', 'id' => $model->id]);
		}

		return $this->render('update', [
			'model' => $model,
		]);
	}

	public function actionDelete($id)
	{
		$model             = $this->findModel($id);
		$model->deleted_at = date("Y-m-d H:i:s");

		if (!$model->save())
						throw new \Exception(current($model->getFirstErrors()));

		return $this->redirect(['index']);
	}

	protected function findModel($id)
	{
		if (($model = Products::findOne($id)) !== null) {
			return $model;
		}

		throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
	}

	protected function uploadImg($model)
	{
		$file = UploadedFile::getInstance($model, 'photo_url');

		if (!empty($file))
		{
			$directory = Yii::getAlias('@webroot' . '/img/products/') . $model->id . '.' . $file->extension;
			if ($file->saveAs($directory))
			{
				$query = Products::find()->where(['id' => $model->id])->one();
				$query->photo_url = '/img/products/' . $model->id . '.' . $file->extension;

				if (!$query->save())
					throw new \Exception(current($query->getFirstErrors()));
			}
		}
	}
}

<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\forms\back\LoginForm;
use app\forms\back\DashboardForm;

class BackController extends Controller
{
	public function init()
	{
		parent::init();
		$this->layout = 'admin_main';
	}

	public function actionIndex()
	{
		$model = new LoginForm();

		if ($model->load(Yii::$app->request->post()) && $model->login()) {
			Yii::$app->admin->identity->setLastLogin();
			return $this->redirect(['dashboard']);
		}

		return $this->renderPartial('login', [
			'model' => $model
		]);
	}

	public function actionDashboard()
	{
		if(Yii::$app->admin->isGuest)
			return $this->redirect(['index']);

		$model = new DashboardForm();
		$model->getCount();
		
		return $this->render('dashboard', [
			'model' => $model
		]);
	}

	public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->redirect(['index']);
    }
}

<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\RegisterForm;
use app\models\RegisterForm1;
use app\models\WalletForm;
use yii\helpers\Url;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionTest()
    {
        return $this->render('test');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        $registerUrl = Url::to('register1');
        return $this->render('login', [
            'model' => $model,
            'url' => $registerUrl
        ]);
    }

    public function actionRegister()
    {
        $message = '';
        $model = new RegisterForm();

        $request = Yii::$app->request->post();
        if ($model->load($request) &&  $model->validate())
        {
            $message = $model->register();
        }

        return $this->render('register', [
            'model' => $model,
            'message' => $message,
        ]);
    }

    public function actionRegister1()
    {
        $successfull_message = '';
        $model = new RegisterForm1();

        $request = Yii::$app->request->post();
        if ($model->load($request) &&  $model->validate())
        {
            $successfull_message = $model->register();
        }
        return $this->render('register', [
            'model' => $model,
            'message' => $successfull_message,
        ]);
    }
    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionDashboard()
    {
        $account1 = Yii::$app->user->identity;
        $walletForm = new WalletForm;
        $walletBalance = $walletForm->getBalance($account1->id);

        return $this->render('dashboard', [
            'account' => $account1,
            'walletBalance' => $walletBalance,
        ]);
    }
}

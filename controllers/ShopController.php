<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\forms\shop\LoginForm;
use app\forms\shop\ChangePasswordForm;
use app\forms\shop\RegisterForm;
use app\forms\shop\IndexForm;
use yii\widgets\ActiveForm;

class ShopController extends Controller
{
    public function init()
	{
		parent::init();
		$this->layout = false;
	}

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    
                ],
            ],
        ];
    }

    public function actionIndex($page_no = 1)
    {
        $model = new IndexForm();
        $model->page_no = $page_no;
        
        return $this->render('index', [
            'items'        => $model->displayProducts(),
            'total_pages'  => $model->total_pages,
            'current_page' => $model->page_no,
            'cart_count'   => $model->getCartCount(),
        ]);
    }

    public function actionLogin()
    {
        $model = new LoginForm();

        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            Yii::$app->user->identity->setLastLogin();
            return $this->redirect(['index']);
        }

        return $this->renderPartial('login', [
            'model' => $model
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->redirect(['index']);
    }

    public function actionChangePassword($user_id)
    {
        $model          = new ChangePasswordForm();
        $model->user_id = $user_id;

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->changePassword();
            return $this->redirect(['index']);
        }

        return $this->render('change_password', [
            'model'   => $model,
        ]);
    }

    public function actionRegister()
    {
        $model = new RegisterForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->register();
            Yii::$app->session->setFlash('success', "Successfully register.");
            return $this->redirect(['login']);
        }

        return $this->render('register', [
            'model'   => $model,
        ]);
    }

    public function actionChangePage($page_no = 1)
    {
        return $this->redirect(['index', 'page_no' => $page_no]);
    }

    public function actionAddToCart($product_id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $model  = new IndexForm();
        $status = $model->addToCart($product_id);

        if ($status)
            return ['success' => $model->getCartCount()];
        else
            return ['error'   => "Item is out of stock!"];
    }

    public function actionCart()
    {
        $model = new IndexForm();

        return $this->render('cart', [
            'items'      => $model->getUserCartItems(),
            'cart_count' => $model->getCartCount(),
        ]);
    }

    public function actionCartIncrease($cart_id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $model  = new IndexForm();
        $status = $model->cartIncrease($cart_id);

        if ($status)
            return ['success' => "Cart item quantity increase successfully"];
        else
            return ['error'   => "Item is not enough stocks"];
    }

    public function actionCartDecrease($cart_id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $model  = new IndexForm();
        $status = $model->cartDecrease($cart_id);

        if ($status)
            return ['success' => "Cart item quantity decrease successfully"];
        else
            return ['error'   => "Cart item quantity decrease failed"];
    }

    public function actionRemoveFromCart($cart_id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $model  = new IndexForm();
        $status = $model->removeFromCart($cart_id);

        if ($status)
            return ['success' => "Successfully remove from cart."];
        else
            return ['error'   => "Failed remove from cart."];
    }

    public function actionCalCartSubTotal()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $model     = new IndexForm();
        $sub_total = $model->calCartSubTotal();

        return ['success' => $sub_total];
    }

    public function actionCheckOut()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $model     = new IndexForm();
        $status    = $model->checkOut();

        if ($status)
            return ['success' => "Successfully check out"];
        else
            return ['error'   => "Failed to check out"];
    }

    public function actionOrderHistory($date_from = null, $date_to = null)
    {
        $model = new IndexForm();
        if ($date_from != null)
            $model->date_from = $date_from;
        
        if($date_to != null)
            $model->date_to   = $date_to;

        return $this->render('order_history', [
            'items'      => $model->orderHistory(),
            'cart_count' => $model->getCartCount(),
            'date_from'  => $model->date_from,
            'date_to'    => $model->date_to,
        ]);
    }
}
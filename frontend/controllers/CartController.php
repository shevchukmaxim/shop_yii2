<?php
/**
 * Created by PhpStorm.
 * User: Cyn4uk
 * Date: 05.08.2018
 * Time: 16:03
 */

namespace frontend\controllers;
use frontend\models\Cart;
use frontend\models\Order;
use frontend\models\OrderItems;
use common\models\Product;
use Yii;


class CartController extends AppController
{
    public function actionAdd()
    {
        $id = Yii::$app->request->get('id');
        $amount = Yii::$app->request->get('amount');

        $amount = !$amount ? 1 : $amount;

        $product = Product::findOne($id);
        if (empty($product)) {
            return false;
        }

        $session = Yii::$app->session;
        $session->open();

        $cart = new Cart();
        $cart->addToCart($product, $amount);

        //Если запрос пришел не через Ajax
        if (!Yii::$app->request->isAjax) {
            return $this->redirect(Yii::$app->request->referrer);
        }

        return $this->renderPartial('cart-modal', compact('session'));
    }

    public function actionClear()
    {
        $session = Yii::$app->session;
        $session->open();
        $session->remove('cart');
        $session->remove('cart.amount');
        $session->remove('cart.sum');

        return $this->renderPartial('cart-modal', compact('session'));
    }

    public function actionDelItem()
    {
        $id = Yii::$app->request->get('id');

        $session = Yii::$app->session;
        $session->open();

        $cart = new Cart();
        $cart->reCalculate($id);

        return $this->renderPartial('cart-modal', compact('session'));
    }

    public function actionShow()
    {
        $session = Yii::$app->session;
        $session->open();

        return $this->renderPartial('cart-modal', compact('session'));
    }

    public function actionView()
    {
        $session = Yii::$app->session;
        $session->open();

        $this->setMeta('Оформление заказа');
        $order = new Order();
        if ($order->load(Yii::$app->request->post())) {
            debug(Yii::$app->request->post());
        }

        return $this->render('view', compact('session', 'order'));
    }
}
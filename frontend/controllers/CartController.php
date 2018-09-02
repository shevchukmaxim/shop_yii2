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
            $order->amount = $session['cart.amount'];
            $order->sum = $session['cart.sum'];
            if ($order->save()) {
                $this->saveOrderItems($session['cart'], $order->id);
                Yii::$app->session->setFlash('success', 'Ваш заказ принят. Менеджер вскоре свяжется с вами.');
                $session->remove('cart');
                $session->remove('cart.amount');
                $session->remove('cart.sum');
                return $this->refresh();
            }else {
                Yii::$app->session->setFlash('error', 'Ошибка. Заказ не удался. Попробуйте снова.');
            }
        }

        return $this->render('view', compact('session', 'order'));
    }

    protected function saveOrderItems($items, $order_id)
    {
        foreach ($items as $id => $item) {
            $order_items = new OrderItems();
            $order_items->order_id = $order_id;
            $order_items->product_id = $id;
            $order_items->name = $item['name'];
            $order_items->price = $item['price'];
            $order_items->amount_item = $item['amount'];
            $order_items->sum_item = $item['amount'] * $item['price'];
            $order_items->save();
        }
    }
}
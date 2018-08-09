<?php
/**
 * Created by PhpStorm.
 * User: Cyn4uk
 * Date: 05.08.2018
 * Time: 16:04
 */

namespace frontend\models;



use yii\db\ActiveRecord;

class Cart extends ActiveRecord
{

    public function addToCart($product, $amount = 1)
    {
        if (isset($_SESSION['cart'][$product->id])) {
            $_SESSION['cart'][$product->id]['amount'] += $amount;
        }
        else {
            $_SESSION['cart'][$product->id] = [
                'amount' => $amount,
                'name' => $product->name,
                'price' => $product->price,
                'img' => $product->img
            ];
        };
        $_SESSION['cart.amount'] = isset($_SESSION['cart.amount']) ? $_SESSION['cart.amount'] + $amount : $amount;
        $_SESSION['cart.sum'] = isset($_SESSION['cart.sum']) ? $_SESSION['cart.sum'] + $amount * $product->price : $amount * $product->price;
    }

    public function reCalculate($id)
    {
        if (!isset($_SESSION['cart'][$id])) {
            return false;
        }

        $amountMinus = $_SESSION['cart'][$id]['amount'];
        $sumMinus = $_SESSION['cart'][$id]['amount'] * $_SESSION['cart'][$id]['price'];

        $_SESSION['cart.amount'] -= $amountMinus;
        $_SESSION['cart.sum'] -= $sumMinus;

        unset($_SESSION['cart'][$id]);
    }
}
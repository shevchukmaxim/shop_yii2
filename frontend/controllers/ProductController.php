<?php
/**
 * Created by PhpStorm.
 * User: Cyn4uk
 * Date: 22.07.2018
 * Time: 16:02
 */

namespace frontend\controllers;

use frontend\controllers;
use common\models\Category;
use common\models\Product;
use Yii;
use yii\web\HttpException;

class ProductController extends AppController {


    public function actionView($id)
    {
        $product = Product::findOne($id);

        if (empty($product)) {
            throw new HttpException(404, 'Данный товар не найден');
        }

        $hits = Product::find()->where(['hit' => '1'])->limit(6)->all();

        $this->setMeta('Интернет-магазин | ' . $product->name, $product->keywords, $product->description);

        return $this->render('view', compact('product', 'hits'));
    }
}
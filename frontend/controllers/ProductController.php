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

class ProductController extends AppController {


    public function actionView($id)
    {
        $id = Yii::$app->request->get('id');
        $product = Product::findOne($id);

        $this->setMeta('Интернет-магазин | ' . $product->name, $product->keywords, $product->description);

        return $this->render('view', compact('product'));
    }
}
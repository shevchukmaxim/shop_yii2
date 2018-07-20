<?php
/**
 * Created by PhpStorm.
 * User: Cyn4uk
 * Date: 20.07.2018
 * Time: 16:40
 */

namespace frontend\controllers;

use frontend\controllers;
use common\models\Category;
use common\models\Product;
use Yii;

class CategoryController extends AppController {

    public function actionIndex()
    {
        $hits = Product::find()->where(['hit' => '1'])->all();
        $this->setMeta('Интернет-магазин');

        return $this->render('index', compact('hits'));
    }

    public function actionView($id)
    {
        $id = Yii::$app->request->get('id');
        $products = Product::find()->where(['category_id' => $id])->all();
        $category = Category::findOne($id);
        $this->setMeta('Интернет-магазин | ' . $category->name, $category->keywords, $category->description);

        return $this->render('view', compact('products', 'category'));
    }
}
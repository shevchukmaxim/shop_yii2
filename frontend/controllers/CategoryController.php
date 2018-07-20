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

        return $this->render('index', compact('hits'));
    }
}
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
use yii\data\Pagination;

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
        $query = Product::find()->where(['category_id' => $id]);
        $count = $query->count();
        $pages = new Pagination(['totalCount' => $count, 'pageSize' => 3, 'forcePageParam' => false, 'pageSizeParam' => false]);
        $products = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        $category = Category::findOne($id);
        $this->setMeta('Интернет-магазин | ' . $category->name, $category->keywords, $category->description);

        return $this->render('view', compact('products', 'pages', 'category'));
    }
}
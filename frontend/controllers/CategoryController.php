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
use yii\web\HttpException;

class CategoryController extends AppController {

    public function actionIndex()
    {
        $hits = Product::find()->where(['hit' => '1'])->all();
        $this->setMeta('Интернет-магазин');

        return $this->render('index', compact('hits'));
    }

    public function actionView($id)
    {
        $category = Category::findOne($id);

        if (empty($category)) {
            throw new HttpException(404, 'Данная категория не найдена');
        }

        $query = Product::find()->where(['category_id' => $id]);
        $pages = new Pagination(['totalCount' => $query->count(), 'pageSize' => 3, 'forcePageParam' => false, 'pageSizeParam' => false]);
        $products = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        $this->setMeta('Интернет-магазин | ' . $category->name, $category->keywords, $category->description);

        return $this->render('view', compact('products', 'pages', 'category'));
    }

    public function actionSearch()
    {
        $search = trim(Yii::$app->request->get('search'));
        if (!$search) {
            return $this->render('search', compact('search'));
        }
        $query = Product::find()->andFilterWhere(['like', 'name', $search]);
        $pages = new Pagination(['totalCount' => $query->count(), 'pageSize' => 3, 'forcePageParam' => false, 'pageSizeParam' => false]);
        $products = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        $this->setMeta('Результаты поиска - ' . $search);

        return $this->render('search', compact('products', 'pages', 'search'));
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: Cyn4uk
 * Date: 20.07.2018
 * Time: 16:41
 */

namespace frontend\controllers;

use yii\web\Controller;

class AppController extends Controller {

    protected function setMeta($title = null, $keywords = null, $description = null)
    {
        $this->view->title = $title;
        $this->view->registerMetaTag(['name' => 'keywords', 'content' => "$keywords"]);
        $this->view->registerMetaTag(['name' => 'description', 'content' => "$description"]);
    }

}
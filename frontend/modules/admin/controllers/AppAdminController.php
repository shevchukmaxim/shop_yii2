<?php
/**
 * Created by PhpStorm.
 * User: Cyn4uk
 * Date: 11.09.2018
 * Time: 0:10
 */

namespace app\modules\admin\controllers;

use yii\web\Controller;
use yii\filters\AccessControl;


class AppAdminController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }
}
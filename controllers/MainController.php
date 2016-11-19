<?php

namespace usesgraphcrt\faq\controllers;

use usesgraphcrt\faq\Module;
use yii\web\Controller;
use Yii;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

class MainController extends Controller
{

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => $this->module->accessRoles,
                    ],
                ],
            ],
        ];
    }

    public function actionView()
    {
        return $this->render('view');
    }
}


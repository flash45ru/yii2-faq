<?php

namespace usesgraphcrt\faq\controllers;

use usesgraphcrt\faq\models\FaqCategory;
use usesgraphcrt\faq\models\search\FaqCategorySearch;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

class CategoryController extends Controller
{

    public $enableCsrfValidation = true;

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

    protected function deleteSubCategory($categoryId)
    {
        $subCategories = $this->findModel($categoryId)->getChilds()->all();
        $this->deleteCategoryQuestion($categoryId);
        $this->findModel($categoryId)->delete();
        foreach ($subCategories as $subCategory) {
            $this->deleteSubCategory($subCategory->id);
        }
    }

    protected function deleteCategoryQuestion($categoryId)
    {
        $categoryQuestions =$this->findModel($categoryId)->getFaq()->all();
        foreach ($categoryQuestions as $categoryQuestion){
            $categoryQuestion->delete();
        }
    }

    public function actionIndex()
    {
        $searchModel = new FaqCategorySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    public function actionCreate()
    {
        $model = new FaqCategory();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['update', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    public function actionDelete($id)
    {
        $this->deleteSubCategory($id);
        
        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {

        if (($model = FaqCategory::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested product does not exist.');
        }
    }
}

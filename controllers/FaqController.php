<?php

namespace usesgraphcrt\faq\controllers;

use usesgraphcrt\faq\models\FaqCategory;
use yii\web\Controller;
use Yii;
use usesgraphcrt\faq\models\Faq;
use usesgraphcrt\faq\models\search\FaqSearch;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

class FaqController extends Controller
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

    public function actions()
    {
        parent::actions();

        return [
            'image-upload' => [
                'class' => 'vova07\imperavi\actions\UploadAction',
                'url' => $this->module->imagesUrl, // Directory URL address, where files are stored.
                'path' => $this->module->imagesPath, // Or absolute path to directory where files are stored.
            ],
            'images-get' => [
                'class' => 'vova07\imperavi\actions\GetAction',
                'url' => $this->module->imagesUrl, // Directory URL address, where files are stored.
                'path' => $this->module->imagesPath, // Or absolute path to directory where files are stored.
                'type' => \vova07\imperavi\actions\GetAction::TYPE_IMAGES,
            ],
        ];
    }

    public function actionIndex()
    {
        $searchModel = new FaqSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCreate()
    {
        $model = new Faq();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    public function actionView($id)
    {

        $model = $this->findModel($id);
        
        return $this->render('view',[
           'model' => $model,
        ]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }
    
    public function actionList()
    {

        $categories = FaqCategory::find()->all();

        return $this->render('list',[
            'categories' => $categories,
        ]);
    }

    public function actionAjaxListView($id = null)
    {
        $model = $this->findModel($id);
        
        return $this->renderAjax('listView',[
            'model' => $model,
        ]);
    }
    
    public function actionAjaxSearchResult()
    {
        $searchText = yii::$app->request->post('data');
        $results = Faq::find()
            ->where('Match (title, text) AGAINST (:key IN BOOLEAN MODE)',[':key' => $searchText])
            ->limit(5)
            ->all();
        if  (empty($results)) {
            $results = Faq::find()->filterWhere(['like', 'title',$searchText])->orFilterWhere(['like', 'text',$searchText])->all();
        }

        return $this->renderAjax('_searchResult',[
                'searchText' => $searchText,
                'results' => $results,
            ]);
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        if (($model = Faq::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}


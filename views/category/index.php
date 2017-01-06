<?php
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use usesgraphcrt\faq\models\FaqCategory;
use usesgraphcrt\faq\Module;
use yii\grid\GridView;

$this->title = 'Категории';
$this->params['breadcrumbs'][] = ['label' => Module::t('faq', 'Main Menu'), 'url' => \yii\helpers\Url::to(['main/view'])];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="category-index">
    <div class="row">
        <div class="col-md-2">
            <?= Html::a('Создать категорию', ['create'], ['class' => 'btn btn-success']) ?>
        </div>
    </div>

    <br style="clear: both;">
    <ul class="nav nav-pills">
        <li role="presentation" <?php if(yii::$app->request->get('view') == 'tree' | yii::$app->request->get('view') == '') echo ' class="active"'; ?>><a href="<?=Url::toRoute(['category/index', 'view' => 'tree']);?>">Деревом</a></li>
        <li role="presentation" <?php if(yii::$app->request->get('view') == 'list') echo ' class="active"'; ?>><a href="<?=Url::toRoute(['category/index', 'view' => 'list']);?>">Списком</a></li>
    </ul>
    <br style="clear: both;">
    <?php
    if(isset($_GET['view']) && $_GET['view'] == 'list') {
        $categories = \kartik\grid\GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                ['attribute' => 'id', 'filter' => false, 'options' => ['style' => 'width: 55px;']],
                'name',
                [
                    'attribute' => 'parent_id',
                    'filter' => Html::activeDropDownList(
                        $searchModel,
                        'parent_id',
                        FaqCategory::buildTextTree(),
                        ['class' => 'form-control', 'prompt' => 'Категория']
                    ),
                    'value' => 'parent.name'
                ],
                ['class' => 'yii\grid\ActionColumn', 'template' => '{update} {delete}',  'buttonOptions' => ['class' => 'btn btn-default'], 'options' => ['style' => 'width: 125px;']],
            ],
        ]);
    } else {
        $categories = \pistol88\tree\widgets\Tree::widget(['model' => new \usesgraphcrt\faq\models\FaqCategory(),'viewUrl' => 'faq/listView']);
    }

    echo $categories;
    ?>

</div>

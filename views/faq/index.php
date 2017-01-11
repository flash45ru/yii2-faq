<?php

use yii\helpers\Html;
use yii\grid\GridView;
use usesgraphcrt\faq\models\FaqCategory;
use usesgraphcrt\faq\Module;
use yii\helpers\StringHelper;

\usesgraphcrt\faq\assets\FaqAsset::register($this);


$this->title = Module::t('faq', 'FAQ');
$this->params['breadcrumbs'][] = ['label' => Module::t('faq', 'Main Menu'), 'url' => \yii\helpers\Url::to(['main/view'])];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="faq-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Module::t('faq', 'Create'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'options' => ['class' => 'test'],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
           // 'category_id',
            [
                'attribute' => 'category_id',
                'filter' => Html::activeDropDownList(
                    $searchModel,
                    'category_id',
                    FaqCategory::buildTextTree(),
                    ['class' => 'form-control', 'prompt' => 'Категория']
                ),
                'format' => 'raw',
                'value' => function($model){ return $model->getFaqCategory()->one()->name;},
            ],
            'title',
            [
                'attribute' => 'text',
                'format' => 'html',
                'options' => ['class' => 'faq-text-td'],
                'value' => function ($model) {
                    return StringHelper::truncate($model->text, 75);
                }
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete}',
                'buttonOptions' => ['class' => 'btn btn-default'],
                'options' => ['style' => 'width: 125px;']
            ],
        ],
    ]); ?>

</div>

<?php

use yii\helpers\Html;
use yii\grid\GridView;
use usesgraphcrt\faq\models\Faq;
use usesgraphcrt\faq\Module;

\usesgraphcrt\faq\assets\FaqAsset::register($this);
/* @var $this yii\web\View */
/* @var $searchModel usesgraphcrt\faq\models\search\FaqSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Module::t('faq', 'FAQ');
$this->params['breadcrumbs'][] = ['label' => Module::t('faq', 'Main Menu'), 'url' => \yii\helpers\Url::to(['main/view'])];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="faq-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Module::t('faq', 'Create'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'options' => ['class' => 'test'],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'faq_category_id',
            'faq_title',
            [
                'attribute' => 'faq_text',
                'format' => 'raw',
                'options' => ['class' => 'faq-text-td'],
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

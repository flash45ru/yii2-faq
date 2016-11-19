<?php

use yii\helpers\Html;
use yii\grid\GridView;
use usesgraphcrt\faq\models\Faq;
use usesgraphcrt\faq\Module;

/* @var $this yii\web\View */
/* @var $searchModel usesgraphcrt\faq\models\search\FaqSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Module::t('faq', 'FREQUENTLY_ASKED_QUESTIONS');
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
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'faq_category_id',
            'faq_title',
            [
                'attribute' => 'faq_text',
                'format' => 'raw',
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

<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use usesgraphcrt\faq\models\Faq;
use usesgraphcrt\faq\Module;

/* @var $this yii\web\View */
/* @var $model usesgraphcrt\faq\models\Faq */

$this->title = $model->faq_title;
$this->params['breadcrumbs'][] = ['label' => Module::t('faq', 'FREQUENTLY_ASKED_QUESTIONS'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="faq-view">
    <div class="container fluid">
        <div class="col-md-12" >
            <?= \usesgraphcrt\faq\widgets\FaqWidget\FaqWidget::widget() ?>
        </div>
        <div class="row">
            <div class="col-md-8 panel panel-default">
                <h1><?= Html::encode($this->title) ?></h1>
                <?= $model->faq_text ?>
            </div>
        </div>
    </div>
</div>

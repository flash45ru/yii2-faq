<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use usesgraphcrt\faq\Module;

/* @var $this yii\web\View */
/* @var $model usesgraphcrt\faq\models\Faq */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Module::t('faq', 'FAQ'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="faq-view">
    <div class="container fluid">
        <div class="row">
            <div class="col-md-4" >
                <?= \usesgraphcrt\faq\widgets\FaqWidget\FaqWidget::widget() ?>
            </div>
            <div class="col-md-8 panel panel-default">
                <h1><?= Html::encode($this->title) ?></h1>
                <?= $model->text ?>
            </div>
        </div>
    </div>
</div>

<?php

use yii\helpers\Html;
use usesgraphcrt\faq\Module;

/* @var $this yii\web\View */
/* @var $model usesgraphcrt\faq\models\Faq */

$this->title = Module::t('faq', 'Update') . ' ' . $model->faq_title;
$this->params['breadcrumbs'][] = ['label' => Module::t('faq', 'FREQUENTLY_ASKED_QUESTIONS'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->faq_title, 'url' => ['view', 'id' => $model->faq_id]];
$this->params['breadcrumbs'][] = Module::t('faq', 'Update');
?>
<div class="faq-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php

use yii\helpers\Html;
use usesgraphcrt\faq\Module;

/* @var $this yii\web\View */
/* @var $model usesgraphcrt\faq\models\Faq */

$this->title = Module::t('faq', 'Update') . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => Module::t('faq', 'Main Menu'), 'url' => \yii\helpers\Url::to(['main/view'])];
$this->params['breadcrumbs'][] = ['label' => Module::t('faq', 'FAQ'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Module::t('faq', 'Update');
?>
<div class="faq-update">

    <h2><?= Html::encode($this->title) ?></h2>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

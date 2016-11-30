<?php
use yii\helpers\Html;
use usesgraphcrt\faq\Module;

$this->title = 'Обновить категорию: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Module::t('faq', 'Main Menu'), 'url' => \yii\helpers\Url::to(['main/view'])];
$this->params['breadcrumbs'][] = ['label' => 'Категории', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Обновить';
?>
<div class="category-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>

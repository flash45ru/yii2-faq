<?php


use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap\Button;
use usesgraphcrt\faq\Module;

$this->title = 'Редактирование инструкции';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="faq-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <div class="well">Здесь Вы можете добавлять пометки в инструкцию по работе в Вашей системе. Не забывайте уведомить менеджера компании "Dvizh", что необходимо внести изменения в данную инструкцию после проведения любых работ по развитию Вашей системы.</div>
    <?= Button::widget([
        'label' => 'Управление категориями',
        'options' => [
            'class' => 'btn-lg btn-primary',
            'style' => 'margin:5px',
            'href' => \yii\helpers\Url::to(['../faq/category/index']),
        ],
        'tagName' => 'a'
    ]); ?>
    <?= Button::widget([
        'label' => 'Управление вопросами',
        'options' => [
            'class' => 'btn-lg btn-primary',
            'style' => 'margin:5px',
            'href' => \yii\helpers\Url::to(['../faq/faq/index']),
        ],
        'tagName' => 'a',
    ]);
    ?>
</div>
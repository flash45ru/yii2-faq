<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap\Button;
use usesgraphcrt\faq\Module;

$this->title = 'Управление модулем FAQ';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="faq-view">

    <h1><?= Html::encode($this->title) ?></h1>

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
    <div class="alert alert-info">
        Для вывода виджета FAQ: <pre>echo \usesgraphcrt\faq\widgets\FaqWidget\FaqWidget::widget();</pre>
    </div>
</div>
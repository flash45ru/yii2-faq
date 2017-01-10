<?php
use usesgraphcrt\faq\Module;
use yii\helpers\StringHelper;
//\usesgraphcrt\faq\assets\FaqAsset::register($this);
 $this->registerJs("
     $('[data-role=faq-re-load]').on('click',function () {
        usesgraphcrt.faq.load($(this).data('url'));
    });
 ");
?>
<div class="well">
    <span class="alert alert-info">
        <?= Module::t('faq','Search results by query:');?>
         <b>"<?= $searchText ?>"</b>
    </span>
    <?php foreach ($results as $result){ ?>
                <h3 class="text-info">
                    <a class="panel-content" data-role="faq-re-load"
                       data-url="<?= \yii\helpers\Url::to(['faq/ajax-list-view', 'id' => $result->id]) ?>">
                        <?= StringHelper::truncate($result->title, 80) ?>
                    </a>
                </h3>
        <hr>
                <?= StringHelper::truncate($result->text, 120) ?>
    <?php }
    ?>
</div>

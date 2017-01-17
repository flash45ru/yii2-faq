<?php
use usesgraphcrt\faq\Module;
use yii\helpers\StringHelper;

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
    <hr>
    <?php if (!empty($results)) { ?>
        <?php foreach ($results as $result) { ?>
            <h3 class="text-info">
                <a class="panel-content" data-role="faq-re-load"
                   data-url="<?= \yii\helpers\Url::to(['faq/ajax-list-view', 'id' => $result->id]) ?>">
                    <?= StringHelper::truncate(preg_replace("#($searchText)#iu", "<span style='background-color: rgb(255, 153, 153);'>$1</span>", $result->title), 150) ?>
                </a>
            </h3>
            <hr>
            <?= StringHelper::truncate(preg_replace("#($searchText)#iu", "<span style='background-color: rgb(255, 153, 153);'>$1</span>", $result->text), 120) ?>
        <?php }
    } else { ?>
        <div class="alert alert-danger">
            Ничего не найдено.
        </div>
    <?php }
    ?>
</div>

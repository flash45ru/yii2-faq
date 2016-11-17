<?php

use usesgraphcrt\faq\Module;


if ($title) {
    $this->title = $title;
}
if ($breadcrumbs) {
    $this->params['breadcrumbs'][] = $breadcrumbs;
}
$faq_id = $id ? $id : 0;
?>
<?php if ($models):?>
    <div class="panel-group" id="accordion">
        <?php foreach ($models as $model) :?>
            <!-- Panel -->
            <div class="panel panel-default">
                <!-- Header -->
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse_faq_<?=$model['faq_id']?>"><?= $model['faq_title']?></a>
                    </h4>
                </div>
                <div id="<?= 'collapse_faq_'.$model['faq_id'];?>" class="panel-collapse collapse <?= $faq_id == $model['faq_id'] ? 'in' : '';?>">
                    <!-- Content -->
                    <div class="panel-body">
                        <p><?= $model['faq_text']?></p>
                    </div>
                </div>
            </div>
        <?php endforeach;?>
    </div>
<?php else:?>
    <h4><?= Module::t('faq', 'NO_DATA'); ?></h4>
<?php endif; ?>



<?php

use usesgraphcrt\faq\Module;
use yii\bootstrap\Button;

if ($title) {
    $this->title = $title;
}
if ($breadcrumbs) {
    $this->params['breadcrumbs'][] = $breadcrumbs;
}
$faq_id = $id ? $id : 0;
?>
<?php if ($categories):?>
<div class="row">
    <div class="col-lg-4 col-sm-4">
        <div class="panel-group" id="accordion">
            <?php foreach ($categories as $category) :?>
                <?php if (!empty($category->getFaq()->all())) { ?>
                    <!-- Panel -->
                    <div class="panel panel-info">
                        <!-- Header -->
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse_category_<?=$category['id']?>"><?= $category['name']?></a>
                            </h4>
                        </div>
                        <div id="<?= 'collapse_category_'.$category['id'];?>" class="panel-collapse collapse <?= $faq_id == $category['id'] ? 'in' : '';?>">
                            <!-- Content -->
                            <div class="panel-body">
                                <?php
                                foreach ($category->getFaq()->all() as $model){
                                    echo Button::widget([
                                        'label' => $model->faq_title,
                                        'options' => [
                                            'class' => 'btn btn-link',
                                            'style' => 'margin:5px',
                                            'href' =>  \yii\helpers\Url::to(['../faq/faq/view', 'id' => $model->faq_id]),
                                            'target' => '_blank',
                                        ],
                                        'tagName' => 'a',
                                    ]);
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            <?php endforeach;?>
        </div>
        <?php else:?>
            <h4><?= Module::t('faq', 'NO_DATA'); ?></h4>
        <?php endif; ?>
    </div>
</div>




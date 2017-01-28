<?php

use usesgraphcrt\faq\Module;
use usesgraphcrt\faq\helpers\RenderTreeHelper;

\usesgraphcrt\faq\assets\FaqAsset::register($this);

$this->title = Module::t('faq', 'Instruction list');
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="faq-view">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="form form-inline" role="search">
                        <div class="input-group">
                            <input type="text" class="form-control" data-role="search-text">
                        </div>
                        <div class="input-group">
                            <button type="button" class="btn btn-search btn-default usesgraphcrt-faq-search"
                                    data-url="#<?= \yii\helpers\Url::to(['faq/ajax-search-result']) ?>">
                                <span class="glyphicon glyphicon-search"></span>
                            </button>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-3 faq-menu">
                <div class="row">
                    <div class="panel-group" id="accordion">
                        <div class="hidden" data-role="settings" data-url="<?=\yii\helpers\Url::to(['/faq/faq']) ?>"></div>
                        <?php
                        if ($categories) {
                            foreach ($categories as $category) {
                                if (!empty($category->getFaq()->orderBy(['sort' => SORT_DESC])->all()) || !empty($category->getChilds()->all())) {
                                    echo RenderTreeHelper::renderTree($category);
                                }
                            }
                            ?>
                        <?php } else {?>
                            <h4><?= Module::t('faq', 'NO_DATA'); ?></h4>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <div class="faq-view col-md-9" data-role="faq-view">

            </div>
        </div>
    </div>
</div>

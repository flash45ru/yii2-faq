<?php

use usesgraphcrt\faq\Module;

\usesgraphcrt\faq\assets\FaqAsset::register($this);

$this->title = Module::t('faq', 'Instruction list');
$this->params['breadcrumbs'][] = $this->title;
 function renderChildren($category){
     $return ='';
     $return .= '<div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion'.$category['id'].'" href="#collapse'.$category['id'].'">'.$category['name'].'</a>
                    </h4>
                </div>
                <div id="collapse'.$category['id'].'" class="panel-collapse collapse">
                    <div class="panel-body">';
                        if(!empty($category['childs'])) {
                            foreach ($category['childs'] as $subCategory){
                                $return .=renderChildren($subCategory);
                            }
                        };
                        $return .= '<ul class="nav nav-pills nav-stacked">';
                            foreach ($category->getFaq()->all() as $faq) {
                                $return .= '<li>
                                    <a class="panel-content" data-role="faq-load"
                                       data-url="' . \yii\helpers\Url::to(['faq/ajax-list-view', 'id' => $faq->id]) . '">' . $faq->title . '
                                    </a>
                                </li>';
                            }
                       $return .='</ul>
                    </div>
                </div>
            </div>';

     return $return;
 }
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
                                    data-url="<?= \yii\helpers\Url::to(['faq/ajax-search-result']) ?>">
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
                        <?php
                        if ($categories) {
                            foreach ($categories as $category) {
                                echo renderChildren($category);
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

<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use usesgraphcrt\faq\models\Faq;
use usesgraphcrt\faq\Module;
use yii\bootstrap\Button;

\usesgraphcrt\faq\assets\FaqAsset::register($this);

$this->title = $model->faq_title;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="faq-view">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2 mini-menu">
                <ul>
                    <?php
                    if (!empty($categories)) :
                        foreach ($categories as $category) {
                            if (!empty($category->getFaq()->all())) {
                                ?>
                                <li class="sub">
                                    <a href="#"><?= $category->name ?></a>
                                    <ul>
                                        <?php
                                        foreach ($category->getFaq()->all() as $faq) { ?>
                                            <li><a class="btn" data-role="faq-load"
                                                   data-url="<?= \yii\helpers\Url::to(['faq/ajax-list-view', 'id' => $faq->faq_id]) ?>"><?= $faq->faq_title ?></a>
                                            </li>
                                            <?php
                                        }
                                        ?>
                                    </ul>
                                </li>
                                <?php
                            }
                        }
                        ?>
                    <?php else:?>
                        <h4><?= Module::t('faq', 'NO_DATA'); ?></h4>
                    <?php endif; ?>
                </ul>
            </div>
            <div class="col-md-10" data-role="faq-view">

            </div>
        </div>
    </div>
</div>



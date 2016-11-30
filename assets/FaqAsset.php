<?php

namespace usesgraphcrt\faq\assets;

use yii\web\AssetBundle;

class FaqAsset extends AssetBundle
{
    public $depends = [
        'yii\web\JqueryAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];

    public $js = [
        'js/faq.js',
    ];

    public $css = [
        'css/slyles.css',
    ];

    public function init()
    {
        $this->sourcePath = __DIR__ . '/../web';
        parent::init();
    }
}
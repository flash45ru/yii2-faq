<?php

namespace usesgraphcrt\faq\widgets\FaqWidget;

use usesgraphcrt\faq\models\Faq;
use usesgraphcrt\faq\models\FaqCategory;
use yii\bootstrap\Widget;

class FaqWidget extends Widget
{
    /**
     * @var bool|int if id defined then this FAQ will be opened
     */
    public $id = false;//faq_id open by default

    /**
     * @var bool|string title for FAQ page
     */
    public $title = false;

    /**
     * @var bool|string breadcrumbs for FAQ page
     */
    public $breadcrumbs = false;

    /**
     * @var string path to your view
     */
    public $viewPath = 'faq_list';


    public function run()
    {
        $categories = FaqCategory::find()->all();
        $models = Faq::find()->asArray()->all();
        return $this->render($this->viewPath, [
            'models' => $models,
            'categories' => $categories,
            'id' => $this->id,
            'title' => $this->title,
            'breadcrumbs' => $this->breadcrumbs,
        ]);
    }
}
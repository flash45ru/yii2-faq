<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use usesgraphcrt\faq\models\Faq;
use usesgraphcrt\faq\Module;
use usesgraphcrt\faq\models\FaqCategory;

/* @var $this yii\web\View */
/* @var $model usesgraphcrt\faq\models\Faq */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="faq-form ">
    <div class="col-md-12">
        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

        <?=
        $form->field($model, 'text')->widget(\vova07\imperavi\Widget::className(), [
            'settings' => [
                'lang' => Yii::$app->controller->module->imperaviLanguage,
                'minHeight' => 200,
                'paragraphize' => false,
                'cleanOnPaste' => false,
                'replaceDivs' => false,
                'linebreaks' => false,
                'plugins' => [
                    'fullscreen',
                    'imagemanager',
//                'video'
                ],
                'imageUpload' => Url::to(['/faq/faq/image-upload']),
                'imageManagerJson' => Url::to(['/faq/faq/images-get']),
            ]
        ]);

        ?>
        <?= $form->field($model, 'category_id')
            ->widget(Select2::classname(), [
                'data' => FaqCategory::buildTextTree(),
                'language' => 'ru',
                'options' => ['placeholder' => 'Выберите категорию ...'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]); ?>
        <?= $form->field($model, 'sort')->textInput()->hint('Здесь задается порядок вывода вопроса. Чем выше цифра, тем раньше выведется вопрос для просмотра') ?>
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? Module::t('faq', 'Create') : Module::t('faq', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>

</div>

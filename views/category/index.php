<?php
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use usesgraphcrt\faq\models\FaqCategory;
use yii\grid\GridView;

$this->title = 'Категории';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="category-index">
    <div class="row">
        <div class="col-md-2">
            <?= Html::a('Создать категорию', ['create'], ['class' => 'btn btn-success']) ?>
        </div>
        <div class="col-md-4">
            <?php
            $gridColumns = [
                'id',
                'name',
            ];
            ?>
        </div>
    </div>

    <br style="clear: both;">
<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        'id',
        'name',
        'parent_id',
        ['class' => 'yii\grid\ActionColumn'],
    ],
]); ?>

</div>

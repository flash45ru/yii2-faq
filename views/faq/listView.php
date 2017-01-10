<?php

use yii\helpers\Html;

?>
<div class="well">
    <h1 class="text-info"><?= Html::encode($model->title) ?></h1>
    <hr>
    <?= $model->text ?>
</div>

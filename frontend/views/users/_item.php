<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\User */
?>

<div class="panel panel-default">
    <div class="panel-heading">
        <?= Html::a(Html::encode($model->username), ['view', 'id' => $model->id]) ?>
    </div>
    <div class="panel-body">
        <?= Yii::$app->formatter->asNtext($model->description) ?>
    </div>
</div>

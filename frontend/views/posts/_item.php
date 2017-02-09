<?php

use common\rbac\Rbac;
use yii\helpers\Html;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $model common\models\Post */
?>

<div class="panel panel-default">
    <div class="panel-heading">
        <?= Html::a(Html::encode($model->title), ['user-posts/view', 'user_id' => $model->user_id, 'id' => $model->id]) ?>
    </div>
    <div class="panel-body">
        <?= Yii::$app->formatter->asNtext(StringHelper::truncateWords($model->content, 50)) ?>
    </div>
</div>

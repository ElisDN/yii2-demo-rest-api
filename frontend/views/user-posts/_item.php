<?php

use common\rbac\Rbac;
use yii\helpers\Html;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $model common\models\Post */
?>

<div class="panel panel-default">
    <div class="panel-heading">

        <?php if (Yii::$app->user->can(Rbac::MANAGE_POST, ['post' => $model])): ?>
            <p class="pull-right">
                <?= Html::a('Update', ['update', 'user_id' => $model->user_id, 'id' => $model->id], ['class' => 'btn btn-xs btn-primary']) ?>
                <?= Html::a('Delete', ['delete', 'user_id' => $model->user_id, 'id' => $model->id], [
                    'class' => 'btn btn-xs btn-danger',
                    'data' => [
                        'confirm' => 'Are you sure you want to delete this item?',
                        'method' => 'post',
                    ],
                ]) ?>
            </p>
        <?php endif; ?>

        <?= Html::a(Html::encode($model->title), ['user-posts/view', 'user_id' => $model->user_id, 'id' => $model->id]) ?>
    </div>
    <div class="panel-body">
        <?= Yii::$app->formatter->asNtext(StringHelper::truncateWords($model->content, 50)) ?>
    </div>
</div>

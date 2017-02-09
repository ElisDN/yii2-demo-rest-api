<?php

use common\rbac\Rbac;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $user frontend\models\User */
/* @var $model common\models\Post */

$this->title = $model->title;;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['users/index']];
$this->params['breadcrumbs'][] = ['label' => $user->username, 'url' => ['users/view', 'id' => $user->id]];
$this->params['breadcrumbs'][] = ['label' => 'Posts', 'url' => ['index', 'user_id' => $user->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-view">

    <?php if (Yii::$app->user->can(Rbac::MANAGE_POST, ['post' => $model])): ?>
        <p class="pull-right">
            <?= Html::a('Update', ['update', 'user_id' => $model->user_id, 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Delete', ['delete', 'user_id' => $model->user_id, 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ]) ?>
        </p>
    <?php endif; ?>

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'created_at:datetime',
            'updated_at:datetime',
        ],
    ]) ?>

    <div class="panel panel-default">
        <div class="panel-body">
            <?= Yii::$app->formatter->asHtml($model->content) ?>
        </div>
    </div>

</div>

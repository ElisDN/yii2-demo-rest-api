<?php

namespace api\controllers;

use yii\rest\ActiveController;

class PostController extends ActiveController
{
    public $modelClass = 'common\models\Post';

    public function actions()
    {
        $actions = parent::actions();
        unset($actions['create'], $actions['update'], $actions['delete']);
        return $actions;
    }
}
<?php

namespace api\controllers;

use api\models\PostSearch;
use Yii;
use yii\rest\ActiveController;

class PostController extends ActiveController
{
    public $modelClass = 'common\models\Post';

    public function actions()
    {
        $actions = parent::actions();

        unset($actions['create'], $actions['update'], $actions['delete']);

        $actions['index']['prepareDataProvider'] = [$this, 'prepareDataProvider'];

        return $actions;
    }

    public function prepareDataProvider()
    {
        $searchModel = new PostSearch();
        return $searchModel->search(Yii::$app->request->queryParams);
    }
}
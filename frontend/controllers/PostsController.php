<?php

namespace frontend\controllers;

use Yii;
use frontend\models\PostSearch;
use yii\web\Controller;

class PostsController extends Controller
{
    public function actionIndex()
    {
        $searchModel = new PostSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
}

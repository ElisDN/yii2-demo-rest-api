<?php

namespace api\controllers;

use common\models\User;
use Yii;
use yii\filters\AccessControl;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\rest\Controller;
use yii\web\ServerErrorHttpException;

class ProfileController extends Controller
{
    public function behaviors()
    {
        $behaviors = parent::behaviors();

        $behaviors['authenticator']['authMethods'] = [
              HttpBasicAuth::className(),
              HttpBearerAuth::className(),
        ];

        $behaviors['access'] = [
            'class' => AccessControl::className(),
            'rules' => [
                [
                    'allow' => true,
                    'roles' => ['@'],
                ],
            ],
        ];

        return $behaviors;
    }

    public function actionIndex()
    {
        return $this->findModel();
    }

    public function actionUpdate()
    {
        $model = $this->findModel();

        $model->load(Yii::$app->request->getBodyParams(), '');
        if ($model->save() === false && !$model->hasErrors()) {
            throw new ServerErrorHttpException('Failed to update the object for unknown reason.');
        }

        return $model;
    }

    public function verbs()
    {
        return [
            'index' => ['get'],
            'update' => ['put', 'patch'],
        ];
    }

    /**
     * @return User
     */
    private function findModel()
    {
        return User::findOne(\Yii::$app->user->id);
    }
}
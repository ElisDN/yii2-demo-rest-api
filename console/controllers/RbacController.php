<?php

namespace console\controllers;

use common\rbac\Rbac;
use common\rbac\rules\ProfileOwnerRule;
use Yii;
use yii\console\Controller;

class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;
        $auth->removeAll();

        $rule = new ProfileOwnerRule();
        $auth->add($rule);

        $manageProfile = $auth->createPermission(Rbac::MANAGE_PROFILE);
        $manageProfile->ruleName = $rule->name;
        $auth->add($manageProfile);

        $user = $auth->createRole('user');
        $auth->add($user);
        $auth->addChild($user, $manageProfile);
    }
}
<?php

namespace common\rbac\rules;

use yii\base\InvalidCallException;
use yii\rbac\Rule;

class PostAuthorRule extends Rule
{
    public $name = 'postAuthor';

    public function execute($userId, $item, $params)
    {
        if (empty($params['post'])) {
            throw new InvalidCallException('Specify post.');
        }

        return $params['post']->user_id == $userId;
    }
}
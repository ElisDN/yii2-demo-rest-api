<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'authManager' => [
            'class' => 'yii\rbac\PhpManager',
            'itemFile' => '@common/rbac/items/items.php',
            'assignmentFile' => '@common/rbac/items/assignments.php',
            'ruleFile' => '@common/rbac/items/rules.php',
            'defaultRoles' => ['user'],
        ],
    ],
];

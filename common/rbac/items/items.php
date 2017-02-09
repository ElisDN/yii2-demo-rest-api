<?php
return [
    'manageProfile' => [
        'type' => 2,
        'ruleName' => 'profileOwner',
    ],
    'managePost' => [
        'type' => 2,
        'ruleName' => 'postAuthor',
    ],
    'user' => [
        'type' => 1,
        'children' => [
            'manageProfile',
            'managePost',
        ],
    ],
];

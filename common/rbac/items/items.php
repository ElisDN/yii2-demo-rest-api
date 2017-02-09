<?php
return [
    'manageProfile' => [
        'type' => 2,
        'ruleName' => 'profileOwner',
    ],
    'user' => [
        'type' => 1,
        'children' => [
            'manageProfile',
        ],
    ],
];

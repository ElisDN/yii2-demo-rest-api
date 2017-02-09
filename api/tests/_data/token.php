<?php
return [
    [
        'user_id' => 1,
        'token' => 'token-correct',
        'expired_at' => time() + 3600,
    ],
    [
        'user_id' => 1,
        'token' => 'token-expired',
        'expired_at' => time() - 3600,
    ],
];

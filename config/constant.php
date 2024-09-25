<?php

return [

    'DEFAULT_PAGINATION_PERPAGE'    => 25,
    'keytoken' => env('KEY_TOKEN'),

    'NEW_USER_STATUS_ACTIVE'        => TRUE,
    'NEW_USER_DEFAULT_ROLES'        => "ROLE_USER",
    'NEW_USER_NEED_VERIFY_EMAIL'    => TRUE,

    'CRUD' => [
        'PER_PAGE' => 25,
        'PAGE' => 1,
        'SORT_BY'=> 'id',
    ],
];

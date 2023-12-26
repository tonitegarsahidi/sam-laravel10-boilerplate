<?php

return [

    'DEFAULT_PAGINATION_PERPAGE'    => 25,
    'keytoken' => env('KEY_TOKEN'),

    'NEW_USER_STATUS_ACTIVE'    => TRUE,
    'NEW_USER_DEFAULT_ROLES'    => "ROLE_USER",

    'CRUD' => [
        'PER_PAGE' => 25,
        'SORT_BY'=> 'id',
    ],
];

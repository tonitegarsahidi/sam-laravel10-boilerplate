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

    'COUNTRIES' =>  [
        'Australia', 'Bangladesh', 'Belarus', 'Brazil', 'Canada', 'China',
        'France', 'Germany', 'India', 'Indonesia', 'Israel', 'Italy', 'Japan',
        'Korea, Republic of', 'Mexico', 'Philippines', 'Russian Federation',
        'South Africa', 'Thailand', 'Turkey', 'Ukraine', 'United Arab Emirates',
        'United Kingdom', 'United States'
    ],

];

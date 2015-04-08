<?php

return [
    
    'BlogController_index' => [
        'pattern' => '\/',
        'connect' => 'Controllers\BlogController:index'
    ],
    'BlogController_show' => [
        'pattern' => '\/[a-zA-Z0-9\-_\.]+\/(?P<id>[1-9][0-9]*)',
        'connect' => 'Controllers\BlogController:show',
        'params' =>'id'
    ],
    'BlogController_user' => [
        'pattern' => '\/user\/[a-zA-Z0-9\-_\.]+\/(?P<id>[1-9][0-9]*)',
        'connect' => 'Controllers\BlogController:user',
        'params' =>'id'
    ]
];
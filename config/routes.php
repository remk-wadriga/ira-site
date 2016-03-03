<?php

return [
// Landing page
    '/'                                                                             => 'front/index/index',
    'login'                                                                         => 'site/auth/login',
    'logout'                                                                        => 'site/auth/logout',
    'register'                                                                      => 'site/auth/register',

    // Modules base routing
    '<module>/<controller>/<id:\d+>/<action>/<tab:\w+>'                             => '<module>/<controller>/<action>',
    '<module>/<controller>/<id:\d+>/<action>'                                       => '<module>/<controller>/<action>',
    '<module>/<controller>/<id:\d+>'                                                => '<module>/<controller>/view',
    '<module>/<controller>/<action>'                                                => '<module>/<controller>/<action>',
    '<module>/<controller>s'                                                        => '<module>/<controller>/list',
    '<module>'                                                                      => '<module>/index/index',

    // Base Routing
    '<controller>/<id:\d+>/<action>'                                                => 'front/<controller>/<action>',
    '<controller>/<id:\d+>'                                                         => 'front/<controller>/view',
    '<controller>/<action>'                                                         => 'front/<controller>/<action>',
    '<controller>s'                                                                 => 'front/<controller>/list',
];
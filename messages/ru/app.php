<?php

$messages = [
    'Email'                                                                                                             => '',
    'Password'                                                                                                          => '',
    'Repeat password'                                                                                                   => '',
    'First name'                                                                                                        => '',
    'Last name'                                                                                                         => '',
    'Phone'                                                                                                             => '',
    'Info'                                                                                                              => '',
    'User'                                                                                                              => '',
    'Admin'                                                                                                             => '',
    'Active'                                                                                                            => '',
    'Frozen'                                                                                                            => '',
    'Banned'                                                                                                            => '',
    'Deleted'                                                                                                           => '',
    'Register'                                                                                                          => '',
    'Login'                                                                                                             => '',
    'Please fill out the following fields to register'                                                                  => '',
    'Please fill out the following fields to login'                                                                     => '',
    'Home'                                                                                                              => '',
];

return array_merge($messages, require(__DIR__ . '/error.php'), require(__DIR__ . '/flash.php'));
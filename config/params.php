<?php

$params = [
    'appID'                                                 => 'Центр развития личности "Альтернатива"',
    'adminEmail'                                            => 'ac.kiev.ua@gmail.com',
    'systemEmail'                                           => 'ac.kiev.ua@gmail.com',
    'dateScriptsFormat'                                     => 'Y-m-d',
    'timeScriptsFormat'                                     => 'H:i',
    'dateTimeScriptsFormat'                                 => 'Y-m-d H:i:s',
    'dateTimeFormat'                                        => 'Y-m-d H:i:s',
    'dateTimeFormatFront'                                   => 'Y-m-d H:i',
    'dateFormat'                                            => 'Y-m-d',
    'timeFormat'                                            => 'H:i:s',
    'dbDateTimeFormat'                                      => 'YYYY-MM-DD HH:MI:SS',
    'mailDateTimeFormat'                                    => 'Y.m.d|H:i',
    'timeZone'                                              => 'Europe/Kiev',
    'salt'                                                  => 'UI8997YU45J',
    'userSessionTime'                                       => '3600',
    'mainAddress'                                           => 'Киев, ул. Регенератораная, 4, корп. 2, оф. 396',
    'frontEventsPerPage'                                    => 3,
    'adminEventsPerPage'                                    => 10,
];

$paramsLocalFile = __DIR__ . '/params_local.php';
if (file_exists($paramsLocalFile)) {
    $params = array_merge($params, require($paramsLocalFile));
}
return $params;

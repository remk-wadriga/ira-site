<?php

return [
    'events'                                                          => 'front/event/list',
    'event-<id\d+>/register'                                          => 'front/event/register',
    'event-<id(.+)>'                                                  => 'front/event/view',

    'post-<id(.+)>'                                                   => 'front/post/view',
];
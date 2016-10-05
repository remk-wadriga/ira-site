<?php

return [
    // Event
    'events'                                                          => 'front/event/list',
    'event-<id:\d+>/register'                                          => 'front/event/register',
    'event-<id:(.+)>'                                                  => 'front/event/view',

    // Post
    'post-<id:(.+)>'                                                   => 'front/post/view',
];
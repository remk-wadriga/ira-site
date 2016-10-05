<?php

/**
 * Created by PhpStorm.
 * User: Dima
 * Date: 05.04.2016
 * Time: 15:33
 */
class Debug
{
    private static $time;

    public static function setTime()
    {
        self::$time = microtime(true);
    }

    public static function getTime()
    {
        echo '<pre>'; print_r(microtime(true) - self::$time); exit('</pre>');
    }

    public static function getStats()
    {
        $memUsage = memory_get_usage(true);

        if ($memUsage < 1024) {
            $memUsage = $memUsage . ' B';
        } elseif ($memUsage < 1048576) {
            $memUsage = round($memUsage/1024, 2) . ' KB';
        } else {
            $memUsage = round($memUsage/1048576, 2) . ' MB';
        }

        $info = [
            'time' => round(microtime(true) - self::$time, 3) . ' s',
            'memory' => $memUsage,
        ];
        echo '<pre>'; print_r($info); exit('</pre>');
    }
}
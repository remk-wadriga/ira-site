<?php
/**
 * Created by PhpStorm.
 * User: Dima
 * Date: 14.06.2016
 * Time: 2:54
 */

namespace interfaces;


interface CpuUrlsInterface
{
    /**
     * @param $url
     * @return integer
     */
    public function getCountBySpuUrl($url);
}
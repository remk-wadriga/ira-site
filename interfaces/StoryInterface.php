<?php
/**
 * Created by PhpStorm.
 * User: Dima
 * Date: 05.03.2016
 * Time: 19:49
 */

namespace interfaces;


interface StoryInterface
{
    public function getID();

    public static function className();

    public function getStoryAction();

    public function getStoryFields();

    public function getStoryOldValues();

    public function getStoryNewValues();
}
<?php
/**
 * Created by PhpStorm.
 * User: Dima
 * Date: 08.03.2016
 * Time: 22:17
 */

namespace interfaces;


interface ImagedEntityInterface
{
    /**
     * @return integer
     */
    public function getID();

    /**
     * @return string
     */
    public function getImgUrl();

    /**
     * @return string
     */
    public function getImgAlt();

    /**
     * @return bool
     */
    public function isMainImage();

    /**
     * @return integer
     */
    public function getImgID();

    /**
     * @param $id
     */
    public function setImgID($id);

    /**
     * @return string
     */
    public static function className();
}
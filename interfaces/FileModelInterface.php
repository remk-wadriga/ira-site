<?php
/**
 * Created by PhpStorm.
 * User: Dima
 * Date: 06.03.2016
 * Time: 16:27
 */

namespace interfaces;


interface FileModelInterface extends ModelInterface
{
    /**
     * @return string
     */
    public function getFileAttributeName();

    /**
     * @return \yii\base\Model
     */
    public function getModelInstance();

    /**
     * @return string
     */
    public function getOldFileName();

    /**
     * @param string $fileName
     */
    public function setFileName($fileName);

    /**
     * @return array
     */
    public function getCropInfo();

    /**
     * @return integer
     */
    public function getImgWidth();

    /**
     * @return integer
     */
    public function getImgHeight();
}
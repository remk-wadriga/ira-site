<?php
/**
 * Created by Dmitry Kushneriov.
 * User: rem
 * Date: 26.09.2015
 * Time: 13:38
 */

namespace abstracts;

use Yii;
use yii\base\Exception;

abstract class ExceptionAbstract extends Exception
{
    const ACCESS_DENIED_CODE = 1000;
    const NOT_FOUND_CODE = 2000;

    const FILE_EXCEPTION_CODE = 100;
    const FILE_UPLOAD_EXCEPTION_CODE = 101;

    /**
     * @return string
     */
    public function getError()
    {
        return Yii::t('error', $this->getMessage());
    }
}
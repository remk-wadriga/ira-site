<?php
/**
 * Created by Dmitry Kushneriov.
 * User: rem
 * Date: 26.09.2015
 * Time: 13:37
 */

namespace exceptions;

use Yii;
use abstracts\ExceptionAbstract;

class FileException extends ExceptionAbstract
{
    protected $message = 'File error';
    protected $code = self::FILE_EXCEPTION_CODE;

    public function getName()
    {
        return 'File service exception';
    }
}
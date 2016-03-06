<?php
/**
 * Created by Dmitry Kushneriov.
 * User: rem
 * Date: 26.09.2015
 * Time: 13:44
 */

namespace exceptions;

use Yii;

class FileUploadException extends FileException
{
    protected $message = 'File upload error';
    protected $code = self::FILE_UPLOAD_EXCEPTION_CODE;

    public function getName()
    {
        return 'File upload exception';
    }
}
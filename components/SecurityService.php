<?php
/**
 * Created by PhpStorm.
 * User: Rem
 * Date: 08.09.2016
 * Time: 14:28
 */

namespace components;

use Yii;
use yii\base\Security;

class SecurityService extends Security
{
    public $tokenLength = 64;
    public $salt;
    public $hashAlgo = 'sha512';
    public $hashIterationsCount = 150;

    public function init()
    {
        parent::init();

        if ($this->salt === null) {
            $this->salt = Yii::$app->params['salt'];
        }
    }

    public function generateToken($length = null, $salt = null)
    {
        return $this->generateHash($this->generateRandomString(32), $salt . $this->generateRandomString(15), $length);
    }

    public function generateHash($word, $salt = null, $length = 0)
    {
        if ($length === 0) {
            $length = $this->tokenLength;
        }
        if ($salt === null) {
            $salt = $this->salt;
        }

        $salt .= $this->salt;

        $string = $this->pbkdf2($this->hashAlgo, $word, $salt, $this->hashIterationsCount, $length);
        return hash('sha256', $string . $salt);
    }
}
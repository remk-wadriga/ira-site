<?php
/**
 * Created by PhpStorm.
 * User: Rem
 * Date: 07.09.2016
 * Time: 12:30
 */

namespace components;

use Yii;
use yii\base\ErrorException;
use yii\swiftmailer\Mailer as BaseMailer;

class Mailer extends BaseMailer
{
    public $htmlLayout = '@themes/admin/mail/layouts/main';
    public $viewsPath = '@themes/admin/mail/views';
    public $systemEmail;
    public $systemMailFrom;
    public $dateTimeFormat;
    public $enabled = true;
    public $deliveryLimit = 15;
    public $deliveryTimeout = 3;

    public function init()
    {
        parent::init();

        $this->setViewPath($this->viewsPath);

        if ($this->systemEmail === null) {
            $this->systemEmail = Yii::$app->params['adminEmail'];
        }
        if ($this->systemMailFrom === null) {
            $this->systemMailFrom = Yii::$app->id;
        }
    }

    public function t($message, $params = [], $direction = 'app')
    {
        return Yii::$app->view->t($message, $params, $direction);
    }

    public function sendMail($view, $params = [])
    {
        if (!$this->enabled) {
            return true;
        }

        // Set default from email
        $fromEmail = $this->systemEmail;
        // Set default system mailer name as sender
        $fromName = $this->systemMailFrom;

        // Check mail params
        if (isset($params['fromEmail'])) {
            $fromEmail = $params['fromEmail'];
        }
        if (isset($params['from'])) {
            $fromName = $params['from'];
        }
        if (!isset($params['to']) || !isset($params['title'])) {
            throw new ErrorException($this->t('You must specify both options: "{param 1}" and "{param2}"', ['param1' => 'to', 'param2' => 'title']));
        }

        // Check the email format
        if (!filter_var($params['to'], FILTER_VALIDATE_EMAIL)) {
            throw new ErrorException($this->t('Invalid parameter: "{name}"', ['name' => 'from']));
        }

        if (is_array($fromName) || filter_var($fromName, FILTER_VALIDATE_EMAIL)) {
            $from = $fromName;
        } else {
            $from = [$fromEmail => $fromName];
        }

        return $this->compose($view, $params)
            ->setFrom($from)
            ->setTo($params['to'])
            ->setSubject($params['title'])
            ->send();
    }

    public function formatDate($date)
    {
        return Yii::$app->time->formatDate($date, $this->dateTimeFormat);
    }
}
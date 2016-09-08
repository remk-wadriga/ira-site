<?php
/**
 * Created by PhpStorm.
 * User: Rem
 * Date: 07.09.2016
 * Time: 13:12
 */

namespace helpers;

use Yii;
use abstracts\HelperAbstract;
use interfaces\MailSenderInterface;

class MailHelper extends HelperAbstract
{
    /**
     * @param MailSenderInterface $sender
     * @return bool
     * @throws \yii\base\ErrorException
     */
    public static function send(MailSenderInterface $sender)
    {
        $params = $sender->getMailParams();

        if (($from = $sender->getMailFrom()) !== null) {
            $params['from'] = $from;
        }
        if (($to = $sender->getMailTo()) !== null) {
            $params['to'] = $to;
        }
        if (($title = $sender->getMailTitle()) !== null) {
            $params['title'] = $title;
        }
        if (($message = $sender->getMailMessage()) !== null) {
            $params['message'] = $message;
        }
        if (($unfollowUrl = $sender->getUnfollowUrl()) !== null) {
            $params['unfollowUrl'] = $unfollowUrl;
        }

        // Check the email format
        if (!filter_var($params['to'], FILTER_VALIDATE_EMAIL)) {
            return true;
        }

        try {
            return Yii::$app->mailer->sendMail($sender->getMailView(), $params);
        } catch (\Exception $e) {
            echo '<pre>'; print_r($e->getMessage()); exit('</pre>');
            return false;
        }
    }
}
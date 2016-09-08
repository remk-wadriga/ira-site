<?php
/**
 * Created by PhpStorm.
 * User: Rem
 * Date: 07.09.2016
 * Time: 16:06
 */

namespace app\commands;

use Yii;
use yii\console\Controller;
use yii\db\Query;
use models\User;
use models\MailDelivery;
use helpers\MailHelper;

class MailController extends Controller
{
    public function actionSendDelivery()
    {
        // Get mail delivery limit
        $limit = Yii::$app->mailer->deliveryLimit;
        // Get DB connection instance
        $db = Yii::$app->getDb();
        // Create sended mails count
        $sendedCount = 0;

        foreach ($this->findActiveDeliveries() as $delivery) {
            if ($limit == 0) {
                return;
            }

            // Begin the transaction
            $transaction = $db->beginTransaction();
            // Set mail delivering default result
            $result = false;

            foreach ($this->findUsers($delivery, $limit) as $user) {
                // Generate mail delivery unfollow token
                $unfollowToken = Yii::$app->security->generateToken();

                // Set mail delivery params
                $delivery->setMailTo($user['email']);
                $delivery->setMailDeliveryUnfollowToken($unfollowToken);

                // Try to set unfollow token to user
                $result = $db->createCommand()->update(User::tableName(), ['mail_delivery_token' => $unfollowToken], ['id' => $user['id']])->execute();
                if (!$result) {
                    break;
                }

                // Try to write the user and delivery IDs to user_mail_delivery table
                $result = $db->createCommand()->insert(User::userMailDeliveryTableName(), ['mail_delivery_id' => $delivery->id, 'user_id' => $user['id']])->execute();
                if (!$result) {
                    break;
                }

                // Try to send email
                if (!MailHelper::send($delivery)) {
                    echo '<pre>'; print_r(3); exit('</pre>');
                    $result = false;
                    break;
                }

                $limit--;
                $sendedCount++;
                $result = true;
                sleep(Yii::$app->mailer->deliveryTimeout + rand(0, 1));
            }

            if (!$result) {
                $transaction->rollBack();
                continue;
            }

            if (empty($this->findUsers($delivery, 1))) {
                // If there are no users to send - to complete its
                if (!$this->finishDelivery($delivery)) {
                    $transaction->rollBack();
                    continue;
                }
            }

            $transaction->commit();
        }

        echo "Sended {$sendedCount} mails\n";
    }

    /**
     * @return MailDelivery[]
     */
    private function findActiveDeliveries()
    {
        $where = '(status = :status_current) OR (status = :status_new AND date_send <= now())';

        /** @var \models\MailDelivery[] */
        return MailDelivery::find()
            ->where($where)
            ->params([
                ':status_current' => MailDelivery::STATUS_CURRENT,
                ':status_new' => MailDelivery::STATUS_NEW,
            ])
            ->all();
    }

    /**
     * @param MailDelivery $delivery
     * @param $limit
     * @return array
     */
    private function findUsers(MailDelivery $delivery, $limit)
    {
        // Create user mail delivery users IDs query
        $userMailDeliveryUsersIDsQuery = (new Query())
            ->select('user_id')
            ->from(User::userMailDeliveryTableName())
            ->where(['mail_delivery_id' => $delivery->id]);

        return (new Query())
            ->select([
                'id',
                'email',
            ])
            ->from(User::tableName())
            ->where([
                'mail_delivery_allowed' => 1,
                'role' => User::ROLE_USER,
            ])
            ->andWhere(['NOT IN', 'id', $userMailDeliveryUsersIDsQuery])
            ->limit($limit)
            ->all();
    }

    /**
     * @param MailDelivery $delivery
     * @return bool
     */
    private function finishDelivery(MailDelivery $delivery)
    {
        $delivery->status = MailDelivery::STATUS_PAST;
        $delivery->setStoryAction(MailDelivery::STORY_ACTION_FINISHED);
        
        return $delivery->save();
    }
}
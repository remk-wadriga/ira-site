<?php

use yii\db\Migration;

class m161005_220409_event_trainers extends Migration
{
    public function up()
    {
        $this->execute('CREATE TABLE `event_trainer` (
            `event_id`  bigint(11) UNSIGNED NOT NULL ,
            `trainer_id`  bigint(11) UNSIGNED NOT NULL ,
            PRIMARY KEY (`event_id`, `trainer_id`),
            FOREIGN KEY (`event_id`) REFERENCES `event` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
            FOREIGN KEY (`trainer_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
            INDEX `event_trainer_user_id` (`trainer_id`) USING BTREE 
            ) ENGINE=InnoDB DEFAULT CHARACTER SET=utf8');
    }

    public function down()
    {
        echo "m161005_220409_event_trainers cannot be reverted.\n";

        return false;
    }
}

<?php

use yii\db\Migration;

class m160402_154516_post_table extends Migration
{
    public function up()
    {
        $this->execute("CREATE TABLE `post` (
          `id` bigint(11) unsigned NOT NULL AUTO_INCREMENT,
          `owner_id` bigint(20) unsigned NOT NULL,
          `title` varchar(255) NOT NULL,
          `text` text NOT NULL,
          `citation` text,
          `video` varchar(512) DEFAULT NULL,
          `date_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
          `date_update` timestamp NULL DEFAULT NULL,
          `status` enum('private','for_registered','public','disabled','deleted') NOT NULL DEFAULT 'public',
          PRIMARY KEY (`id`),
          KEY `post_owner_id` (`owner_id`),
          CONSTRAINT `post_owner_id` FOREIGN KEY (`owner_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
        ) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8");
    }

    public function down()
    {
        echo "m160402_154516_post_table cannot be reverted.\n";

        return false;
    }
}

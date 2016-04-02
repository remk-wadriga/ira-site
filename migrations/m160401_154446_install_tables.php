<?php

use yii\db\Migration;

class m160401_154446_install_tables extends Migration
{
    public function up()
    {
        $this->execute("CREATE TABLE `user` (
          `id` bigint(11) unsigned NOT NULL AUTO_INCREMENT,
          `email` varchar(255) NOT NULL,
          `password_hash` varchar(255) NOT NULL,
          `first_name` varchar(126) NOT NULL,
          `last_name` varchar(126) DEFAULT NULL,
          `phone` varchar(24) DEFAULT NULL,
          `avatar` varchar(255) DEFAULT NULL,
          `role` enum('user','admin','trainer') NOT NULL DEFAULT 'user',
          `status` enum('deleted','banned','frozen','active') NOT NULL DEFAULT 'active',
          `info` text,
          `date_register` datetime NOT NULL,
          PRIMARY KEY (`id`)
        ) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8");
        $this->execute("CREATE TABLE `comment` (
          `id` bigint(11) unsigned NOT NULL AUTO_INCREMENT,
          `parent_id` bigint(11) DEFAULT NULL,
          `entity_id` bigint(11) NOT NULL,
          `user_id` bigint(11) unsigned NOT NULL,
          `entity_class` varchar(126) NOT NULL,
          `title` varchar(255) DEFAULT NULL,
          `text` text,
          `date` datetime NOT NULL,
          PRIMARY KEY (`id`),
          KEY `comment_user_id` (`user_id`),
          CONSTRAINT `comment_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
        ) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8");
        $this->execute("CREATE TABLE `entity_image` (
          `entity_id` bigint(11) unsigned NOT NULL,
          `image_id` bigint(11) unsigned NOT NULL,
          `entity_class` varchar(126) NOT NULL,
          `is_main` tinyint(1) NOT NULL DEFAULT '0',
          PRIMARY KEY (`entity_id`,`image_id`,`entity_class`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8");
        $this->execute("CREATE TABLE `event` (
          `id` bigint(11) unsigned NOT NULL AUTO_INCREMENT,
          `name` varchar(255) NOT NULL,
          `owner_id` bigint(11) unsigned DEFAULT NULL,
          `owner_name` varchar(255) DEFAULT NULL,
          `description` text,
          `citation` text,
          `members_count` int(4) unsigned DEFAULT NULL,
          `address` varchar(512) DEFAULT NULL,
          `price` float unsigned NOT NULL,
          `profit` float unsigned DEFAULT NULL,
          `cost` float unsigned DEFAULT NULL,
          `type` enum('training','therapeutic_group','workshop','psychological_game','lecture','study_group') NOT NULL,
          `status` enum('new','current','past','canceled') NOT NULL DEFAULT 'new',
          `date_start` datetime DEFAULT NULL,
          `date_end` datetime DEFAULT NULL,
          `in_main_slider` tinyint(1) NOT NULL DEFAULT '0',
          PRIMARY KEY (`id`),
          KEY `event_owner_id` (`owner_id`),
          CONSTRAINT `event_owner_id` FOREIGN KEY (`owner_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
        ) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8");
        $this->execute("CREATE TABLE `event_user` (
          `id` bigint(11) unsigned NOT NULL AUTO_INCREMENT,
          `event_id` bigint(11) unsigned NOT NULL,
          `user_id` bigint(11) unsigned DEFAULT NULL,
          `email` varchar(255) NOT NULL,
          `name` varchar(255) DEFAULT NULL,
          `phone` varchar(26) DEFAULT NULL,
          `date_registration` datetime NOT NULL,
          `comment` text,
          `status` enum('came','not_come','recorded') NOT NULL DEFAULT 'recorded',
          PRIMARY KEY (`id`),
          KEY `event_user_user_id` (`user_id`),
          KEY `event_user_event_id` (`event_id`),
          CONSTRAINT `event_user_event_id` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
          CONSTRAINT `event_user_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
        ) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8");
        $this->execute("CREATE TABLE `image` (
          `id` bigint(11) unsigned NOT NULL AUTO_INCREMENT,
          `url` varchar(512) NOT NULL,
          `alt` varchar(255) DEFAULT NULL,
          `status` enum('active','not_active') NOT NULL DEFAULT 'active',
          `description` text,
          `date_add` datetime NOT NULL,
          PRIMARY KEY (`id`)
        ) ENGINE=InnoDB AUTO_INCREMENT=159 DEFAULT CHARSET=utf8");
        $this->execute("CREATE TABLE `slide` (
          `id` bigint(11) unsigned NOT NULL AUTO_INCREMENT,
          `title` varchar(255) NOT NULL,
          `sub_title` varchar(255) DEFAULT NULL,
          `text` text,
          `link_url` varchar(126) DEFAULT NULL,
          `link_text` varchar(126) DEFAULT NULL,
          `link_title` varchar(126) DEFAULT NULL,
          `status` enum('active','not_active') NOT NULL DEFAULT 'active',
          PRIMARY KEY (`id`)
        ) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8");
        $this->execute("CREATE TABLE `story` (
          `id` bigint(11) unsigned NOT NULL AUTO_INCREMENT,
          `target_class` varchar(255) NOT NULL,
          `target_id` bigint(11) unsigned NOT NULL,
          `user_id` bigint(11) unsigned DEFAULT NULL,
          `action` varchar(255) NOT NULL,
          `date` datetime NOT NULL,
          `fields_json` text,
          `old_values_json` text,
          `new_values_json` text,
          PRIMARY KEY (`id`),
          KEY `story_user_id` (`user_id`),
          CONSTRAINT `story_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
        ) ENGINE=InnoDB AUTO_INCREMENT=363 DEFAULT CHARSET=utf8");
        $this->execute("CREATE TABLE `tag` (
          `entity_id` bigint(11) unsigned NOT NULL,
          `entity_class` varchar(126) NOT NULL,
          `tag` varchar(126) NOT NULL,
          PRIMARY KEY (`entity_id`,`entity_class`,`tag`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8");
        $this->execute("CREATE TABLE `user_click` (
          `user_id` bigint(20) unsigned NOT NULL DEFAULT '0',
          `ip_address` varchar(15) NOT NULL DEFAULT '0',
          `entity_class` varchar(126) NOT NULL,
          `entity_id` bigint(11) unsigned NOT NULL,
          `type` enum('interesting','like') NOT NULL,
          PRIMARY KEY (`user_id`,`ip_address`,`entity_class`,`entity_id`,`type`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8");
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
        $this->execute("INSERT INTO `user` (`email`,`password_hash`,`first_name`,`last_name`,`phone`,`avatar`,`role`,`status`,`info`,`date_register`) VALUES
          ('remkwdriga@yandex.ua','ae296122621b7eda3370dc9959e3005c','Дмитрий','Кушнерёв','(063) 568 86 19',NULL,'admin','active','','2016-03-04 22:49:54'),
          ('ac.kiev.ua@gmail.com','16353818f5e97f46296b1d7908e29014','Ирина','Заец','',NULL,'admin','active',NULL,'2016-03-23 22:15:15')");
    }

    public function down()
    {
        echo "m160401_154446_install_tables cannot be reverted.\n";

        return false;
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}

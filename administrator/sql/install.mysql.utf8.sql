CREATE TABLE IF NOT EXISTS `#__ugc_reviews` (
`id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,

`state` TINYINT(1)  NULL  DEFAULT 1,
`ordering` INT(11)  NULL  DEFAULT 0,
`checked_out` INT(11)  UNSIGNED,
`checked_out_time` DATETIME NULL  DEFAULT NULL ,
`created_by` INT(11)  NULL  DEFAULT 0,
`modified_by` INT(11)  NULL  DEFAULT 0,
`created_at` DATETIME NULL  DEFAULT NULL ,
`trip_code` VARCHAR(255)  NOT NULL ,
`rating` DOUBLE NOT NULL DEFAULT 0,
`review_title` VARCHAR(255)  NOT NULL ,
`review_content` TEXT NOT NULL ,
`user_id` VARCHAR(255)  NULL  DEFAULT "",
`user_name` VARCHAR(255)  NOT NULL ,
`user_location` VARCHAR(255)  NOT NULL ,
`country` VARCHAR(255)  NOT NULL ,
`image1` TEXT NULL ,
`image2` TEXT NULL ,
`image3` TEXT NULL ,
`image4` TEXT NULL ,
`image5` TEXT NULL ,
`image6` TEXT NULL ,
`image7` TEXT NULL ,
`image8` TEXT NULL ,
`image9` TEXT NULL ,
`image10` TEXT NULL ,
`videos` VARCHAR(255)  NULL  DEFAULT "",
`review_reply` TEXT NULL ,
PRIMARY KEY (`id`)
,KEY `idx_state` (`state`)
,KEY `idx_checked_out` (`checked_out`)
,KEY `idx_created_by` (`created_by`)
,KEY `idx_modified_by` (`modified_by`)
) DEFAULT COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `#__ugc_images` (
`id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,

`asset_id` INT(10) UNSIGNED NOT NULL DEFAULT '0',

`state` TINYINT(1)  NULL  DEFAULT 1,
`ordering` INT(11)  NULL  DEFAULT 0,
`checked_out` INT(11)  UNSIGNED,
`checked_out_time` DATETIME NULL  DEFAULT NULL ,
`created_by` INT(11)  NULL  DEFAULT 0,
`modified_by` INT(11)  NULL  DEFAULT 0,
`review_id` INT(10)  NOT NULL  DEFAULT 0,
`image_path` VARCHAR(255)  NOT NULL ,
`title` VARCHAR(255)  NULL  DEFAULT "",
`created_at` DATETIME NULL  DEFAULT NULL ,
`image1` TEXT NULL ,
`image2` TEXT NULL ,
`image3` TEXT NULL ,
`image4` TEXT NULL ,
`image5` TEXT NULL ,
`image6` TEXT NULL ,
`image7` TEXT NULL ,
`image8` TEXT NULL ,
`image9` TEXT NULL ,
`image10` TEXT NULL ,
PRIMARY KEY (`id`)
,KEY `idx_state` (`state`)
,KEY `idx_checked_out` (`checked_out`)
,KEY `idx_created_by` (`created_by`)
,KEY `idx_modified_by` (`modified_by`)
) DEFAULT COLLATE=utf8mb4_unicode_ci;

CREATE INDEX `#__ugc_images_review_id` ON `#__ugc_images`(`review_id`);


INSERT INTO `#__content_types` (`type_title`, `type_alias`, `table`, `rules`, `field_mappings`, `content_history_options`)
SELECT * FROM ( SELECT 'Review','com_ugc_new.review','{"special":{"dbtable":"#__ugc_reviews","key":"id","type":"ReviewTable","prefix":"Joomla\\\\Component\\\\Ugc_new\\\\Administrator\\\\Table\\\\"}}', CASE 
                                    WHEN 'rules' is null THEN ''
                                    ELSE ''
                                    END as rules, CASE 
                                    WHEN 'field_mappings' is null THEN '{"common":{"core_content_item_id":"id","core_title":"trip_code","core_alias":"trip_code","core_state":"state"}}'
                                    ELSE '{"common":{"core_content_item_id":"id","core_title":"trip_code","core_alias":"trip_code","core_state":"state"}}'
                                    END as field_mappings, '{"formFile":"administrator\/components\/com_ugc_new\/forms\/review.xml", "hideFields":["checked_out","checked_out_time","params","language" ,"review_reply"], "ignoreChanges":["modified_by", "modified", "checked_out", "checked_out_time"], "convertToInt":["publish_up", "publish_down"], "displayLookup":[{"sourceColumn":"catid","targetTable":"#__categories","targetColumn":"id","displayColumn":"title"},{"sourceColumn":"group_id","targetTable":"#__usergroups","targetColumn":"id","displayColumn":"title"},{"sourceColumn":"created_by","targetTable":"#__users","targetColumn":"id","displayColumn":"name"},{"sourceColumn":"access","targetTable":"#__viewlevels","targetColumn":"id","displayColumn":"title"},{"sourceColumn":"modified_by","targetTable":"#__users","targetColumn":"id","displayColumn":"name"}]}') AS tmp
WHERE NOT EXISTS (
	SELECT type_alias FROM `#__content_types` WHERE (`type_alias` = 'com_ugc_new.review')
) LIMIT 1;

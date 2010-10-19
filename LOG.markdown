# DB changes

## oct 19th

``ALTER TABLE `dv_element` CHANGE `is_best` `notify` TINYINT( 4 ) NULL DEFAULT NULL``

``ALTER TABLE `dv_element` CHANGE `notify` `is_new` TINYINT( 4 ) NULL DEFAULT NULL`` 
 
## oct 16th

``ALTER TABLE `dv_comment` CHANGE `comment_approved` `comment_status` VARCHAR( 45 ) NULL DEFAULT NULL;``

``ALTER TABLE `dv_comment` ADD `created` DATETIME NULL;``
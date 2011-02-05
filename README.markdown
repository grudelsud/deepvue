# POST LIVE
this section relates to documentation after the first live publication, and it's mainly focused on the new functionalities and implementation using code igniter 2. For older docs, please refer to section PRE LIVE

## log

### 5.2.11

- changed database! added dv_user.facebook_id, dv_user.twitter_login, dv_user.last_login
- added tables: dv_message, dv_relationship, dv_sessions (codeigniter system table)
- added user update form with form validation (see function user/update and config/form_validation.php)

## comments and notes (quite old actually)

- counter on each image? (this image has been viewed xxx times)
- partial saving while writing comment, gives more the feeling of taking a note
- interesting: in quora you never read the author of a question, even if followed/following

# PRE LIVE
General documentation

please refer to the following:

- authentication workflow: detailed in /index.php

- web frontend template: presently is total crap, please refer to functions dvfe->get[header, navigation, main]. 
please refer to /view/header.php /view/index.php for main functionalities

- add / get comment functions defined in dvdb and used in ajax_fe.php 

## DB changes

### nov 13th

added dv_element.timezone
added dv_event.timezone_end

### oct 31st

added dv_user.user_name

### oct 19th

``ALTER TABLE `dv_element` CHANGE `is_best` `notify` TINYINT( 4 ) NULL DEFAULT NULL``
``ALTER TABLE `dv_element` CHANGE `notify` `is_new` TINYINT( 4 ) NULL DEFAULT NULL`` 
 
### oct 16th

``ALTER TABLE `dv_comment` CHANGE `comment_approved` `comment_status` VARCHAR( 45 ) NULL DEFAULT NULL;``
``ALTER TABLE `dv_comment` ADD `created` DATETIME NULL;``

## FIXME - TODO - Things missing

- generally speaking, search for TODO and FIXME labels in the source code to find the exhaustive list of microtasks

- db, table comments: text field for author is missing even if it's ok to have it as it is while the website 
is restricted to registered twitter user only. add DATE for comments!

- db, table user: all logging fields and functionalities, last check-in, navigation tracking, ...

- db, check tables element, event, comment: implement TIMEZONE for elements and start/end event

## Next steps

- give images a decent name in order to simplify merge/diff of folders

## References

### General libraries

- postmark app

### PHP frameworks

- code igniter
- doctrine ORM

### Comments

- markdown syntax http://daringfireball.net/projects/markdown/syntax
- markdown editor plugin for eclipse: http://winterstein.me.uk/projects/tt-update-site/

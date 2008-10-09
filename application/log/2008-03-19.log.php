<?php defined('SYSPATH') or die('No direct script access.'); ?>

2008-03-19 14:20:02 -- error: Uncaught Kohana_Database_Exception: There was an SQL error: Table 'milion.categorys' doesn't exist - SELECT concat(cube,' :: ',method) as name, sum(submissions.solved) as solved FROM categorys LEFT JOIN submissions ON submissions.category_id=categorys.id WHERE submissions.user_id=33 GROUP BY name in file system/libraries/drivers/Database/Mysql.php on line 379
2008-03-19 14:20:48 -- error: Uncaught Kohana_Database_Exception: There was an SQL error: Table 'milion.categorys' doesn't exist - SELECT concat(cube,' :: ',method) as name, sum(submissions.solved) as solved FROM categorys LEFT JOIN submissions ON submissions.category_id=categorys.id WHERE submissions.user_id=33 GROUP BY name in file system/libraries/drivers/Database/Mysql.php on line 379
2008-03-19 14:20:50 -- error: Uncaught Kohana_Database_Exception: There was an SQL error: Table 'milion.categorys' doesn't exist - SELECT concat(cube,' :: ',method) as name, sum(submissions.solved) as solved FROM categorys LEFT JOIN submissions ON submissions.category_id=categorys.id WHERE submissions.user_id=33 GROUP BY name in file system/libraries/drivers/Database/Mysql.php on line 379
2008-03-19 14:20:51 -- error: Uncaught Kohana_Database_Exception: There was an SQL error: Table 'milion.categorys' doesn't exist - SELECT concat(cube,' :: ',method) as name, sum(submissions.solved) as solved FROM categorys LEFT JOIN submissions ON submissions.category_id=categorys.id WHERE submissions.user_id=33 GROUP BY name in file system/libraries/drivers/Database/Mysql.php on line 379
2008-03-19 14:22:10 -- error: Uncaught Kohana_Database_Exception: There was an SQL error: Unknown column 'submissions.solved' in 'field list' - SELECT `username`, `milion_users`.`id`, sum(submissions.solved) as solved
FROM `milion_users` LEFT JOIN `milion_submissions` ON `milion_submissions`.`user_id` = `milion_users`.`id`
WHERE `milion_submissions`.`category_id` = '1'
GROUP BY users.id
ORDER BY `solved` DESC in file system/libraries/drivers/Database/Mysql.php on line 379
2008-03-19 14:26:41 -- error: Uncaught Kohana_Database_Exception: There was an SQL error: Table 'milion.submissions' doesn't exist - SELECT year(created) as valone, month(created) as valtwo, sum(solved) as value FROM submissions GROUP BY date_format(created,'%c-%Y') ORDER BY valone, valtwo ASC  in file system/libraries/drivers/Database/Mysql.php on line 379
2008-03-19 14:29:47 -- error: Uncaught Kohana_Database_Exception: There was an SQL error: Table 'milion.categorys' doesn't exist - SELECT concat(cube,' :: ',method) as name, sum(submissions.solved) as solved FROM categorys LEFT JOIN submissions ON submissions.category_id=categorys.id WHERE submissions.user_id=33 GROUP BY name in file system/libraries/drivers/Database/Mysql.php on line 379
2008-03-19 14:35:12 -- error: Uncaught Kohana_Database_Exception: There was an SQL error: Unknown column 'mulion_submissions.category_id' in 'on clause' - SELECT concat(cube,' :: ',method) as name, sum(milion_submissions.solved) as solved FROM milion_categorys LEFT JOIN milion_submissions ON mulion_submissions.category_id=milion_categorys.id WHERE milion_submissions.user_id=33 GROUP BY name in file system/libraries/drivers/Database/Mysql.php on line 379
2008-03-19 14:38:36 -- error: Uncaught Kohana_Database_Exception: There was an SQL error: Unknown column 'submissions.solved' in 'field list' - SELECT `username`, `milion_users`.`id`, sum(submissions.solved) as solved
FROM `milion_users` LEFT JOIN `milion_submissions` ON `milion_submissions`.`user_id` = `milion_users`.`id`
WHERE `milion_submissions`.`category_id` = '1'
GROUP BY users.id
ORDER BY `solved` DESC in file system/libraries/drivers/Database/Mysql.php on line 379
2008-03-19 14:42:56 -- error: Uncaught Kohana_Database_Exception: There was an SQL error: Unknown column 'submissions.solved' in 'field list' - SELECT `username`, `milion_users`.`id`, sum(submissions.solved) as solved
FROM `milion_users` LEFT JOIN `milion_submissions` ON `milion_submissions`.`user_id` = `milion_users`.`id`
WHERE `milion_submissions`.`category_id` = '1'
GROUP BY users.id
ORDER BY `solved` DESC in file system/libraries/drivers/Database/Mysql.php on line 379
2008-03-19 14:44:34 -- error: Uncaught Kohana_Database_Exception: There was an SQL error: Unknown column 'users.id' in 'group statement' - SELECT `username`, `milion_users`.`id`, sum(milion_submissions.solved) as solved
FROM `milion_users` LEFT JOIN `milion_submissions` ON `milion_submissions`.`user_id` = `milion_users`.`id`
WHERE `milion_submissions`.`category_id` = '1'
GROUP BY users.id
ORDER BY `solved` DESC in file system/libraries/drivers/Database/Mysql.php on line 379
2008-03-19 14:44:55 -- error: Uncaught Kohana_Database_Exception: There was an SQL error: Unknown column 'milion_milion_submissions.user_id' in 'on clause' - SELECT `username`, `milion_users`.`id`, sum(milion_submissions.solved) as solved
FROM `milion_users` LEFT JOIN `milion_submissions` ON `milion_milion_submissions`.`user_id` = `milion_milion_users`.`id`
WHERE `milion_submissions`.`category_id` = '1'
GROUP BY users.id
ORDER BY `solved` DESC in file system/libraries/drivers/Database/Mysql.php on line 379
2008-03-19 14:45:02 -- error: Uncaught Kohana_Database_Exception: There was an SQL error: Unknown column 'milion_milion_users.id' in 'on clause' - SELECT `username`, `milion_users`.`id`, sum(milion_submissions.solved) as solved
FROM `milion_users` LEFT JOIN `milion_submissions` ON `milion_submissions`.`user_id` = `milion_milion_users`.`id`
WHERE `milion_submissions`.`category_id` = '1'
GROUP BY users.id
ORDER BY `solved` DESC in file system/libraries/drivers/Database/Mysql.php on line 379
2008-03-19 14:45:09 -- error: Uncaught Kohana_Database_Exception: There was an SQL error: Unknown column 'users.id' in 'group statement' - SELECT `username`, `milion_users`.`id`, sum(milion_submissions.solved) as solved
FROM `milion_users` LEFT JOIN `milion_submissions` ON `milion_submissions`.`user_id` = `milion_users`.`id`
WHERE `milion_submissions`.`category_id` = '1'
GROUP BY users.id
ORDER BY `solved` DESC in file system/libraries/drivers/Database/Mysql.php on line 379
2008-03-19 14:45:31 -- error: Uncaught Kohana_Database_Exception: There was an SQL error: Table 'milion.milion_milion_submissions' doesn't exist - SELECT year(created) as valone, month(created) as valtwo, sum(solved) as value FROM milion_milion_submissions GROUP BY date_format(created,'%c-%Y') ORDER BY valone, valtwo ASC  in file system/libraries/drivers/Database/Mysql.php on line 379
2008-03-19 15:12:32 -- error: Uncaught PHP Error: Object of class User_Model could not be converted to string in file application/libraries/MY_Controller.php on line 18
2008-03-19 17:41:18 -- error: Uncaught Kohana_Database_Exception: There was an SQL error: Unknown column 'submissions.id' in 'field list' - SELECT `milion_users`.`id`, `milion_users`.`email`, `milion_users`.`username`, `milion_users`.`password`, `milion_users`.`logins`, `milion_users`.`solved`, `milion_users`.`created`, `milion_users`.`keycode`, `milion_users`.`name`, count(distinct submissions.id) as _submissions, count(distinct newss.id) as _newss, count(distinct users_roles.role_id) as _roles
FROM `milion_users` LEFT JOIN `milion_submissions` ON `milion_submissions`.`user_id` = `milion_users`.`id`
LEFT JOIN `milion_newss` ON `milion_newss`.`user_id` = `milion_users`.`id`
LEFT JOIN `milion_users_roles` ON `milion_users_roles`.`user_id` = `milion_users`.`id`
GROUP BY users.id, users.id, users.id in file system/libraries/drivers/Database/Mysql.php on line 379
2008-03-19 17:45:24 -- error: Uncaught Kohana_Database_Exception: There was an SQL error: Unknown column 'submissions.id' in 'field list' - SELECT `milion_users`.`id`, `milion_users`.`email`, `milion_users`.`username`, `milion_users`.`password`, `milion_users`.`logins`, `milion_users`.`solved`, `milion_users`.`created`, `milion_users`.`keycode`, `milion_users`.`name`, count(distinct submissions.id) as _submissions, count(distinct newss.id) as _newss, count(distinct users_roles.role_id) as _roles
FROM `milion_users` LEFT JOIN `milion_submissions` ON `milion_submissions`.`user_id` = `milion_users`.`id`
LEFT JOIN `milion_newss` ON `milion_newss`.`user_id` = `milion_users`.`id`
LEFT JOIN `milion_users_roles` ON `milion_users_roles`.`user_id` = `milion_users`.`id`
GROUP BY users.id, users.id, users.id in file system/libraries/drivers/Database/Mysql.php on line 379
2008-03-19 17:47:56 -- error: Uncaught Kohana_Database_Exception: There was an SQL error: Unknown column 'milion_.submissions.id' in 'field list' - SELECT `milion_users`.`id`, `milion_users`.`email`, `milion_users`.`username`, `milion_users`.`password`, `milion_users`.`logins`, `milion_users`.`solved`, `milion_users`.`created`, `milion_users`.`keycode`, `milion_users`.`name`, count(distinct milion_.submissions.id) as _submissions, count(distinct milion_.newss.id) as _newss, count(distinct users_roles.role_id) as _roles
FROM `milion_users` LEFT JOIN `milion_submissions` ON `milion_submissions`.`user_id` = `milion_users`.`id`
LEFT JOIN `milion_newss` ON `milion_newss`.`user_id` = `milion_users`.`id`
LEFT JOIN `milion_users_roles` ON `milion_users_roles`.`user_id` = `milion_users`.`id`
GROUP BY users.id, users.id, users.id in file system/libraries/drivers/Database/Mysql.php on line 379
2008-03-19 17:48:35 -- error: Uncaught Kohana_Database_Exception: There was an SQL error: Unknown column 'users_roles.role_id' in 'field list' - SELECT `milion_users`.`id`, `milion_users`.`email`, `milion_users`.`username`, `milion_users`.`password`, `milion_users`.`logins`, `milion_users`.`solved`, `milion_users`.`created`, `milion_users`.`keycode`, `milion_users`.`name`, count(distinct milion_submissions.id) as _submissions, count(distinct milion_newss.id) as _newss, count(distinct users_roles.role_id) as _roles
FROM `milion_users` LEFT JOIN `milion_submissions` ON `milion_submissions`.`user_id` = `milion_users`.`id`
LEFT JOIN `milion_newss` ON `milion_newss`.`user_id` = `milion_users`.`id`
LEFT JOIN `milion_users_roles` ON `milion_users_roles`.`user_id` = `milion_users`.`id`
GROUP BY users.id, users.id, users.id in file system/libraries/drivers/Database/Mysql.php on line 379
2008-03-19 17:48:57 -- error: Uncaught Kohana_Database_Exception: There was an SQL error: Table 'milion.milion_milion_users_roles' doesn't exist - SELECT `milion_users`.`id`, `milion_users`.`email`, `milion_users`.`username`, `milion_users`.`password`, `milion_users`.`logins`, `milion_users`.`solved`, `milion_users`.`created`, `milion_users`.`keycode`, `milion_users`.`name`, count(distinct milion_submissions.id) as _submissions, count(distinct milion_newss.id) as _newss, count(distinct milion_milion_users_roles.role_id) as _roles
FROM `milion_users` LEFT JOIN `milion_submissions` ON `milion_submissions`.`user_id` = `milion_users`.`id`
LEFT JOIN `milion_newss` ON `milion_newss`.`user_id` = `milion_users`.`id`
LEFT JOIN `milion_milion_users_roles` ON `milion_milion_users_roles`.`user_id` = `milion_users`.`id`
GROUP BY users.id, users.id, users.id in file system/libraries/drivers/Database/Mysql.php on line 379
2008-03-19 17:49:05 -- error: Uncaught Kohana_Database_Exception: There was an SQL error: Unknown column 'users.id' in 'group statement' - SELECT `milion_users`.`id`, `milion_users`.`email`, `milion_users`.`username`, `milion_users`.`password`, `milion_users`.`logins`, `milion_users`.`solved`, `milion_users`.`created`, `milion_users`.`keycode`, `milion_users`.`name`, count(distinct milion_submissions.id) as _submissions, count(distinct milion_newss.id) as _newss, count(distinct milion_users_roles.role_id) as _roles
FROM `milion_users` LEFT JOIN `milion_submissions` ON `milion_submissions`.`user_id` = `milion_users`.`id`
LEFT JOIN `milion_newss` ON `milion_newss`.`user_id` = `milion_users`.`id`
LEFT JOIN `milion_users_roles` ON `milion_users_roles`.`user_id` = `milion_users`.`id`
GROUP BY users.id, users.id, users.id in file system/libraries/drivers/Database/Mysql.php on line 379
2008-03-19 17:54:44 -- error: Uncaught Kohana_Database_Exception: There was an SQL error: Unknown column 'milion_milion_users.username' in 'field list' - SELECT `milion_newss`.`id`, `milion_newss`.`title`, `milion_newss`.`content`, `milion_milion_users`.`username` AS `user_id`, `milion_newss`.`user_id` AS `_inspector_user_id`, `milion_newss`.`created`
FROM `milion_newss` LEFT JOIN `milion_users` ON `milion_users`.`id` = `milion_newss`.`user_id` in file system/libraries/drivers/Database/Mysql.php on line 379

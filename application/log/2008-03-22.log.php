<?php defined('SYSPATH') or die('No direct script access.'); ?>

2008-03-22 13:38:21 -- error: Nieobsługiwany Kohana_404_Exception: Wywołana strona, scaffoldingv2, nie może zostać znaleziona. w pliku system/core/Kohana.php w lini 576
2008-03-22 14:40:39 -- error: Nieobsługiwany Kohana_Database_Exception: Wystąpił błąd SQL: Table 'milion.milion_categories' doesn't exist - SELECT concat(milion_categories.cube, ' :: ', milion_categories.method) FROM milion_categories WHERE (milion_categories.id = 1 OR milion_categories.id = 2) w pliku system/libraries/drivers/Database/Mysql.php w lini 379
2008-03-22 14:43:04 -- error: Nieobsługiwany Kohana_Database_Exception: Wystąpił błąd SQL: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'concat(milion_categorys.cube, ' :: ', milion_categorys.method) FROM milion_categ' at line 1 - SELECT xD as concat(milion_categorys.cube, ' :: ', milion_categorys.method) FROM milion_categorys WHERE (milion_categorys.id = 1 OR milion_categorys.id = 2) w pliku system/libraries/drivers/Database/Mysql.php w lini 379
2008-03-22 14:54:42 -- error: Nieobsługiwany Kohana_Database_Exception: Wystąpił błąd SQL: Table 'milion.submissions' doesn't exist - SELECT concat(milion_categorys.cube, ' :: ', milion_categorys.method) as xD FROM milion_categorys LEFT JOIN submissions ON milion_submissions.category_id = milion_categorys.id WHERE (milion_categorys.id = 1 OR milion_categorys.id = 'foo') w pliku system/libraries/drivers/Database/Mysql.php w lini 379
2008-03-22 14:54:42 -- error: Nieobsługiwany Kohana_Database_Exception: Wystąpił błąd SQL: Table 'milion.submissions' doesn't exist - SELECT concat(milion_categorys.cube, ' :: ', milion_categorys.method) as xD FROM milion_categorys LEFT JOIN submissions ON milion_submissions.category_id = milion_categorys.id WHERE (milion_categorys.id = 1 OR milion_categorys.id = 'foo') w pliku system/libraries/drivers/Database/Mysql.php w lini 379
2008-03-22 14:57:36 -- error: Nieobsługiwany Kohana_Database_Exception: Wystąpił błąd SQL: Unknown column 'milion_solved.id' in 'field list' - SELECT concat(milion_categorys.cube, ' :: ', milion_categorys.method) as xD, count(distinct milion_solved.id) as solved FROM milion_categorys LEFT JOIN milion_submissions ON milion_submissions.category_id = milion_categorys.id WHERE (milion_categorys.id = 1 OR milion_categorys.id = 'foo') GROUP BY milion_categorys.id w pliku system/libraries/drivers/Database/Mysql.php w lini 379
2008-03-22 16:31:52 -- error: Nieobsługiwany Kohana_Database_Exception: Wystąpił błąd SQL: Unknown column 'milion_milion_submissions.category_id' in 'where clause' - SELECT year(created) as valone, month(created) as valtwo, sum(solved) as value FROM milion_submissions WHERE (milion_milion_submissions.category_id = '1') GROUP BY date_format(created,'%c-%Y') ORDER BY valone, valtwo ASC w pliku system/libraries/drivers/Database/Mysql.php w lini 379
2008-03-22 17:03:05 -- error: Nieobsługiwany Kohana_Database_Exception: Wystąpił błąd SQL: Table 'milion.milion_newss' doesn't exist - SELECT `milion_newss`.*, `milion_users`.`username` AS `author`
FROM `milion_newss` JOIN `milion_users` ON `milion_users`.`id` = `milion_newss`.`user_id`
ORDER BY `created` DESC
LIMIT 0, 10 w pliku system/libraries/drivers/Database/Mysql.php w lini 379
2008-03-22 17:03:47 -- error: Nieobsługiwany Kohana_Database_Exception: Wystąpił błąd SQL: Table 'milion.milion_newss' doesn't exist - SELECT `milion_users`.`id`, `milion_users`.`email`, `milion_users`.`username`, `milion_users`.`password`, `milion_users`.`logins`, `milion_users`.`solved`, `milion_users`.`created`, `milion_users`.`keycode`, `milion_users`.`name`, count(distinct milion_submissions.id) as _submissions, count(distinct milion_newss.id) as _newss, count(distinct milion_users_roles.role_id) as _roles
FROM `milion_users` LEFT JOIN `milion_submissions` ON `milion_submissions`.`user_id` = `milion_users`.`id`
LEFT JOIN `milion_newss` ON `milion_newss`.`user_id` = `milion_users`.`id`
LEFT JOIN `milion_users_roles` ON `milion_users_roles`.`user_id` = `milion_users`.`id`
GROUP BY milion_users.id, milion_users.id, milion_users.id w pliku system/libraries/drivers/Database/Mysql.php w lini 379
2008-03-22 17:05:27 -- error: Nieobsługiwany Kohana_Database_Exception: Wystąpił błąd SQL: Table 'milion.milion_newss' doesn't exist - SELECT `milion_users`.`id`, `milion_users`.`email`, `milion_users`.`username`, `milion_users`.`password`, `milion_users`.`logins`, `milion_users`.`solved`, `milion_users`.`created`, `milion_users`.`keycode`, `milion_users`.`name`, count(distinct milion_submissions.id) as _submissions, count(distinct milion_newss.id) as _newss, count(distinct milion_users_roles.role_id) as _roles
FROM `milion_users` LEFT JOIN `milion_submissions` ON `milion_submissions`.`user_id` = `milion_users`.`id`
LEFT JOIN `milion_newss` ON `milion_newss`.`user_id` = `milion_users`.`id`
LEFT JOIN `milion_users_roles` ON `milion_users_roles`.`user_id` = `milion_users`.`id`
GROUP BY milion_users.id, milion_users.id, milion_users.id w pliku system/libraries/drivers/Database/Mysql.php w lini 379
2008-03-22 17:05:44 -- error: Nieobsługiwany Kohana_Database_Exception: Wystąpił błąd SQL: Table 'milion.milion_newss' doesn't exist - SELECT `milion_users`.`id`, `milion_users`.`email`, `milion_users`.`username`, `milion_users`.`password`, `milion_users`.`logins`, `milion_users`.`solved`, `milion_users`.`created`, `milion_users`.`keycode`, `milion_users`.`name`, count(distinct milion_submissions.id) as _submissions, count(distinct milion_newss.id) as _newss, count(distinct milion_users_roles.role_id) as _roles
FROM `milion_users` LEFT JOIN `milion_submissions` ON `milion_submissions`.`user_id` = `milion_users`.`id`
LEFT JOIN `milion_newss` ON `milion_newss`.`user_id` = `milion_users`.`id`
LEFT JOIN `milion_users_roles` ON `milion_users_roles`.`user_id` = `milion_users`.`id`
GROUP BY milion_users.id, milion_users.id, milion_users.id w pliku system/libraries/drivers/Database/Mysql.php w lini 379
2008-03-22 17:17:45 -- error: Nieobsługiwany Kohana_Database_Exception: Wystąpił błąd SQL: Table 'milion.milion_newss' doesn't exist - SELECT `milion_users`.`id`, `milion_users`.`email`, `milion_users`.`username`, `milion_users`.`password`, `milion_users`.`logins`, `milion_users`.`solved`, `milion_users`.`created`, `milion_users`.`keycode`, `milion_users`.`name`, count(distinct milion_submissions.id) as _submissions, count(distinct milion_newss.id) as _newss, count(distinct milion_users_roles.role_id) as _roles
FROM `milion_users` LEFT JOIN `milion_submissions` ON `milion_submissions`.`user_id` = `milion_users`.`id`
LEFT JOIN `milion_newss` ON `milion_newss`.`user_id` = `milion_users`.`id`
LEFT JOIN `milion_users_roles` ON `milion_users_roles`.`user_id` = `milion_users`.`id`
GROUP BY milion_users.id, milion_users.id, milion_users.id w pliku system/libraries/drivers/Database/Mysql.php w lini 379
2008-03-22 17:18:51 -- error: t2r: users  -> user_id
2008-03-22 17:18:51 -- error: t2r: users  -> user_id
2008-03-22 17:18:51 -- error: t2r: users  -> user_id
2008-03-22 17:18:51 -- error: t2r: roles  -> role_id
2008-03-22 17:18:51 -- error: Nieobsługiwany Kohana_Database_Exception: Wystąpił błąd SQL: Table 'milion.milion_newss' doesn't exist - SELECT `milion_users`.`id`, `milion_users`.`email`, `milion_users`.`username`, `milion_users`.`password`, `milion_users`.`logins`, `milion_users`.`solved`, `milion_users`.`created`, `milion_users`.`keycode`, `milion_users`.`name`, count(distinct milion_submissions.id) as _submissions, count(distinct milion_newss.id) as _newss, count(distinct milion_users_roles.role_id) as _roles
FROM `milion_users` LEFT JOIN `milion_submissions` ON `milion_submissions`.`user_id` = `milion_users`.`id`
LEFT JOIN `milion_newss` ON `milion_newss`.`user_id` = `milion_users`.`id`
LEFT JOIN `milion_users_roles` ON `milion_users_roles`.`user_id` = `milion_users`.`id`
GROUP BY milion_users.id, milion_users.id, milion_users.id w pliku system/libraries/drivers/Database/Mysql.php w lini 379
2008-03-22 17:30:35 -- error: Nieobsługiwany Kohana_Database_Exception: Wystąpił błąd SQL: Unknown table 'milion_newss' - SELECT `milion_newss`.*, `milion_users`.`username` AS `author`
FROM `milion_posts` JOIN `milion_users` ON `milion_users`.`id` = `milion_newss`.`user_id`
ORDER BY `created` DESC
LIMIT 0, 10 w pliku system/libraries/drivers/Database/Mysql.php w lini 379
2008-03-22 17:30:54 -- error: Nieobsługiwany Kohana_Database_Exception: Wystąpił błąd SQL: Unknown column 'milion_newss.user_id' in 'on clause' - SELECT `milion_posts`.*, `milion_users`.`username` AS `author`
FROM `milion_posts` JOIN `milion_users` ON `milion_users`.`id` = `milion_newss`.`user_id`
ORDER BY `created` DESC
LIMIT 0, 10 w pliku system/libraries/drivers/Database/Mysql.php w lini 379
2008-03-22 17:32:08 -- error: Nieobsługiwany Kohana_Database_Exception: Wystąpił błąd SQL: Unknown column 'Array' in 'where clause' - DELETE FROM `milion_posts` WHERE `id` = Array w pliku system/libraries/drivers/Database/Mysql.php w lini 379
2008-03-22 18:02:38 -- error: Nieobsługiwany Kohana_Database_Exception: Wystąpił błąd SQL: Unknown column 'milion_categorys.id' in 'where clause' - SELECT `milion_categories`.`id`, `milion_categories`.`cube`, `milion_categories`.`method`
FROM `milion_categories`
WHERE `milion_categorys`.`id` = '1'
LIMIT 0, 1 w pliku system/libraries/drivers/Database/Mysql.php w lini 379
2008-03-22 18:04:27 -- error: Nieobsługiwany Kohana_Database_Exception: Wystąpił błąd SQL: Unknown column 'milion_categorys.id' in 'where clause' - SELECT `milion_categories`.`id`, `milion_categories`.`cube`, `milion_categories`.`method`
FROM `milion_categories`
WHERE `milion_categorys`.`id` = '1'
LIMIT 0, 1 w pliku system/libraries/drivers/Database/Mysql.php w lini 379
2008-03-22 18:05:35 -- error: Nieobsługiwany Kohana_Database_Exception: Wystąpił błąd SQL: Unknown column 'milion_categorys.id' in 'where clause' - SELECT `milion_categories`.`id`, `milion_categories`.`cube`, `milion_categories`.`method`
FROM `milion_categories`
WHERE `milion_categorys`.`id` = '1'
LIMIT 0, 1 w pliku system/libraries/drivers/Database/Mysql.php w lini 379
2008-03-22 18:05:38 -- error: Nieobsługiwany Kohana_Database_Exception: Wystąpił błąd SQL: Unknown column 'milion_categorys.id' in 'where clause' - SELECT `milion_categories`.`id`, `milion_categories`.`cube`, `milion_categories`.`method`
FROM `milion_categories`
WHERE `milion_categorys`.`id` = '1'
LIMIT 0, 1 w pliku system/libraries/drivers/Database/Mysql.php w lini 379
2008-03-22 18:44:06 -- error: Nieobsługiwany Kohana_Exception: Unknown Exception: 1 w pliku modules/scaffolding/libraries/Model_Inspect.php w lini 20
2008-03-22 18:44:23 -- error: Nieobsługiwany Kohana_Database_Exception: Unknown Exception: eer w pliku modules/scaffolding/libraries/Model_Inspect.php w lini 20
2008-03-22 19:13:15 -- error: Nieobsługiwany Kohana_Database_Exception: Wystąpił błąd SQL: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'AS `user_id`, `milion_submissions`.`user_id` AS `_inspector_user_id`, `milion_su' at line 1 - SELECT `milion_submissions`.`id`, `milion_users`. AS `user_id`, `milion_submissions`.`user_id` AS `_inspector_user_id`, `milion_submissions`.`solved`, `milion_submissions`.`created`, `milion_categories`. AS `category_id`, `milion_submissions`.`category_id` AS `_inspector_category_id`
FROM `milion_submissions` LEFT JOIN `milion_users` ON `milion_users`.`id` = `milion_submissions`.`user_id`
LEFT JOIN `milion_categories` ON `milion_categories`.`id` = `milion_submissions`.`category_id`
LIMIT 0, 50 w pliku system/libraries/drivers/Database/Mysql.php w lini 379
2008-03-22 19:14:20 -- error: Nieobsługiwany Kohana_Database_Exception: Wystąpił błąd SQL: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'AS `user_id`, `milion_submissions`.`user_id` AS `_inspector_user_id`, `milion_su' at line 1 - SELECT `milion_submissions`.`id`, `milion_users`. AS `user_id`, `milion_submissions`.`user_id` AS `_inspector_user_id`, `milion_submissions`.`solved`, `milion_submissions`.`created`, `milion_categories`. AS `category_id`, `milion_submissions`.`category_id` AS `_inspector_category_id`
FROM `milion_submissions` LEFT JOIN `milion_users` ON `milion_users`.`id` = `milion_submissions`.`user_id`
LEFT JOIN `milion_categories` ON `milion_categories`.`id` = `milion_submissions`.`category_id`
LIMIT 0, 50 w pliku system/libraries/drivers/Database/Mysql.php w lini 379
2008-03-22 19:16:57 -- error: Nieobsługiwany Kohana_Database_Exception: Wystąpił błąd SQL: Unknown column 'as category_id' in 'field list' - SELECT `milion_submissions`.`id`, `as category_id`, `milion_submissions`.`user_id` AS `_inspector_user_id`, `milion_submissions`.`solved`, `milion_submissions`.`created`, `milion_submissions`.`category_id` AS `_inspector_category_id`
FROM `milion_submissions` LEFT JOIN `milion_users` ON `milion_users`.`id` = `milion_submissions`.`user_id`
LEFT JOIN `milion_categories` ON `milion_categories`.`id` = `milion_submissions`.`category_id`
LIMIT 0, 50 w pliku system/libraries/drivers/Database/Mysql.php w lini 379
2008-03-22 19:17:50 -- error: Nieobsługiwany Kohana_Database_Exception: Wystąpił błąd SQL: Unknown column 'as category_id' in 'field list' - SELECT `milion_submissions`.`id`, `as category_id`, `milion_submissions`.`user_id` AS `_inspector_user_id`, `milion_submissions`.`solved`, `milion_submissions`.`created`, `milion_submissions`.`category_id` AS `_inspector_category_id`
FROM `milion_submissions` LEFT JOIN `milion_users` ON `milion_users`.`id` = `milion_submissions`.`user_id`
LEFT JOIN `milion_categories` ON `milion_categories`.`id` = `milion_submissions`.`category_id`
LIMIT 0, 50 w pliku system/libraries/drivers/Database/Mysql.php w lini 379
2008-03-22 19:20:24 -- error: Nieobsługiwany Kohana_Database_Exception: Wystąpił błąd SQL: Unknown column ''aaa'' in 'field list' - SELECT `milion_submissions`.`id`, `milion_users`.`username` AS `user_id`, `milion_submissions`.`user_id` AS `_inspector_user_id`, `milion_submissions`.`solved`, `milion_submissions`.`created`, `'aaa'` AS `category_id`, `milion_submissions`.`category_id` AS `_inspector_category_id`
FROM `milion_submissions` LEFT JOIN `milion_users` ON `milion_users`.`id` = `milion_submissions`.`user_id`
LEFT JOIN `milion_categories` ON `milion_categories`.`id` = `milion_submissions`.`category_id`
LIMIT 0, 50 w pliku system/libraries/drivers/Database/Mysql.php w lini 379
2008-03-22 19:21:15 -- error: Nieobsługiwany Kohana_Database_Exception: Wystąpił błąd SQL: Unknown column 'milion_users.users.username' in 'field list' - SELECT `milion_users`.`id`, `milion_users`.`users`.`username` AS `key`
FROM `milion_users` w pliku system/libraries/drivers/Database/Mysql.php w lini 379
2008-03-22 20:06:40 -- error: Nieobsługiwany PHP Error: Argument 1 passed to Model_Inspector_Core::getList() must be an instance of Query, instance of Database given, called in /opt/lampp/htdocs/milion/modules/scaffolding/libraries/Model_Inspector.php on line 303 and defined w pliku modules/scaffolding/libraries/Model_Inspector.php w lini 249
2008-03-22 20:18:32 -- error: Nieobsługiwany PHP Error: Argument 1 passed to Model_Inspector_Core::getList() must be an instance of Query, instance of Query_Core given, called in /opt/lampp/htdocs/milion/modules/scaffolding/libraries/Scaffolding.php on line 133 and defined w pliku modules/scaffolding/libraries/Model_Inspector.php w lini 249
2008-03-22 20:19:48 -- error: Nieobsługiwany PHP Error: Argument 1 passed to Model_Inspector_Core::getList() must be an instance of Query, instance of Query_Core given, called in /opt/lampp/htdocs/milion/modules/scaffolding/libraries/Scaffolding.php on line 134 and defined w pliku modules/scaffolding/libraries/Model_Inspector.php w lini 249
2008-03-22 20:21:01 -- error: Nieobsługiwany Kohana_Database_Exception: Wystąpił błąd SQL: Column 'id' in field list is ambiguous - SELECT id as _keyfield, milion_submissions.id, milion_users.username as user_id, milion_submissions.user_id as _inspector_user_id, milion_submissions.solved, milion_submissions.created, 'aaa' as category_id, milion_submissions.category_id as _inspector_category_id FROM milion_submissions LEFT JOIN milion_users ON milion_users.id = milion_submissions.user_id LEFT JOIN milion_categories ON milion_categories.id = milion_submissions.category_id WHERE milion_submissions.id = '1' LIMIT 1 w pliku system/libraries/drivers/Database/Mysql.php w lini 379
2008-03-22 20:21:39 -- error: Nieobsługiwany Kohana_Database_Exception: Wystąpił błąd SQL: Unknown column ''aaa'' in 'field list' - SELECT `milion_categories`.`id`, `'aaa'` AS `key`
FROM `milion_categories` w pliku system/libraries/drivers/Database/Mysql.php w lini 379
2008-03-22 20:23:14 -- error: Nieobsługiwany PHP Error: Argument 1 passed to Model_Inspector_Core::GetKeyList() must be an instance of Query, instance of Database given, called in /opt/lampp/htdocs/milion/modules/scaffolding/libraries/Scaffolding.php on line 222 and defined w pliku modules/scaffolding/libraries/Model_Inspector.php w lini 291
2008-03-22 20:24:05 -- error: Nieobsługiwany Kohana_Database_Exception: Wystąpił błąd SQL: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'key, milion_users.id,  FROM milion_users' at line 1 - SELECT milion_users.username as key, milion_users.id,  FROM milion_users w pliku system/libraries/drivers/Database/Mysql.php w lini 379
2008-03-22 20:24:34 -- error: Nieobsługiwany Kohana_Database_Exception: Wystąpił błąd SQL: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'key, milion_users.id FROM milion_users' at line 1 - SELECT milion_users.username as key, milion_users.id FROM milion_users w pliku system/libraries/drivers/Database/Mysql.php w lini 379
2008-03-22 20:26:32 -- error: Nieobsługiwany Kohana_Database_Exception: Wystąpił błąd SQL: Table 'milion.milion_problemsets' doesn't exist - SELECT COUNT(*) AS records_found
FROM `milion_problemsets` w pliku system/libraries/drivers/Database/Mysql.php w lini 379
2008-03-22 20:27:10 -- error: Nieobsługiwany Kohana_Database_Exception: Wystąpił błąd SQL: FUNCTION milion_categories.concat does not exist - SELECT milion_categories.concat(milion_categories.cube, ' :: ',milion_categories.method) as _keyfield, milion_categories.id, milion_categories.cube, milion_categories.method FROM milion_categories WHERE milion_categories.id = '1' LIMIT 1 w pliku system/libraries/drivers/Database/Mysql.php w lini 379
2008-03-22 20:28:25 -- error: Nieobsługiwany Kohana_Database_Exception: Wystąpił błąd SQL: Column 'id' in field list is ambiguous - SELECT id as _keyfield, milion_submissions.id, milion_users.username as user_id, milion_submissions.user_id as _inspector_user_id, milion_submissions.solved, milion_submissions.created, concat(milion_categories.cube, ' :: ',milion_categories.method) as category_id, milion_submissions.category_id as _inspector_category_id FROM milion_submissions LEFT JOIN milion_users ON milion_users.id = milion_submissions.user_id LEFT JOIN milion_categories ON milion_categories.id = milion_submissions.category_id WHERE milion_submissions.id = '2' LIMIT 1 w pliku system/libraries/drivers/Database/Mysql.php w lini 379
2008-03-22 20:30:00 -- error: Nieobsługiwany Kohana_Database_Exception: Wystąpił błąd SQL: Unknown column 'milion_submissions.submissions.id' in 'field list' - SELECT `milion_submissions`.`id` AS `id`, `milion_submissions`.`submissions`.`id` AS `name`
FROM `milion_submissions`
WHERE `milion_submissions`.`user_id` = '4' w pliku system/libraries/drivers/Database/Mysql.php w lini 379

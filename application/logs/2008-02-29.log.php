<?php defined('SYSPATH') or die('No direct script access.'); ?>

2008-02-29 23:06:40 -- error: Uncaught Kohana_Database_Exception: There was an SQL error: Unknown column 'year(created)' in 'where clause' - SELECT day(created) as valone, sum(solved) as value
FROM `submissions`
WHERE `year(created)` = '2007'
AND `month(created)` = '2'
OR `submissions`.`category_id` = '2'
GROUP BY date_format(created, '%c-%Y')
ORDER BY `valone`,`valtwo` in file system/libraries/drivers/Database/Mysql.php on line 378
2008-02-29 23:06:55 -- error: Uncaught Kohana_Database_Exception: There was an SQL error: Unknown column 'year(created)' in 'where clause' - SELECT day(created) as valone, sum(solved) as value
FROM `submissions`
WHERE `year(created)` = 2007
AND `month(created)` = '2'
OR `submissions`.`category_id` = '2'
GROUP BY date_format(created, '%c-%Y')
ORDER BY `valone`,`valtwo` in file system/libraries/drivers/Database/Mysql.php on line 378
2008-02-29 23:08:23 -- error: Uncaught Kohana_Database_Exception: There was an SQL error: Unknown column 'year(created)' in 'where clause' - SELECT day(created) as valone, sum(solved) as value
FROM `submissions`
WHERE `year(created)` = 2007
AND `month(created)` = '2'
OR `submissions`.`category_id` = '2'
GROUP BY date_format(created, '%c-%Y')
ORDER BY `valone`,`valtwo` in file system/libraries/drivers/Database/Mysql.php on line 378
2008-02-29 23:08:54 -- error: Uncaught Kohana_Database_Exception: There was an SQL error: Unknown column 'year' in 'where clause' - SELECT day(created) as valone, year(created) as year, month(created) as month, sum(solved) as value
FROM `submissions`
WHERE `year` = 2007
AND `month` = '2'
OR `submissions`.`category_id` = '2'
GROUP BY date_format(created, '%c-%Y')
ORDER BY `valone`,`valtwo` in file system/libraries/drivers/Database/Mysql.php on line 378
2008-02-29 23:14:18 -- error: Uncaught Kohana_Database_Exception: There was an SQL error: Unknown column 'yearx' in 'where clause' - SELECT day(created) as valone, year(created) as yearx, month(created) as month, sum(solved) as value
FROM `submissions`
WHERE `yearx` = 2007
AND `month` = '2'
OR `submissions`.`category_id` = '2'
GROUP BY date_format(created, '%c-%Y')
ORDER BY `valone`,`valtwo` in file system/libraries/drivers/Database/Mysql.php on line 378
2008-02-29 23:29:44 -- error: Uncaught Kohana_Database_Exception: There was an SQL error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'day(created)  valone' at line 1 - SELECT day(created) as valone, year(created) as yearx, month(created) as month, sum(solved) as value FROM submissions WHERE   year(created)='2007' AND month(created)='2' AND   (submissions.category_id='2')  day(created)  valone  in file system/libraries/drivers/Database/Mysql.php on line 378

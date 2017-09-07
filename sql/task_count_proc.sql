DELIMITER //
DROP PROCEDURE IF EXISTS sysco.getTaskCount
//

CREATE PROCEDURE sysco.getTaskCount(IN userid int, IN task_status_id int, OUT taskCount INT)
 BEGIN
 SET taskCount=0;
 SELECT count(*) INTO taskCount
 FROM task
 WHERE assigned_to = userid and task_status = task_status_id;
 END //

DROP PROCEDURE IF EXISTS sysco.getMonthlyTaskCount
//

CREATE PROCEDURE sysco.getMonthlyTaskCount(IN userid int, IN monthName varchar(15), OUT mothlyTaskCount INT)
 BEGIN
 SET mothlyTaskCount=0;
 SELECT count(*) INTO mothlyTaskCount
 FROM task
 WHERE assigned_to = userid and MONTHNAME(assigned_date) = monthName;
 END //
DELIMITER ;
USE Breezedemo;

DROP PROCEDURE IF EXISTS sp_GetAllusers;

DELIMITER $$

CREATE PROCEDURE sp_GetAllusers(
    IN p_user_Id INTEGER
)
BEGIN
 SELECT USRS.Id
        ,USRS.name
        ,USRS.email
        ,USRS.rolename
     FROM Users AS USRS
    WHERE USRS.Id <> p_user_Id;
END $$
DELIMITER ;
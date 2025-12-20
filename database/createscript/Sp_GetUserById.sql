USE Breezedemo;

DROP PROCEDURE IF EXISTS sp_GetUserById;

DELIMITER $$
CREATE PROCEDURE sp_GetUserById(
    IN p_Id INTEGER
)
BEGIN
    SELECT USRS.Id
           , USRS.Name
           , USRS.Email
           , USRS.rolename
    FROM users AS USRS
    WHERE USRS.Id = p_Id;
END $$
DELIMITER ;    
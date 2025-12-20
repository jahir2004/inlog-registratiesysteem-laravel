USE Breezedemo;

DROP PROCEDURE IF EXISTS sp_updateUser;

DELIMITER $$
CREATE PROCEDURE sp_updateUser(
    IN p_Id INTEGER,
    IN p_Name VARCHAR(50),
    IN p_Email VARCHAR(100),
    IN p_Rolename VARCHAR(50)
)

BEGIN
    UPDATE Users AS USRS
    SET USRS.Name = p_Name,
        USRS.Email = p_Email,
        USRS.Rolename = p_Rolename
    WHERE USRS.Id = p_Id;
END $$
DELIMITER ;
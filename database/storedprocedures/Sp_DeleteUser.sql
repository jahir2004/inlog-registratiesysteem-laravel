USE Breezedemo;

DROP PROCEDURE IF EXISTS sp_DeleteUser;

DELIMITER $$
CREATE PROCEDURE sp_DeleteUser(
    IN p_Id INTEGER
)
BEGIN
    DELETE FROM users
    WHERE id = p_Id;

    SELECT ROW_COUNT() AS affected_rows;
END $$
DELIMITER ;

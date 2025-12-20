<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::unprepared('DROP PROCEDURE IF EXISTS sp_GetUserById');

        DB::unprepared(<<<'SQL'
CREATE PROCEDURE sp_GetUserById(IN p_Id INTEGER)
BEGIN
    SELECT
        USRS.Id,
        USRS.Name,
        USRS.Email,
        USRS.rolename
    FROM users AS USRS
    WHERE USRS.Id = p_Id;
END
SQL);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP PROCEDURE IF EXISTS sp_GetUserById');
    }
};

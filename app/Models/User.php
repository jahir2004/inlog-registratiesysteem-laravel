<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'rolename',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function sp_GetAllusers($user_Id)
    {
        $result = DB::select('CALL sp_GetAllusers(?)', [$user_Id]);
        
        return $result;
    }

    public function sp_GetUserById($user_Id)
    {
        $result = DB::select('CALL sp_GetUserById(?)', [$user_Id]);
        
        return $result;
    }

    public function sp_GetAllUserroles()
    {
        $result = DB::select('CALL sp_GetAllUserroles()');
        
        return $result;
    }

    public function sp_UpdateUser($id, $name, $email, $rolename)
    {
        $result = DB::select('CALL sp_UpdateUser(:id, :name, :email, :rolename)', [
            'id' => $id, 
            'name' => $name, 
            'email' => $email, 
            'rolename' => $rolename
        ]);
        
        return $result;
    }

    public function sp_DeleteUser($userId)
    {
        $result = DB::select('CALL sp_DeleteUser(?)', [$userId]);

        return $result;
    }

    /**
     * Check if the user has a specific role.
     */
    public function hasRole($role): bool
    {
        return $this->rolename === $role;
    }
}

<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Sortable;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'users';


	public $sortable = ['id', 'name', 'email','phone_number', 'status'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone_number',
        'is_active'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'roles' => 'array',
    ];

    public function roles()
    {
        return $this->belongsToMany(RoleMaster::class, 'role_user', 'user_id', 'role_id');
    }

    public function hasRole($roleCode)
    {
        return $this->roles()->where('role_code', $roleCode)->exists();
    }

    public function hasAnyRole($roleCodes)
    {
        return $this->roles()->whereIn('role_code', $roleCodes)->exists();
    }

    public function printRoles()
    {
        return $this->roles()->pluck('role_name')->implode(', ');
    }

    public function listRoles()
    {
        return $this->roles()->pluck('role_name');
    }

}

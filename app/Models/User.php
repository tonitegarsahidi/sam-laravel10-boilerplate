<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Jobs\SendEmailVerifyEmailJob;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes, HasUuids;

    protected $table = 'users';


	public $sortable = ['id', 'name', 'email','phone_number', 'status'];

    protected $keyType = 'string';
    public $incrementing = false;

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

    // Define the one-to-one relationship with UserProfile
    public function profile()
    {
        return $this->hasOne(UserProfile::class);
    }

    public function listRoles()
    {
        return $this->roles()->pluck('role_name');
    }

    public function sendEmailVerificationNotification()
    {
        SendEmailVerifyEmailJob::dispatch($this);
    }

}

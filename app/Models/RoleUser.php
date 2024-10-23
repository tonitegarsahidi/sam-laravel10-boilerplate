<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleUser extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'role_user';

    protected $fillable = ['user_id', 'role_id'];

    protected $keyType = 'string';
    public $incrementing = false;

    // Corrected relationship to reference the Role model
    public function role()
    {
        return $this->belongsTo(RoleMaster::class, 'role_id');
    }

    // Define a relationship back to the User model
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}

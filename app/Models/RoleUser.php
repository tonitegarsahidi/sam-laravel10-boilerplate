<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleUser extends Model
{
    use HasFactory;

    protected $table = 'role_user';

    public function roleMaster()
    {
        return $this->belongsToMany(RoleUser::class, 'role_user');
    }

}

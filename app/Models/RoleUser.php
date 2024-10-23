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

    public function roleMaster()
    {
        return $this->belongsToMany(RoleUser::class, 'role_user');
    }

}

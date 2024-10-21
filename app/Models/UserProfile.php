<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserProfile extends Model
{
    use HasFactory, SoftDeletes;

    // Fillable attributes for mass assignment
    protected $fillable = [
        'user_id',
        'date_of_birth',
        'gender',
        'address',
        'city',
        'country',
        'profile_picture',
        'created_by',
        'updated_by',
    ];

    // Define the one-to-one relationship with User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

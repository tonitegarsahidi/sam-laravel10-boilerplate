<?php

namespace App\Models;

use App\Models\Saas\SubscriptionMaster;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubscriptionUser extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'subscription_user';

    protected $fillable = [
        'user',
        'package',
        'start_date',
        'expired_date',
        'is_suspended',
        'created_by',
        'updated_by',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user', 'id');
    }

    public function package()
    {
        return $this->belongsTo(SubscriptionMaster::class, 'package', 'id');
    }

    public function histories()
    {
        return $this->hasMany(SubscriptionHistory::class, 'subscription_user_id');
    }
}

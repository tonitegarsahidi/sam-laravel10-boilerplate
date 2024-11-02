<?php

namespace App\Models\Saas;

use App\Models\Saas\SubscriptionMaster;
use App\Models\User;
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
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function package()
    {
        return $this->belongsTo(SubscriptionMaster::class, 'package_id', 'id');
    }

    public function histories()
    {
        return $this->hasMany(SubscriptionHistory::class, 'subscription_user_id');
    }
}

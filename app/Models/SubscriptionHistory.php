<?php

namespace App\Models;

use App\Models\Saas\SubscriptionMaster;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubscriptionHistory extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'subscription_history';

    protected $fillable = [
        'user',
        'package',
        'package_price_snapshot',
        'payment_reference_id',
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


public function subscriptionUser()
{
    return $this->belongsTo(SubscriptionUser::class, 'subscription_user_id');
}
}

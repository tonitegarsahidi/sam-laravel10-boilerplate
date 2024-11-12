<?php

namespace App\Repositories\Saas;

use App\Models\Saas\SubscriptionHistory;
use Exception;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Log;

class SubscriptionHistoryRepository
{

    public function addNewSubscriptionHistory(  $subscriptionId,
                                                $subscriptionAction,
                                                $packagePriceSnapshot = null,
                                                $paymentReference = null,
                                                $initiator = "system") : SubscriptionHistory
    {
        $data = [
            "subscription_user_id"  => $subscriptionId,
            "subscription_action"  => $subscriptionAction,
            "package_price_snapshot"  => $packagePriceSnapshot,
            "payment_reference"  => $paymentReference,
            "created_by"  => $initiator,
            "updated_by"  => $initiator,
        ];

        Log::debug("isinya data subscription history ", ["data"  => $data]);

        return SubscriptionHistory::create($data);
    }


}

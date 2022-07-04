<?php

namespace App\Observers;

use App\Transaction\Delivery;

class DeliveryObserver
{
    public function created(Delivery $delivery)
    {
        $delivery->transaction_code = 'DR' . now()->format('Y') . now()->format('m') . '-' . str_pad($delivery->id, 7, '0', STR_PAD_LEFT);
        $delivery->update();
    }
}

<?php

namespace App\Observers;

use App\Transaction\PurchaseOrder;

class PurchaseOrderObserver
{
    public function created(PurchaseOrder $purchaseOrder)
    {
        $purchaseOrder->transaction_code = now()->format('Y') . now()->format('m') . '-' . 'PO' . str_pad($purchaseOrder->id, 7, '0', STR_PAD_LEFT);
        $purchaseOrder->update();
    }
}

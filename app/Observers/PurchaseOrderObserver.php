<?php

namespace App\Observers;

use Illuminate\Support\Facades\Auth;

use App\Transaction\PurchaseOrder;

class PurchaseOrderObserver
{
    public function created(PurchaseOrder $purchaseOrder)
    {
        $purchaseOrder->transaction_code = now()->format('Y') . now()->format('m') . '-' . 'PO' . str_pad($purchaseOrder->id, 7, '0', STR_PAD_LEFT);
        $purchaseOrder->prepared_by_id = Auth::id();
        $purchaseOrder->update();
    }
}

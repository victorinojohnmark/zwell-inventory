<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Transaction\PurchaseOrder;

class TransactionController extends Controller
{
    public function reportpurchaseorderview(Request $request)
    {
        if(isset($request->start_date) && isset($request->end_date)) {

        } else {
            return view('report.transaction.purchaseorder', [
                'purchaseOrders' => PurchaseOrder::latest()->take(50)->get()
            ]);
        }
    }
}

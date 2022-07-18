<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\System\LogicCRUD;

class InventoryController extends Controller
{
    public function stockview(Request $request)
    {
        return view('report.inventory.stockview', [
            'location_id' => $request->location_id,
            'locations' => LogicCRUD::retrieveRecord('Location', 'Master', $id = null, $limitter = null, $active = true),
            'items' => LogicCRUD::retrieveRecord('Item', 'Master', $id = null, $limitter = null, $active = true)
        ]);
    }

}

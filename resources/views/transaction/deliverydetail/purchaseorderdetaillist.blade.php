

<div class="card {{ is_null($delivery->id)? 'd-none' : null }}">
    <div class="card-header">
        <strong>PO Item Reference</strong>
    </div>
    <div class="card-body p-0">     

        <!-- PURCHASE ORDER DETAILS-->
        @if ($delivery->purchaseOrder)
            <div class="table-responsive">
                <table id="" class="table table-hover datatables">
                    <thead>
                        <tr>
                            <th scope="col">Item</th>
                            <th scope="col">Unit Cost</th>
                            <th scope="col">Completed Delivered QTY.</th>
                        </tr>
                    </thead>
                    <tbody> 
                        @forelse ($delivery->purchaseOrder->purchaseOrderDetails as $purchaseOrderDetail)
                        <tr>
                            <td>{{ $purchaseOrderDetail->item->item_name }}</td>
                            <td><span class="badge badge-secondary">{{ 'Php ' . number_format($purchaseOrderDetail->unit_cost, 2) }}</span></td>
                            {{-- <td><span class="badge badge-secondary">{{ $purchaseOrderDetail->purchaseOrder->total_completed_delivery_per_item($purchaseOrderDetail->item_id) . '/'. ($purchaseOrderDetail->quantity + 0) }} {{ $purchaseOrderDetail->item->unit }}</span></td> --}}
                            <td><span class="badge badge-secondary">{{ ($purchaseOrderDetail->item->total_delivery_completed + 0) . '/'. ($purchaseOrderDetail->quantity + 0) }} {{ $purchaseOrderDetail->item->unit }}</span></td>
                        </tr>
                        @empty
                        <tr><td colspan="5">No PO Item record/s available.</td></tr>
                        @endforelse                 
                    </tbody>
                </table>
            </div>
        @endif
        
        
    </div>
</div>
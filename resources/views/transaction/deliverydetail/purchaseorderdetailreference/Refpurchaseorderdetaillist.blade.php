<div class="table-responsive">
    <table id="" class="table table-hover datatables">
        <thead>
            <tr>
                <th scope="col">Item</th>
                <th scope="col">Quantity</th>
                <th scope="col">Unit Cost</th>
                <th scope="col">Total Amount</th>
                <th scope="col">Options</th>
            </tr>
        </thead>
        <tbody> 
            @forelse ($delivery->purchaseOrder->purchaseOrderDetails as $purchaseOrderDetail)
            <tr>
                <td>{{ $purchaseOrderDetail->item->item_name }}</td>
                <td>{{ $purchaseOrderDetail->quantity + 0 }} {{ $purchaseOrderDetail->item->unit }}</td>
                {{-- <td>{{ $purchaseOrderDetail->TotalDeliveredItems }}</td> --}}
                <td><span class="badge badge-secondary">{{ 'Php ' . number_format($purchaseOrderDetail->unit_cost, 2) }}</span></td>
                <td><span class="badge badge-success">{{ 'Php ' . number_format($purchaseOrderDetail->SubTotal, 2) }}</span></td>
                <td>
                    @if (!$purchaseOrder->complete_status)
                        <button data-toggle="modal" data-target="#Refpurchaseorderdetailmodal{{ isset($purchaseOrderDetail) ? $purchaseOrderDetail->id : null }}" class="btn btn-sm btn-info font-weight-bold"> Add testing</button>
                        @include('transaction.deliverydetail.purchaseorderdetailreference.Refpurchaseorderdetailmodal')

                    @else
                        <button class="btn btn-sm btn-secondary" disabled>N/A</button>
                    @endif
                </td>
            </tr>
            @empty
            <tr><td colspan="5">No Purchase Order Details record/s available.</td></tr>
            @endforelse                 
        </tbody>
    </table>
</div>
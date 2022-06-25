<div class="table-responsive">
    <table id="" class="table table-hover datatables">
        <thead>
            <tr>
                <th scope="col">Item</th>
                <th scope="col">Quantity</th>
                <th scope="col">Unit Price</th>
                <th scope="col">Total Amount</th>
                <th scope="col">Options</th>
            </tr>
        </thead>
        <tbody> 
            @forelse ($delivery->deliveryDetails as $deliveryDetail)
            <tr>
                <td>{{ $deliveryDetail->item->item_name }}</td>
                <td>{{ $deliveryDetail->quantity + 0 }} {{ $deliveryDetail->item->unit }}</td>
                <td><span class="badge badge-secondary">{{ 'Php ' . number_format($deliveryDetail->unit_price, 2) }}</span></td>
                <td><span class="badge badge-success">{{ 'Php ' . number_format($deliveryDetail->SubTotal, 2) }}</span></td>
                <td>
                    @if (!$delivery->complete_status)
                        <button data-toggle="modal" data-target="#deliveryDetailModal{{ isset($deliveryDetail) ? $deliveryDetail->id : null }}" class="btn btn-sm btn-info font-weight-bold">Update testing</button>
                        @include('transaction.deliverydetail.deliverydetailmodal')
                        <button data-toggle="modal" data-target="#deliveryDetailDeleteModal{{ isset($deliveryDetail) ? $deliveryDetail->id : null }}" class="btn btn-sm btn-danger font-weight-bold">Delete testing</button>
                        @include('transaction.deliverydetail.deliverydetailmodaldelete')
                    @else
                        <button class="btn btn-sm btn-secondary" disabled>N/A</button>
                    @endif
                    
                    
                </td>
            </tr>
            @empty
            <tr><td colspan="5">No Delivery Details record/s available.</td></tr>
            @endforelse                 
        </tbody>
    </table>
</div>
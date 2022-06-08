<div class="table-responsive">
    <table id="" class="table table-bordered table-hover datatables mt-3">
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
            @forelse ($purchaseOrder->purchaseOrderDetails as $purchaseOrderDetail)
            <tr>
                <td>{{ $purchaseOrderDetail->item->item_name }}</td>
                <td>{{ $purchaseOrderDetail->quantity + 0 }} {{ $purchaseOrderDetail->item->unit }}</td>
                <td><span class="badge badge-secondary">{{ 'Php ' . number_format($purchaseOrderDetail->unit_cost, 2) }}</span></td>
                <td><span class="badge badge-success">{{ 'Php ' . number_format($purchaseOrderDetail->SubTotal, 2) }}</span></td>
                <td>
                    <a href="#" data-toggle="modal" data-target="#purchaseOrderDetailModal{{ isset($purchaseOrderDetail) ? $purchaseOrderDetail->id : null }}" class="btn btn-sm btn-info font-weight-bold">Update</a>
                    @include('transaction.purchaseorderdetail.purchaseorderdetailmodal')

                    <a href="#" data-toggle="modal" data-target="#purchaseOrderDetailDeleteModal{{ isset($purchaseOrderDetail) ? $purchaseOrderDetail->id : null }}" class="btn btn-sm btn-danger font-weight-bold">Delete</a>
                    <div class="modal fade" id="purchaseOrderDetailDeleteModal{{ isset($purchaseOrderDetail) ? $purchaseOrderDetail->id : null }}" class="purchaseOrderDetailModal" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Delete Item</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{ route('purchaseorderdetaildelete', ['id' => isset($purchaseOrderDetail) ? $purchaseOrderDetail->id : null , 'po_id' => $purchaseOrder->id]) }}" method="post">
                                @csrf
                                    <div class="modal-body">
                                        <input type="hidden" name="id" value="{{ isset($purchaseOrderDetail) ? $purchaseOrderDetail->id : null }}">
                                        <p>Do you want to delete this item?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-sm btn-danger">Confirm Delete</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            @empty
            <tr><td colspan="5">No Purchase Order Details record/s available.</td></tr>
            @endforelse                 
        </tbody>
    </table>
</div>
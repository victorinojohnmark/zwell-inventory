<div class="modal fade" id="purchaseOrderDetailDeleteModal{{ isset($purchaseOrderDetail) ? $purchaseOrderDetail->id : null }}" class="purchaseOrderDetailModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete Item</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('purchaseorderdetaildelete', ['po_id' => $purchaseOrder->id]) }}" method="post">
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
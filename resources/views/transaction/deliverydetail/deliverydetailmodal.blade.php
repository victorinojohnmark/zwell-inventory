<div class="modal fade" id="deliveryDetailModal{{ isset($deliveryDetail) ? $deliveryDetail->id : null }}" class="deliveryDetailModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Delivery Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('deliverydetailupdate') }}" method="post">
                
            @csrf
                <div class="modal-body">
                    @include('transaction.deliverydetail.deliverydetailform')
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-sm btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
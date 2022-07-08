<div class="modal fade" id="releaseDetailModal{{ isset($releaseDetail) ? $releaseDetail->id : null }}" class="releaseDetailModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Release add item</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('releasedetailsave') }}" method="post">
            @csrf
                <div class="modal-body">
                    @include('transaction.releasedetail.releasedetailform')
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-sm btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
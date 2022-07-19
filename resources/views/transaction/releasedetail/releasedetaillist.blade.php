<div class="card">
    <div class="card-header">
        <strong>Release Details</strong>
    </div>
    <div class="card-body">
        @if (!$release->complete_status)
        <div class="options">
            <button class="btn btn-success font-weight-bold btn-sm" data-toggle="modal" data-target="#modalUpdateReleaseDetail"><i class="fas fa-fw fa-plus"></i> Add Item</button>
            @include('transaction.releasedetail.releasedetailmodal')
        </div>
        @endif

        <div class="table-responsive">
            <table id="" class="table table-bordered table-hover datatables mt-3">
                <thead>
                    <tr>
                        <th scope="col">Item</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Options</th>
                    </tr>
                </thead>
                <tbody> 
                    @forelse ($release->releaseDetails as $releaseDetail)
                        <tr>
                            <td>{{ $releaseDetail->item->item_name }} {{ $releaseDetail->item->total_delivery_completed($release->location_id) }}</td>
                            <td>{{ $releaseDetail->quantity }}</td>
                            <td>
                                @if (!$release->complete_status)
                                    <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalUpdateReleaseDetail{{ $releaseDetail->id }}">Update</button>
                                    @include('transaction.releasedetail.releasedetailmodal')
                                    <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#releaseDetailDeleteModal{{ $releaseDetail->id }}">Delete</button>  
                                    @include('transaction.releasedetail.releasedetailmodaldelete')
                                @else
                                    <button class="btn btn-sm btn-secondary" disabled>N/A</button>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3">No Release Details record/s available.</td>
                        </tr>
                    @endforelse                
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-header">
        <strong>Release Details</strong>
    </div>
    <div class="card-body">
        <div class="options">
            <button class="btn btn-success font-weight-bold btn-sm" data-toggle="modal" data-target="#releaseDetailModal"><i class="fas fa-fw fa-plus"></i> Add Item</button>
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
        </div>

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
                                <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalUpdateReleaseDetail{{ $releaseDetail->id }}">Update</button>
                                <div class="modal fade" id="modalUpdateReleaseDetail{{ isset($releaseDetail) ? $releaseDetail->id : null }}" class="releaseDetailModal" tabindex="-1">
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

                                <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modalDeleteReleaseDetail{{ $releaseDetail->id }}">Delete</button>
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
@extends('adminlte::page')

@section('title', 'Zwell | Delivery List')

@section('content')
    <div class="card">
        <div class="card-header">
            <strong>Deliveries</strong>
        </div>
        <div class="card-body">
            <div class="options mb-3">
                <a href="{{ route('deliverycreate') }}" class="btn btn-success font-weight-bold btn-sm"><i class="fas fa-fw fa-plus"></i> New Delivery</a>
            </div>

            <div class="table-responsive">
                <table id="" class="table table-bordered table-hover datatables">
                    <thead>
                        <tr>
                            
                            <th scope="col">Delivery Receipt No.</th>
                            <th scope="col">Purchase Order No</th>
                            <th scope="col">Delivery Date</th>
                            <th scope="col">Supplier</th>
                            <th scope="col">Total Amount</th>
                            <th scope="col">Status</th>
                            <th scope="col">Options</th>
                        </tr>
                    </thead>
                    <tbody> 
                        @forelse ($deliveries as $delivery)
                        <tr>
                            
                            <td><strong>{{ $delivery->dr_no }}</strong></td>
                            <td>{{ $delivery->purchaseOrder->po_no }}</td>
                            <td>{{ $delivery->delivery_date }}</td>
                            <td>{{ $delivery->supplier->supplier_name }}</td>

                            <td>@if (!is_null($delivery->TotalAmount)) <span class="badge badge-info">Php {{ number_format($delivery->TotalAmount, 2)}}</span> @else {!! '<span class="badge badge-warning">N/A</span>' !!} @endif</td>
                            <td>
                                @if (!$delivery->complete_status) {!! '<span class="badge badge-warning">Draft</span>' !!} @else {!! '<span class="badge badge-danger">Pending for approval</span>' !!} @endif
                            </td>
                            <td>
                                <a href="{{ route('deliveryupdate', ['id' => $delivery->id]) }}" class="btn btn-sm btn-info font-weight">View</a>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="10">No Delivery record/s available.</td></tr>
                        @endforelse                 
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
@stop

@section('js')
   <script src="{{ asset('js/custom.js') }}"></script>
@stop
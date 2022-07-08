@extends('adminlte::page')

@section('title', config('app.name') . " - Purchase Order List")

@section('content')
    <div class="card">
        <div class="card-header">
            <strong>Purchase Orders</strong>
        </div>
        <div class="card-body">
            <div class="options mb-3">
                <a href="{{ route('purchaseordercreate') }}" class="btn btn-success font-weight-bold btn-sm"><i class="fas fa-fw fa-plus"></i> New Purchase Order</a>
            </div>

            <div class="table-responsive">
                <table id="" class="table table-bordered table-hover datatables mt-3">
                    <thead>
                        <tr>
                            <th scope="col">Transaction Code</th>
                            <th scope="col">Purchase Date</th>
                            <th scope="col">Purchase Order No.</th>
                            <th scope="col">Requisition Slip No.</th>
                            <th scope="col">Requested By / Contractor</th>
                            <th scope="col">Supplier</th>
                            <th scope="col">Purpose</th>
                            <th scope="col">Purchase Cost</th>
                            <th scope="col">Status</th>
                            <th scope="col">Options</th>
                        </tr>
                    </thead>
                    <tbody> 
                        @forelse ($purchaseOrders as $purchaseOrder)
                        <tr>
                            <td>{{ $purchaseOrder->transaction_code }}</td>
                            <td>{{ $purchaseOrder->purchase_date }}</td>
                            <td>{{ $purchaseOrder->po_no }}</td>
                            <td>{{ $purchaseOrder->requisition_slip_no }}</td>
                            <td>{{ $purchaseOrder->contractor->contractor_name }}</td>
                            <td>{{ $purchaseOrder->supplier->supplier_name }}</td>
                            <td>{{ $purchaseOrder->purpose ? $purchaseOrder->purpose : 'n/a' }}</td>
                            
                            <td>@if (!is_null($purchaseOrder->TotalAmount)) <span class="badge badge-info">Php {{ number_format($purchaseOrder->TotalAmount, 2)}}</span> @else {!! '<span class="badge badge-warning">N/A</span>' !!} @endif</td>
                            <td><span class="badge badge-{{ $purchaseOrder->status['state'] }}">{{ $purchaseOrder->status['title'] }}</span></td>
                            <td>
                                <a href="{{ route('purchaseorderview', ['id' => $purchaseOrder->id]) }}" class="btn btn-sm btn-info font-weight">View</a>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="10">No Purchase Order record/s available.</td></tr>
                        @endforelse                 
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
@stop

@section('css')
    <link rel="stylesheet" href="/vendor/datatable/datatables.min.css">
    <link rel="stylesheet" href="/css/custom.css">
@stop

@section('js')
    {{-- <script src="/vendor/datatable/datatables.min.js"></script> --}}
@stop
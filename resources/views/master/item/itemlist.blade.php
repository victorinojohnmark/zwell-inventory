@extends('adminlte::page')

@section('title', 'Zwell | Item List')

@section('content')
    <div class="card">
        <div class="card-header">
            <strong>Item</strong>
        </div>
        <div class="card-body">
            <div class="options mb-3">
                <a href="{{ route('itemcreate') }}" class="btn btn-success font-weight-bold btn-sm"><i class="fas fa-fw fa-plus"></i> New Item</a>
            </div>

            <table id="" class="table table-bordered table-hover datatables mt-3">
                <thead>
                    <tr>
                        <th scope="col">Item Code</th>
                        <th scope="col">Item Name</th>
                        <th scope="col">Minimum Stock QTY.</th>
                        <th scope="col">Unit/s</th>
                        <th scope="col">Notes</th>
                        <th scope="col">Status</th>
                        <th scope="col">Options</th>
                    </tr>
                </thead>
                <tbody> 
                    @forelse ($items as $item)
                    <tr>
                        <td><b>{{ $item->item_code }}</b></td>
                        <td>{{ $item->item_name }}</span></td>
                        <td>{{ $item->minimum_stock_qty }}</td>
                        <td>{{ $item->unit_id }}</td>
                        <td>{{ $item->notes }}</td>
                        <td><span class="badge badge-{{ $item->active ? 'success' : 'danger' }}">{{ $item->active ? 'Active' : 'Inactive' }}</span></td>
                        <td>
                            <a href="{{ route('itemupdate', ['id' => $item->id]) }}" class="btn btn-sm btn-info font-weight rounded-pril">Update</a>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="7">No Item record/s available.</td></tr>
                    @endforelse                 
                </tbody>
            </table>
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
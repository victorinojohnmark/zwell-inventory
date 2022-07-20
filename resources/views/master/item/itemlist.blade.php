@extends('adminlte::page')

@section('title', config('app.name') . " - Item List")

@section('content')
    <div class="card">
        <div class="card-header">
            <strong>Item</strong>
        </div>
        <div class="card-body">
            <div class="options mb-3">
                <a href="{{ route('itemcreate') }}" class="btn btn-success font-weight-bold btn-sm"><i class="fas fa-fw fa-plus"></i> New Item</a>
            </div>

            <div class="table-responsive">
                <table id="" class="table table-bordered table-hover datatables mt-3">
                    <thead>
                        <tr>
                            <th scope="col">Item Code</th>
                            <th scope="col">Item Name</th>
                            <th scope="col">Minimum Stock QTY.</th>
                            <th scope="col">Unit/s</th>
                            <th scope="col">Status</th>
                            <th scope="col">Options</th>
                        </tr>
                    </thead>
                    <tbody> 
                        @forelse ($items as $item)
                        <tr>
                            <td>{{ $item->item_code }}</td>
                            <td>{{ $item->item_name }}</span></td>
                            <td>{{ $item->minimum_stock_qty }}</td>
                            <td>{{ $item->unit }}</td>
                            <td><span class="badge badge-{{ $item->active ? 'success' : 'danger' }}">{{ $item->active ? 'Active' : 'Inactive' }}</span></td>
                            <td>
                                <a href="{{ route('itemview', ['id' => $item->id]) }}" class="btn btn-sm btn-info font-weight rounded-pril">Update</a>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="7">No Item record/s available.</td></tr>
                        @endforelse                 
                    </tbody>
                </table>
            </div>
            
            <div class="mt-2">
                {{ $items->links() }}
            </div>
        </div>
    </div>
    
@stop

@section('plugins.BootstrapSwitch', true)
@section('css')
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
@stop

@section('js')
   <script src="{{ asset('js/custom.js') }}"></script>
@stop
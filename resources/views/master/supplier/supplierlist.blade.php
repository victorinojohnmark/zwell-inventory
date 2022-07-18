@extends('adminlte::page')

@section('title', config('app.name') . " - Supplier List")

@section('content')
    <div class="card">
        <div class="card-header">
            <strong>Supplier</strong>
        </div>
        <div class="card-body">
            <div class="options mb-3">
                <a href="{{ route('suppliercreate') }}" class="btn btn-success font-weight-bold btn-sm"><i class="fas fa-fw fa-plus"></i> New Supplier</a>
            </div>

            <div class="table-responsive">
                <table id="" class="table table-bordered table-hover datatables mt-3">
                    <thead>
                        <tr>
                            <th scope="col">Supplier Code</th>
                            <th scope="col">Supplier Name</th>
                            <th scope="col">Contact Person</th>
                            <th scope="col">Contact No.</th>
                            <th scope="col">Email</th>
                            <th scope="col">Status</th>
                            <th scope="col">Options</th>
                        </tr>
                    </thead>
                    <tbody> 
                        @forelse ($suppliers as $supplier)
                        <tr>
                            <td>{{ $supplier->supplier_code }}</td>
                            <td>{{ $supplier->supplier_name }}</td>
                            <td>{{ $supplier->contact_person }}</td>
                            <td>{{ $supplier->contact_no }}</td>
                            <td>{{ $supplier->email }}</td>
                            <td><span class="badge badge-{{ $supplier->active ? 'success' : 'danger' }}">{{ $supplier->active ? 'Active' : 'Inactive' }}</span></td>
                            <td>
                                <a href="{{ route('supplierupdate', ['id' => $supplier->id]) }}" class="btn btn-sm btn-info font-weight rounded-pril">Update</a>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="7">No Supplier record/s available.</td></tr>
                        @endforelse                 
                    </tbody>
                </table>
            </div>

            <div class="mt-2">
                {{ $suppliers->links() }}
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
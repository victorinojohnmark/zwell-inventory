@extends('adminlte::page')

@section('title', config('app.name') . " - Contractor List")

@section('content')
    <div class="card">
        <div class="card-header">
            <strong>Contractor</strong>
        </div>
        <div class="card-body">
            <div class="options mb-3">
                <a href="{{ route('contractorcreate') }}" class="btn btn-success font-weight-bold btn-sm"><i class="fas fa-fw fa-plus"></i> New Contractor</a>
            </div>

            <table id="" class="table table-bordered table-hover datatables mt-3">
                <thead>
                    <tr>
                        <th scope="col">Contractor Code</th>
                        <th scope="col">Contractor Name</th>
                        <th scope="col">Contact Person</th>
                        <th scope="col">Contact No.</th>
                        <th scope="col">Email</th>
                        <th scope="col">Status</th>
                        <th scope="col">Options</th>
                    </tr>
                </thead>
                <tbody> 
                    @forelse ($contractors as $contractor)
                    <tr>
                        <td>{{ $contractor->contractor_code }}</td>
                        <td>{{ $contractor->contractor_name }}</td>
                        <td>{{ $contractor->contact_person }}</td>
                        <td>{{ $contractor->contact_no }}</td>
                        <td>{{ $contractor->email }}</td>
                        <td><span class="badge badge-{{ $contractor->active ? 'success' : 'danger' }}">{{ $contractor->active ? 'Active' : 'Inactive' }}</span></td>
                        <td>
                            <a href="{{ route('contractorupdate', ['id' => $contractor->id]) }}" class="btn btn-sm btn-info font-weight rounded-pril">Update</a>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="7">No Contractor record/s available.</td></tr>
                    @endforelse                 
                </tbody>
            </table>
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
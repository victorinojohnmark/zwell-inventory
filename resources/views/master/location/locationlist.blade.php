@extends('adminlte::page')

@section('title', config('app.name') . " - Location List")

@section('content')
    <div class="card">
        <div class="card-header">
            <strong>Location</strong>
        </div>
        <div class="card-body">
            <div class="options mb-3">
                <a href="{{ route('locationcreate') }}" class="btn btn-success font-weight-bold btn-sm"><i class="fas fa-fw fa-plus"></i> New Location</a>
            </div>

            <div class="table-responsive">
                <table id="" class="table table-bordered table-hover datatables mt-3">
                    <thead>
                        <tr>
                            <th scope="col">Location Code</th>
                            <th scope="col">Location Name</th>
                            <th scope="col">Company</th>
                            <th scope="col">Contact Person</th>
                            <th scope="col">Contact No.</th>
                            <th scope="col">Email</th>
                            <th scope="col">Status</th>
                            <th scope="col">Options</th>
                        </tr>
                    </thead>
                    <tbody> 
                        @forelse ($locations as $location)
                        <tr>
                            <td>{{ $location->location_code }}</td>
                            <td>{{ $location->location_name }}</td>
                            <td>{{ $location->company->company_name }}</td>
                            <td>{{ $location->contact_person }}</td>
                            <td>{{ $location->contact_no }}</td>
                            <td>{{ $location->email }}</td>
                            <td><span class="badge badge-{{ $location->active ? 'success' : 'danger' }}">{{ $location->active ? 'Active' : 'Inactive' }}</span></td>
                            <td>
                                <a href="{{ route('locationupdate', ['id' => $location->id]) }}" class="btn btn-sm btn-info font-weight rounded-pril">Update</a>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="7">No Location record/s available.</td></tr>
                        @endforelse                 
                    </tbody>
                </table>
            </div>

            <div class="mt-2">
                {{ $locations->links() }}
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
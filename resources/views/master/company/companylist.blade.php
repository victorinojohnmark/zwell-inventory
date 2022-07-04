@extends('adminlte::page')

@section('title', 'Zwell | Company List')

@section('content')
    <div class="card">
        <div class="card-header">
            <strong>Company</strong>
        </div>
        <div class="card-body">
            <div class="options mb-3">
                <a href="{{ route('companycreate') }}" class="btn btn-success font-weight-bold btn-sm"><i class="fas fa-fw fa-plus"></i> New Company</a>
            </div>

            <table id="" class="table table-bordered table-hover datatables mt-3">
                <thead>
                    <tr>
                        <th scope="col">Company Code</th>
                        <th scope="col">Company Name</th>
                        <th scope="col">Contact Person</th>
                        <th scope="col">Contact No.</th>
                        <th scope="col">Email</th>
                        <th scope="col">Status</th>
                        <th scope="col">Options</th>
                    </tr>
                </thead>
                <tbody> 
                    @forelse ($companies as $company)
                    <tr>
                        <td>{{ $company->company_code }}</td>
                        <td>{{ $company->company_name }}</td>
                        <td>{{ $company->contact_person }}</td>
                        <td>{{ $company->contact_no }}</td>
                        <td>{{ $company->email }}</td>
                        <td><span class="badge badge-{{ $company->active ? 'success' : 'danger' }}">{{ $company->active ? 'Active' : 'Inactive' }}</span></td>
                        <td>
                            <a href="{{ route('companyupdate', ['id' => $company->id]) }}" class="btn btn-sm btn-info font-weight rounded-pril">Update</a>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="7">No Company record/s available.</td></tr>
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
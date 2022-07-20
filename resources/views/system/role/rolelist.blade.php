@extends('adminlte::page')

@section('title', config('app.name') . " - User Roles")

@section('content')
    <div class="card">
        <div class="card-header">
            <strong>User Roles</strong>
        </div>
        <div class="card-body">
            <div class="options mb-3">
                <a href="{{ route('rolecreate') }}" class="btn btn-success font-weight-bold btn-sm"><i class="fas fa-fw fa-plus"></i> New Role</a>
            </div>

            <table id="" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th scope="col">Role Name</th>
                        <th scope="col">Permissions</th>
                        <th scope="col">Option</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($roles as $role)
                    <tr>
                        <td>{{ $role->name }}</td>
                        <td> 
                            <x-adminlte-button label="View Permissions" data-toggle="modal" theme="primary" class="btn-sm" data-target="#modalPermission{{ $role->id }}"/>
                            <x-adminlte-modal id="modalPermission{{ $role->id }}" title="Permissions">
                                @forelse ($role->roleHasPermissions as $roleHasPermission)
                                    <span class="badge badge-primary">{{ $roleHasPermission->permission->title }}</span>
                                @empty
                                    No permission.
                                @endforelse
                            </x-adminlte-modal>
                            
                        </td>
                        <td><a href="{{ route('roleview', ['id' => $role->id]) }}" class="btn btn-success btn-sm">Update Role</a></td>
                    </tr>
                    @empty
                        <tr>
                            <td colspan="4">No Role record/s available</td>
                        </tr>
                    @endforelse
                    
                </tbody>
            </table>

            
        </div>
    </div>
    
@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    
@stop

@section('js')
    <script src="{{ asset('js/custom.js') }}"></script>
@stop
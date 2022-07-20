@extends('adminlte::page')

@section('title', config('app.name') . " - User Roles Form")

@section('content')
    <div class="card">
        <div class="card-header">
            <strong>User Roles Form</strong>
        </div>
        <div class="card-body">
            <div class="options mb-3">
                <a href="{{ route('roleview') }}" class="btn btn-success font-weight-bold btn-sm"><i class="fas fa-fw fa-angle-left"></i> Roles</a>
                @if (!Request::is('role/create')) <a href="{{ route('rolecreate') }}" class="btn btn-success font-weight-bold btn-sm"><i class="fas fa-fw fa-plus"></i> New Role</a> @endif
            </div>

            <form action="{{ route('rolesave') }}" method="post">
                @csrf
                <div class="form-row">
                    <div class="col-md-4">
                        <input type="hidden" name="id" value="{{ old('id', !is_null($role->id)? $role->id : null) }}">
                        
                        <x-adminlte-input name="name" label="Role Name" type="text" placeholder="..." required 
                        value="{{ old('name', !is_null($role->name)? $role->name : null) }}"/>
                    </div>

                    <div class="col-md-8">
                        <x-adminlte-input name="description" label="Description" type="text" placeholder="..." required 
                        value="{{ old('description', !is_null($role->description)? $role->description : null) }}"/>
                    </div>

                    <div class="col-md-4">
                        @foreach ($permissions as $permission)
                        <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="permission[]" value="{{ $permission->id }}" id="permissionCheck{{ $permission->id }}" {{ in_array($permission->id, $role->RolePermissions) ? 'checked="checked"' : '' }}>
                                <label class="form-check-label" for="permissionCheck{{ $permission->id }}">{{ $permission->title }}</label>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    
                </div>
                <x-adminlte-button class="btn-sm font-weight-bold" type="submit" label="Save" theme="primary" icon="fas fa-save"/>
            </form>
            
        </div>
    </div>
    
@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    
@stop

@section('js')
    <script src="{{ asset('js/custom.js') }}"></script>
@stop
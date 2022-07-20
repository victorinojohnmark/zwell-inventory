@extends('adminlte::page')

@section('title', config('app.name') . " - Users")

@section('content')
    <div class="card">
        <div class="card-header">
            <strong>Users</strong>
        </div>
        <div class="card-body">
            <div class="options mb-3">
                <a href="{{ route('usercreate') }}" class="btn btn-success font-weight-bold btn-sm"><i class="fas fa-fw fa-plus"></i> New User</a>
            </div>

            <table id="" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Username</th>
                        <th scope="col">Email</th>
                        <th scope="col">Role</th>
                        <th scope="col">Option</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->username }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @if(!empty($user->getRoleNames()))
                                @foreach($user->getRoleNames() as $role)
                                <label class="badge badge-primary">{{ $role }}</label>
                                @endforeach
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('userview', ['id' => $user->id]) }}" class="btn btn-success btn-sm">Update</a>
                            <x-adminlte-button label="Reset Password" data-toggle="modal" theme="danger" class="btn-sm" data-target="#modalUpdatePassword{{ $user->id }}"/>
                            @include('system.user.userresetpasswordmodal')
                        </td>
                    </tr>
                    @empty
                        <tr>
                            <td colspan="4">No User record/s available</td>
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
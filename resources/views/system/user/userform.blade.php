@extends('adminlte::page')

@section('title', config('app.name') . " - Users")

@section('content')
    <div class="card">
        <div class="card-header">
            <strong>Users</strong>
        </div>
        <div class="card-body">
            <div class="options mb-3">
                <a href="{{ route('userview') }}" class="btn btn-success font-weight-bold btn-sm"><i class="fas fa-fw fa-angle-left"></i> Users</a>
                @if (!Request::is('user/create')) <a href="{{ route('usercreate') }}" class="btn btn-success font-weight-bold btn-sm"><i class="fas fa-fw fa-plus"></i> New User</a> @endif
            </div>

            <form action="{{ route('usersave') }}" method="post">
                @csrf
                <div class="form-row">
                    <div class="col-md-12">
                        <input type="hidden" name="id" value="{{ old('id', !is_null($user->id) ? $user->id : null) }}">
                        
                        <x-adminlte-input name="name" label="Full Name" type="text" placeholder="..." required 
                        value="{{ old('name', !is_null($user->name)? $user->name : null) }}"/>
                    </div>

                    <div class="col-md-6">
                        <x-adminlte-input name="username" label="Username" type="text" placeholder="..." required 
                        value="{{ old('username', !is_null($user->username)? $user->username : null) }}"/>
                    </div>

                    <div class="col-md-6">
                        <x-adminlte-input name="email" label="Email Address" type="email" placeholder="..." required 
                        value="{{ old('email', !is_null($user->email)? $user->email : null) }}"/>
                    </div>

                    @if (!isset($user->id))
                    <div class="col-md-6">
                        <x-adminlte-input name="password" label="Password" type="password" placeholder="..." required 
                        value="{{ old('password', !is_null($user->password)? $user->password : null) }}"/>
                    </div>

                    <div class="col-md-6">
                        <x-adminlte-input name="confirm_password" label="Confirm Password" type="password" placeholder="..." required 
                        value="{{ old('confirm_password', !is_null($user->password)? $user->password : null) }}"/>
                    </div>
                    @endif

                    <div class="col-md-4">
                        @php
                            $config = [
                                "placeholder" => "Select multiple options...",
                                "allowClear" => true,
                            ];
                        @endphp
                        <x-adminlte-select2 id="roleSelector" name="roles[]" label="Roles" :config="$config" multiple>
                            <x-slot name="prependSlot">
                                <div class="input-group-text">
                                    <i class="fas fa-user-check"></i>
                                </div>
                            </x-slot>
                            {{-- <x-slot name="appendSlot">
                                <x-adminlte-button theme="danger" label="Clear" icon="fas fa-lg fa-ban"/>
                            </x-slot> --}}
                            @foreach ($roles as $role)
                                <option>{{ $role }}</option>
                            @endforeach
                        </x-adminlte-select2>
                    </div>
                </div>

                <x-adminlte-button class="btn-sm font-weight-bold" type="submit" label="Save" theme="primary" icon="fas fa-save"/>
            </form>

            
        </div>
    </div>
    
@stop

@section('plugins.Select2', true)
@section('css')
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    
@stop

@section('js')
    <script src="{{ asset('js/custom.js') }}"></script>
@stop
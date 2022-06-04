@extends('adminlte::page')
@section('title', "Zwell | Contractor Form")

@section('content')

    {{-- @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif --}}
    
    <div class="card">
        <div class="card-header">
            <strong>Contractor Form</strong>
        </div>
        <div class="card-body">     
            <div class="options mb-3">
                <a href="{{ route('contractorview') }}" class="btn btn-success font-weight-bold btn-sm"><i class="fas fa-fw fa-angle-left"></i> Contractor</a>
                @if (!Request::is('contractor/create')) <a href="{{ route('contractorcreate') }}" class="btn btn-success font-weight-bold btn-sm"><i class="fas fa-fw fa-plus"></i> New Contractor</a> @endif
            </div>

            <form action="{{ route('contractorsave') }}" method="post">
                @csrf

                <div class="form-row">
                    <div class="col-md-3">
                        <input type="hidden" name="id" value="{{ old('id', !is_null($contractor->id)? $contractor->id : null) }}">
                        
                        <x-adminlte-input name="contractor_code" label="Contractor Code" type="text" placeholder="CN-Corp" required 
                        value="{{ old('contractor_code', !is_null($contractor->contractor_code)? $contractor->contractor_code : null) }}"/>
                    </div>

                    <div class="col-md-9">
                        <x-adminlte-input name="contractor_name" label="Contractor Name" type="text" placeholder="e.g. Contractor Name Corp." required
                        value="{{ old('contractor_name', !is_null($contractor->contractor_name)? $contractor->contractor_name : null) }}"/>
                    </div>

                    <div class="col-md-4">
                        <x-adminlte-input name="contact_person" label="Contact Person" type="text" placeholder="e.g. John Doe" required
                        value="{{ old('contact_person', !is_null($contractor->contact_person)? $contractor->contact_person : null) }}"/>
                    </div>

                    <div class="col-md-4">
                        <x-adminlte-input name="contact_no" label="Contact No." type="text" placeholder="e.g. John Doe" required
                        value="{{ old('contact_no', !is_null($contractor->contact_no)? $contractor->contact_no : null) }}"/>
                    </div>

                    <div class="col-md-4">
                        <x-adminlte-input name="email" label="Email Address" type="text" placeholder="e.g. email@website.com" required
                        value="{{ old('email', !is_null($contractor->email)? $contractor->email : null) }}"/>
                    </div>

                    <div class="col-md-6">
                        <x-adminlte-textarea name="address" label="Address" placeholder="e.n. New York City" required>
                            {{ old('address', !is_null($contractor->address)? $contractor->address : null) }}
                        </x-adminlte-textarea>
                    </div>

                    <div class="col-md-6">
                        <x-adminlte-textarea name="notes" label="Notes" placeholder="Notes here ...">
                            {{ old('notes', !is_null($contractor->notes)? $contractor->notes : null) }}
                        </x-adminlte-textarea>
                    </div>

                    <div class="col-md-3">
                        <input type="hidden" name="active" value="{{ old('active', !is_null($contractor->active) ? $contractor->active : 1) }}">
                        <x-adminlte-input-switch name="activeToggler" id="activeToggler" data-on-color="success" data-off-color="danger" label="Active" />
                    </div>
                </div>

                

                <x-adminlte-button class="btn-sm font-weight-bold" type="submit" label="Save" theme="primary" icon="fas fa-save"/>

            </form>
        </div>
    </div>
    
@stop

@section('plugins.BootstrapSwitch', true)
@section('css')
    <link rel="stylesheet" href="/css/custom.css">
@stop

@section('js')
   <script src="/js/custom.js"></script>
@stop
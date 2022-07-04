@extends('adminlte::page')
@section('title', "Zwell | Location Form")

@section('content')
    
    <div class="card">
        <div class="card-header">
            <strong>Location Form</strong>
        </div>
        <div class="card-body">     
            <div class="options mb-3">
                <a href="{{ route('locationview') }}" class="btn btn-success font-weight-bold btn-sm"><i class="fas fa-fw fa-angle-left"></i> Locations</a>
                @if (!Request::is('location/create')) <a href="{{ route('locationcreate') }}" class="btn btn-success font-weight-bold btn-sm"><i class="fas fa-fw fa-plus"></i> New Location</a> @endif
            </div>

            <form action="{{ route('locationsave') }}" method="post">
                @csrf

                <div class="form-row">
                    <div class="col-md-3">
                        <input type="hidden" name="id" value="{{ old('id', !is_null($location->id)? $location->id : null) }}">
                        
                        <x-adminlte-input name="location_code" label="Location Code" type="text" placeholder="Code" required 
                        value="{{ old('location_code', !is_null($location->location_code)? $location->location_code : null) }}"/>
                    </div>

                    <div class="col-md-9">
                        <x-adminlte-input name="location_name" label="Location Name" type="text" placeholder="e.g. Warehouse/Project Site" required
                        value="{{ old('location_name', !is_null($location->location_name)? $location->location_name : null) }}"/>
                    </div>

                    <div class="col-md-4">
                        <x-adminlte-input name="contact_person" label="Contact Person" type="text" placeholder="e.g. John Doe" required
                        value="{{ old('contact_person', !is_null($location->contact_person)? $location->contact_person : null) }}"/>
                    </div>

                    <div class="col-md-4">
                        <x-adminlte-input name="contact_no" label="Contact No." type="text" placeholder="e.g. 09182346543" required
                        value="{{ old('contact_no', !is_null($location->contact_no)? $location->contact_no : null) }}"/>
                    </div>

                    <div class="col-md-4">
                        <x-adminlte-input name="email" label="Email Address" type="text" placeholder="e.g. email@website.com" required
                        value="{{ old('email', !is_null($location->email)? $location->email : null) }}"/>
                    </div>

                    <div class="col-md-6">
                        <x-adminlte-textarea name="address" label="Address" placeholder="e.n. New York City">
                            {{ old('address', !is_null($location->address)? $location->address : null) }}
                        </x-adminlte-textarea>
                    </div>

                    <div class="col-md-6">
                        <x-adminlte-textarea name="notes" label="Notes" placeholder="Notes here ...">
                            {{ old('notes', !is_null($location->notes)? $location->notes : null) }}
                        </x-adminlte-textarea>
                    </div>

                    
                </div>

                <div class="col-md-3">      
                    <input type="hidden" name="active" value="{{ old('active', !is_null($location->active) ? $location->active : 1) }}">
                    <x-adminlte-input-switch name="activeToggler" id="activeToggler" data-on-color="success" data-off-color="danger" label="Active" />
                </div>

                <x-adminlte-button class="btn-sm font-weight-bold" type="submit" label="Save" theme="primary" icon="fas fa-save"/>

            </form>
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
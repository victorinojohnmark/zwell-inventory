@extends('adminlte::page')
@section('title', config('app.name') . " - Company Form")

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
            <strong>Company Form</strong>
        </div>
        <div class="card-body">     
            <div class="options mb-3">
                <a href="{{ route('companyview') }}" class="btn btn-success font-weight-bold btn-sm"><i class="fas fa-fw fa-angle-left"></i> Companies</a>
                @if (!Request::is('company/create')) <a href="{{ route('companycreate') }}" class="btn btn-success font-weight-bold btn-sm"><i class="fas fa-fw fa-plus"></i> New Company</a> @endif
            </div>

            <form action="{{ route('companysave') }}" method="post">
                @csrf

                <div class="row">
                    <div class="col-md-2">

                    </div>

                    <div class="col-md-10">
                        <div class="form-row">
                            <div class="col-md-3">
                                <input type="hidden" name="id" value="{{ old('id', !is_null($company->id)? $company->id : null) }}">
                                
                                <x-adminlte-input name="company_code" label="Company Code" type="text" placeholder="CN-Corp" required 
                                value="{{ old('company_code', !is_null($company->company_code)? $company->company_code : null) }}"/>
                            </div>
        
                            <div class="col-md-9">
                                <x-adminlte-input name="company_name" label="Company Name" type="text" placeholder="e.g. Company Name Corp." required
                                value="{{ old('company_name', !is_null($company->company_name)? $company->company_name : null) }}"/>
                            </div>
        
                            {{-- <div class="col-md-4">
                                <x-adminlte-input name="contact_person" label="Contact Person" type="text" placeholder="e.g. John Doe" required
                                value="{{ old('contact_person', !is_null($company->contact_person)? $company->contact_person : null) }}"/>
                            </div> --}}
        
                            <div class="col-md-4">
                                <x-adminlte-input name="contact_no" label="Contact No." type="text" placeholder="e.g. 09171239876" required
                                value="{{ old('contact_no', !is_null($company->contact_no)? $company->contact_no : null) }}"/>
                            </div>

                            <div class="col-md-4">
                                <x-adminlte-input name="website" label="Website" type="text" placeholder="https://www.website.com" required
                                value="{{ old('website', !is_null($company->website)? $company->website : null) }}"/>
                            </div>
        
                            <div class="col-md-4">
                                <x-adminlte-input name="email" label="Email Address" type="text" placeholder="e.g. email@website.com" required
                                value="{{ old('email', !is_null($company->email)? $company->email : null) }}"/>
                            </div>
        
                            <div class="col-md-5">
                                <x-adminlte-textarea name="address" label="Address" placeholder="e.n. New York City" required>
                                    {{ old('address', !is_null($company->address)? $company->address : null) }}
                                </x-adminlte-textarea>
                            </div>
        
                            <div class="col-md-5">
                                <x-adminlte-textarea name="notes" label="Notes" placeholder="Notes here ...">
                                    {{ old('notes', !is_null($company->notes)? $company->notes : null) }}
                                </x-adminlte-textarea>
                            </div>
        
                            <div class="col-md-2">
                                <input type="hidden" name="active" value="{{ old('active', !is_null($company->active) ? $company->active : 1) }}">
                                <x-adminlte-input-switch name="activeToggler" id="activeToggler" data-on-color="success" data-off-color="danger" label="Active" />
                            </div>
                        </div>
                        <x-adminlte-button class="btn-sm font-weight-bold" type="submit" label="Save" theme="primary" icon="fas fa-save"/>

                    </div>
                </div>
                
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
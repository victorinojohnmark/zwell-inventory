@extends('adminlte::page')
@section('title', "Zwell | Supplier Form")

@section('content')

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    
    <div class="card">
        <div class="card-header">
            <strong>Supplier Form</strong>
        </div>
        <div class="card-body">     
            <div class="options mb-3">
                <a href="{{ route('supplierview') }}" class="btn btn-success font-weight-bold btn-sm"><i class="fas fa-fw fa-angle-left"></i> Supplier</a>
                @if (!Request::is('supplier/create')) <a href="{{ route('suppliercreate') }}" class="btn btn-success font-weight-bold btn-sm"><i class="fas fa-fw fa-plus"></i> New Supplier</a> @endif
            </div>

            <form action="{{ route('suppliersave') }}" method="post">
                @csrf

                <div class="form-row">
                    <div class="col-md-3">
                        <input type="hidden" name="id" value="{{ old('id', !is_null($supplier->id)? $supplier->id : null) }}">
                        
                        <x-adminlte-input name="supplier_code" label="Supplier Code" type="text" placeholder="CN-Corp" required 
                        value="{{ old('supplier_code', !is_null($supplier->supplier_code)? $supplier->supplier_code : null) }}"/>
                    </div>

                    <div class="col-md-9">
                        <x-adminlte-input name="supplier_name" label="Supplier Name" type="text" placeholder="e.g. Supplier Name Corp." required
                        value="{{ old('supplier_name', !is_null($supplier->supplier_name)? $supplier->supplier_name : null) }}"/>
                    </div>

                    <div class="col-md-4">
                        <x-adminlte-input name="contact_person" label="Contact Person" type="text" placeholder="e.g. John Doe" required
                        value="{{ old('contact_person', !is_null($supplier->contact_person)? $supplier->contact_person : null) }}"/>
                    </div>

                    <div class="col-md-4">
                        <x-adminlte-input name="contact_no" label="Contact No." type="text" placeholder="e.g. John Doe" required
                        value="{{ old('contact_no', !is_null($supplier->contact_no)? $supplier->contact_no : null) }}"/>
                    </div>

                    <div class="col-md-4">
                        <x-adminlte-input name="email" label="Email Address" type="text" placeholder="e.g. email@website.com" required
                        value="{{ old('email', !is_null($supplier->email)? $supplier->email : null) }}"/>
                    </div>

                    <div class="col-md-6">
                        <x-adminlte-textarea name="address" label="Address" placeholder="e.n. New York City" required>
                            {{ old('address', !is_null($supplier->address)? $supplier->address : null) }}
                        </x-adminlte-textarea>
                    </div>

                    <div class="col-md-6">
                        <x-adminlte-textarea name="notes" label="Notes" placeholder="Notes here ..." required>
                            {{ old('notes', !is_null($supplier->notes)? $supplier->notes : null) }}
                        </x-adminlte-textarea>
                    </div>
                </div>

                

                <x-adminlte-button class="btn-sm font-weight-bold" type="submit" label="Save" theme="primary" icon="fas fa-save"/>

            </form>
        </div>
    </div>
    
@stop

@section('css')
    <link rel="stylesheet" href="/css/custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
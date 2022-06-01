@extends('adminlte::page')
@section('title', "Zwell | Item Form")

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
            <strong>Item Form</strong>
        </div>
        <div class="card-body">     
            <div class="options mb-3">
                <a href="{{ route('itemview') }}" class="btn btn-success font-weight-bold btn-sm"><i class="fas fa-fw fa-angle-left"></i> Items</a>
                @if (!Request::is('item/create')) <a href="{{ route('itemcreate') }}" class="btn btn-success font-weight-bold btn-sm"><i class="fas fa-fw fa-plus"></i> New Item</a> @endif
            </div>

            <form action="{{ route('itemsave') }}" method="post">
                @csrf

                <div class="form-row">
                    <div class="col-md-3">
                        <input type="hidden" name="id" value="{{ old('id', !is_null($item->id)? $item->id : null) }}">
                        
                        <x-adminlte-input name="item_code" label="Item Code" type="text" placeholder="Code" required 
                        value="{{ old('item_code', !is_null($item->item_code)? $item->item_code : null) }}"/>
                    </div>

                    <div class="col-md-9">
                        <x-adminlte-input name="item_name" label="Item Name" type="text" placeholder="e.g. DRB 12mm, Cement" required
                        value="{{ old('item_name', !is_null($item->item_name)? $item->item_name : null) }}"/>
                    </div>

                    <div class="col-md-4">
                        <x-adminlte-input name="minimum_stock_qty" label="Minimum Stock Quantity" type="number" placeholder="e.g. 30" min="0" required
                        value="{{ old('minimum_stock_qty', !is_null($item->minimum_stock_qty)? $item->minimum_stock_qty : null) }}"/>
                    </div>

                    <div class="col-md-4">
                        <x-adminlte-select name="unit_id" label="Unit/s">
                            <option>Select here...</option>
                            <option>Option 2</option>
                        </x-adminlte-select>
                    </div>

                    <div class="col-md-6">
                        <x-adminlte-textarea name="notes" label="Notes" placeholder="Notes here ...">
                            {{ old('notes', !is_null($item->notes)? $item->notes : null) }}
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
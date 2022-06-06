@extends('adminlte::page')
@section('title', "Zwell | Purchase Order Form")

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
            <strong>Purchase Order Form</strong>
        </div>
        <div class="card-body">     
            <div class="options mb-3">
                <a href="{{ route('purchaseorderview') }}" class="btn btn-success font-weight-bold btn-sm"><i class="fas fa-fw fa-angle-left"></i> Purchase Orders</a>
                @if (!Request::is('purchaseorder/create')) <a href="{{ route('purchaseordercreate') }}" class="btn btn-success font-weight-bold btn-sm"><i class="fas fa-fw fa-plus"></i> New Purchae Order</a> @endif
            </div>

            <form action="{{ route('purchaseordersave') }}" method="post">
                @csrf

                <div class="form-row">
                    <div class="col-md-2">
                        <input type="hidden" name="id" value="{{ old('id', !is_null($purchaseOrder->id)? $purchaseOrder->id : null) }}">
                        <input type="hidden" name="purchase_cost" value="{{ old('purchase_cost', !is_null($purchaseOrder->purchase_cost)? $purchaseOrder->purchase_cost : null) }}">
                        <input type="hidden" name="prepared_by_id" value="{{ old('prepared_by_id', !is_null($purchaseOrder->prepared_by_id)? $purchaseOrder->prepared_by_id : null) }}">

                        <x-adminlte-input name="transaction_code" label="Transaction Code" type="text" placeholder="[Auto-Generate]" readonly  
                        value="{{ old('transaction_code', !is_null($purchaseOrder->transaction_code)? $purchaseOrder->transaction_code : null) }}"/>
                    </div>

                    <div class="col-md-2">
                        <x-adminlte-input name="po_no" label="PO No." type="text" placeholder="e.g. 001467" required
                        value="{{ old('po_no', !is_null($purchaseOrder->po_no)? $purchaseOrder->po_no : null) }}"/>
                    </div>

                    <div class="col-md-2">
                        <x-adminlte-input name="requisition_slip_no" label="Requisition Slip No." type="text" placeholder="e.g. 6151" required
                        value="{{ old('requisition_slip_no', !is_null($purchaseOrder->requisition_slip_no)? $purchaseOrder->requisition_slip_no : null) }}"/>
                    </div>

                    <div class="col-md-2">
                        @php $config = ['format' => 'YYYY-MM-DD']; @endphp
                        <x-adminlte-input-date name="purchase_date" :config="$config" placeholder="Choose a date..." label="Purchase Date" required 
                            value="{{ old('purchase_date', !is_null($purchaseOrder->purchase_date)? $purchaseOrder->purchase_date : null) }}">
                            <x-slot name="appendSlot">
                                <x-adminlte-button theme="primary" icon="fas fa-calendar-alt"
                                    title="Purchase Date"/>
                            </x-slot>
                        </x-adminlte-input-date>
                    </div>
                </div>

                <div class="form-row">
                    <div class="col-md-3">
                        <x-adminlte-select name="contractor_id" label="Contractor" required>
                            <option>Select here...</option>
                            @foreach ($contractors as $contractor)
                            <option value="{{ $contractor->id }}" {{!is_null($contractor->id) && ($purchaseOrder->contractor_id == $contractor->id)? 'selected' : '' }}>
                                {{ $contractor->contractor_name }}
                            </option>
                            @endforeach
                        </x-adminlte-select>
                    </div>

                    <div class="col-md-3">
                        <x-adminlte-select name="supplier_id" label="Supplier" required>
                            <option>Select here...</option>
                            @foreach ($suppliers as $supplier)
                            <option value="{{ $supplier->id }}" {{!is_null($supplier->id) && ($purchaseOrder->supplier_id == $supplier->id)? 'selected' : '' }}>
                                {{ $supplier->supplier_name }}
                            </option>
                            @endforeach
                        </x-adminlte-select>
                    </div>

                    <div class="col-md-3">
                        <x-adminlte-select name="location_id" label="Location" required>
                            <option>Select here...</option>
                            @foreach ($locations as $location)
                            <option value="{{ $location->id }}" {{!is_null($location->id) && ($purchaseOrder->location_id == $location->id)? 'selected' : '' }}>
                                {{ $location->location_name }}
                            </option>
                            @endforeach
                        </x-adminlte-select>
                    </div>

                </div>
                
                <div class="form-row">

                    <div class="col-md-6">
                        <x-adminlte-textarea name="notes" label="Notes" placeholder="Notes here ...">
                            {{ old('notes', !is_null($purchaseOrder->notes)? $purchaseOrder->notes : null) }}
                        </x-adminlte-textarea>
                    </div>

                </div>
                <x-adminlte-button class="btn-sm font-weight-bold" type="submit" label="Save" theme="primary" icon="fas fa-save"/>
            </form>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <strong>Items</strong>
                </div>
                <div class="card-body">     
                    <div class="options mb-3">
                        <a href="#" class="btn btn-success font-weight-bold btn-sm"><i class="fas fa-fw fa-plus"></i> Add Item</a>
                    </div>
        
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header" id="fileAttachment" data-toggle="collapse" data-target="#collapseFileAttachment" aria-expanded="true" aria-controls="collapseFileAttachment">
                    <button class="btn btn-link p-0 text-reset" >
                        <strong>File Attachments</strong>
                    </button>
                </div>
        
                <div id="collapseFileAttachment" class="collapse show" aria-labelledby="fileAttachment">
                    <div class="card-body">
                    ...
                    </div>
                </div>
            </div>
        </div>
    </div>

    

    
    
@stop

@section('plugins.Moment', true)
@section('plugins.TempusDominus', true)
@section('plugins.BootstrapSwitch', true)
@section('css')
    <link rel="stylesheet" href="/css/custom.css">
@stop

@section('js')
   <script src="/js/custom.js"></script>
@stop
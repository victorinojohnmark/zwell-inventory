@extends('adminlte::page')
@section('title', "Zwell | Purchase Order Form")

@section('content')

    @include('layouts.includes.errors')
    
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <strong>Purchase Order Form</strong> <span class="badge badge-{{ $purchaseOrder->status['state'] }}">{{ $purchaseOrder->status['title'] }}</span>
                    {{-- @if (!$purchaseOrder->complete_status) {!! '<span class="badge badge-warning">Draft</span>' !!} @else {!! '<span class="badge badge-danger">Pending for approval</span>' !!} @endif --}}
                </div>
                <div class="card-body">     
                    <div class="options mb-3">
                        <a href="{{ route('purchaseorderview') }}" class="btn btn-success font-weight-bold btn-sm"><i class="fas fa-fw fa-angle-left"></i> Purchase Orders</a>
                        @if (!Request::is('purchaseorder/create')) <a href="{{ route('purchaseordercreate') }}" class="btn btn-success font-weight-bold btn-sm"><i class="fas fa-fw fa-plus"></i> New Purchase Order</a> @endif
                    </div>
        
                    <form action="{{ route('purchaseordersave') }}" method="post">
                        @csrf
        
                        <div class="form-row">
                            <div class="col-md-3">
                                <input type="hidden" name="id" value="{{ old('id', !is_null($purchaseOrder->id)? $purchaseOrder->id : null) }}">
                                <input type="hidden" name="purchase_cost" value="{{ old('purchase_cost', !is_null($purchaseOrder->purchase_cost)? $purchaseOrder->purchase_cost : null) }}">
                                <input type="hidden" name="prepared_by_id" value="{{ old('prepared_by_id', !is_null($purchaseOrder->prepared_by_id)? $purchaseOrder->prepared_by_id : null) }}">
        
                                <x-adminlte-input name="transaction_code" label="Transaction Code" type="text" placeholder="[Auto-Generate]" readonly  
                                value="{{ old('transaction_code', !is_null($purchaseOrder->transaction_code)? $purchaseOrder->transaction_code : null) }}"/>
                            </div>
        
                            <div class="col-md-3">
                                <x-adminlte-input name="po_no" label="PO No." type="text" placeholder="e.g. 001467" required
                                value="{{ old('po_no', !is_null($purchaseOrder->po_no)? $purchaseOrder->po_no : null) }}"/>
                            </div>
        
                            <div class="col-md-3">
                                <x-adminlte-input name="requisition_slip_no" label="Requisition Slip No." type="text" placeholder="e.g. 6151" required
                                value="{{ old('requisition_slip_no', !is_null($purchaseOrder->requisition_slip_no)? $purchaseOrder->requisition_slip_no : null) }}"/>
                            </div>
        
                            <div class="col-md-3">
                                @php $config = ['format' => 'YYYY-MM-DD']; @endphp
                                <x-adminlte-input-date name="purchase_date" :config="$config" placeholder="Choose a date..." label="Purchasing Date" required 
                                    value="{{ old('purchase_date', !is_null($purchaseOrder->purchase_date)? $purchaseOrder->purchase_date : null) }}">
                                    <x-slot name="appendSlot">
                                        <x-adminlte-button theme="default" icon="fas fa-calendar-alt"
                                            title="Purchase Date"/>
                                    </x-slot>
                                </x-adminlte-input-date>
                            </div>
                        </div>
        
                        <div class="form-row">
                            <div class="col-md-4">
                                <x-adminlte-select name="contractor_id" label="Requestee/Contractor" required>
                                    <option>Select here...</option>
                                    @foreach ($contractors as $contractor)
                                    <option value="{{ $contractor->id }}" {{!is_null($contractor->id) && ($purchaseOrder->contractor_id == $contractor->id)? 'selected' : '' }}>
                                        {{ $contractor->contractor_name }}
                                    </option>
                                    @endforeach
                                </x-adminlte-select>
                            </div>
        
                            <div class="col-md-4">
                                <x-adminlte-select name="supplier_id" label="Supplier" required>
                                    <option>Select here...</option>
                                    @foreach ($suppliers as $supplier)
                                    <option value="{{ $supplier->id }}" {{!is_null($supplier->id) && ($purchaseOrder->supplier_id == $supplier->id)? 'selected' : '' }}>
                                        {{ $supplier->supplier_name }}
                                    </option>
                                    @endforeach
                                </x-adminlte-select>
                            </div>
        
                            <div class="col-md-4">
                                <x-adminlte-select name="location_id" label="Location" required>
                                    <option>Select here...</option>
                                    @foreach ($locations as $location)
                                    <option value="{{ $location->id }}" {{!is_null($location->id) && ($purchaseOrder->location_id == $location->id)? 'selected' : '' }}>
                                        {{ $location->location_name }}
                                    </option>
                                    @endforeach
                                </x-adminlte-select>
                            </div>

                            <div class="col-md-12">
                                <x-adminlte-input name="purpose" label="Purpose" type="text" placeholder="e.g. For barracks construction" required
                                value="{{ old('purpose', !is_null($purchaseOrder->purpose)? $purchaseOrder->purpose : null) }}"/>
                            </div>

                            <div class="col-md-12">
                                <x-adminlte-textarea name="notes" label="Notes" placeholder="...">
                                    {{ old('notes', !is_null($purchaseOrder->notes)? $purchaseOrder->notes : null) }}
                                </x-adminlte-textarea>
                            </div>
        
                        </div>
                        @if (!$purchaseOrder->complete_status)<button class="btn btn-sm btn-primary font-weight-bold" type="submit">Save</button> @endif
                    </form>
                </div>
            </div>

            <div class="card {{ is_null($purchaseOrder->id)? 'd-none' : null }}">
                <div class="card-header">
                    <strong>Details</strong>
                </div>
                <div class="card-body p-0">     
                    
                        @if (!$purchaseOrder->complete_status)
                        <div class="options p-3">
                            <button class="btn btn-success font-weight-bold btn-sm" data-toggle="modal" data-target="#purchaseOrderDetailModal"><i class="fas fa-fw fa-plus"></i> Add Item</button>
                            @include('transaction.purchaseorderdetail.purchaseorderdetailmodal')
                        </div>
                        @endif
                        
                    

                    <!-- PURCHASE ORDER DETAILS-->
                    @include('transaction.purchaseorderdetail.purchaseorderdetaillist')
        
                </div>
            </div>
        </div>

        <div class="col-lg-4 {{ is_null($purchaseOrder->id)? 'd-none' : null }}">
            <div class="card">
                <div class="card-header" id="PurchaseOrderSummary">
                    <strong>Summary</strong>
                </div>
        
                <div class="card-body">
                    <h5><strong>Total Amount</strong></h5>
                    <span class="badge badge-info p-2"><h3 class="m-0"><strong>Php {{ !is_null($purchaseOrder->id)? number_format($purchaseOrder->TotalAmount, 2) : 'N/A' }}</strong></h3></span>
                </div>
                <div class="card-footer">
                    @if ($purchaseOrder->complete_status && $purchaseOrder->approved_by_id == 0)
                        <form action="{{ route('purchaseorderapprove', ['id' => $purchaseOrder->id]) }}" method="post" class="d-inline">
                            @csrf
                            <input type="hidden" name="id" value="{{ $purchaseOrder->id }}">
                            <button class="btn btn-sm btn-success mb-1" type="submit">APPROVE PURCHASE ORDER</button>
                        </form>
                    @endif

                    @if ($purchaseOrder->complete_status == 0)
                        <form action="{{ route('purchaseorderconfirm', ['id' => $purchaseOrder->id]) }}" method="post" class="d-inline">
                            @csrf
                            <input type="hidden" name="id" value="{{ $purchaseOrder->id }}">
                            <button class="btn btn-sm btn-primary mb-1" type="submit">CONFIRM PURCHASE ORDER</button>
                        </form>
                    @endif

                    @if ($purchaseOrder->status['title'] != 'Draft')
                        <form action="{{ route('purchaseorderdraft', ['id' => $purchaseOrder->id]) }}" method="post" class="d-inline">
                            @csrf
                            <input type="hidden" name="id" value="{{ $purchaseOrder->id }}">
                            <button class="btn btn-sm btn-warning mb-1" type="submit">REVERT BACK TO DRAFT</button>
                        </form>
                    @endif
                </div>
            </div>
            @include('transaction.purchaseorder.purchaseorderfileattachment')
            
        </div>
    </div>
    
@stop

@section('plugins.Moment', true)
@section('plugins.TempusDominus', true)
@section('plugins.BootstrapSwitch', true)
@section('css')
    <link rel="stylesheet" href="/vendor/filepond/filepond.min.css">
    <link rel="stylesheet" href="/css/custom.css">
@stop

@section('js')
   <script src="/vendor/filepond/filepond.min.js"></script>
   <script src="/js/purchaseorder.js"></script>
   <script src="/js/fileattachment.js"></script>
   <script src="/js/custom.js"></script>
   
@stop
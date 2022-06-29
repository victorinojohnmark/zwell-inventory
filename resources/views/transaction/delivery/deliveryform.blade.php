@extends('adminlte::page')
@section('title', "Zwell | Delivery Form")

@section('content')

    @include('layouts.includes.errors')
    
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <strong>Delivery Form</strong> <span class="badge badge-{{ $delivery->status['state'] }}">{{ $delivery->status['title'] }}</span>
                </div>
                <div class="card-body">     
                    <div class="options mb-3">
                        <a href="{{ route('deliveryview') }}" class="btn btn-success font-weight-bold btn-sm"><i class="fas fa-fw fa-angle-left"></i> Deliveries</a>
                        @if (!Request::is('delivery/create')) <a href="{{ route('deliverycreate') }}" class="btn btn-success font-weight-bold btn-sm"><i class="fas fa-fw fa-plus"></i> New Delivery</a> @endif
                    </div>

                    {{-- {{ dd($purchaseOrders) }} --}}
        
                    <form action="{{ route('deliverysave') }}" method="post">
                        @csrf
        
                        <div class="form-row">
                            <div class="col-md-3">
                                <input type="hidden" name="id" value="{{ old('id', !is_null($delivery->id)? $delivery->id : null) }}">
                                <input type="hidden" name="total_amount" value="{{ old('total_amount', !is_null($delivery->total_amount)? $delivery->total_amount : null) }}">
        
                                <x-adminlte-input name="transaction_code" label="Transaction Code" type="text" placeholder="[Auto-Generate]" readonly  
                                value="{{ old('transaction_code', !is_null($delivery->transaction_code)? $delivery->transaction_code : null) }}"/>
                            </div>
        
                             <div class="col-md-4">
                                <input type="hidden" name="purchase_order_id" value="{{ !is_null($delivery)? $delivery->purchase_order_id : null  }}" data-po_no="{{ !is_null($delivery->purchaseOrder)? $delivery->purchaseOrder->po_no : null  }}">
                                <label for="po_no_search">PO No.</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text"><i class="fas fa-search"></i></span>
                                    </div>
                                    <input type="text" name="po_no_search" type="text" class="form-control" placeholder="..." required data-toggle="dropdown" 
                                    value="{{ !is_null($delivery->purchaseOrder)? $delivery->purchaseOrder->po_no : null }}">
                                    <ul id="poSearchResult" class="rounded-0 dropdown-menu border-0 p-0">
                                        {{-- <li class="list-group-item list-group-item-action border-0"></li> --}}
                                    </ul>
                                  </div>
                                
                            </div>                          
        
                            <div class="col-md-3">
                                <x-adminlte-input name="dr_no" label="Delivery No." type="text" placeholder="e.g. 6151" required
                                value="{{ old('dr_no', !is_null($delivery->dr_no)? $delivery->dr_no : null) }}"/>
                            </div>
        
                            <div class="col-md-3">
                                @php $config = ['format' => 'YYYY-MM-DD']; @endphp
                                <x-adminlte-input-date name="delivery_date" :config="$config" placeholder="Choose a date..." label="Delivery Date" required 
                                    value="{{ old('delivery_date', !is_null($delivery->delivery_date)? $delivery->delivery_date : null) }}">
                                    <x-slot name="appendSlot">
                                        <x-adminlte-button theme="default" icon="fas fa-calendar-alt"
                                            title="Delivery Date"/>
                                    </x-slot>
                                </x-adminlte-input-date>
                            </div>
                            <div class="col-md-3">
                                <x-adminlte-select name="supplier_id" label="Supplier" required>
                                    <option>Select here...</option>
                                    @foreach ($suppliers as $supplier)
                                    <option value="{{ $supplier->id }}" {{!is_null($supplier->id) && ($delivery->supplier_id == $supplier->id)? 'selected' : '' }}>
                                        {{ $supplier->supplier_name }}
                                    </option>
                                    @endforeach
                                </x-adminlte-select>
                            </div>

                            <div class="col-md-3">
                                <x-adminlte-input name="recieved_by" label="Recieved by: " type="text" placeholder="e.g. Juan Dela Cruz" required
                                value="{{ old('dr_no', !is_null($delivery->recieved_by)? $delivery->recieved_by : null) }}"/>
                            </div>
                        </div>
        
                        <div class="form-row">

                            <div class="col-md-12">
                                <x-adminlte-textarea name="notes" label="Notes" placeholder="...">
                                    {{ old('notes', !is_null($delivery->notes)? $delivery->notes : null) }}
                                </x-adminlte-textarea>
                            </div>

                            <small class="bg-secondary text-italic rounded p-1 mx-1 mb-2">
                                <i class="fas fa-fw fa-info-circle"></i> Updating Delivery with new PO No. will reset delivery details below.
                            </small>
                        </div>
                        @if (!$delivery->complete_status)<button class="btn btn-sm btn-primary font-weight-bold" type="submit">Save</button> @endif
                    </form>
                </div>

            </div>
            
                <!-- DEVIVERY DETAIL -->
                @include('transaction.deliverydetail.deliverydetaillist')
        </div>

        <div class="col-lg-4 {{ is_null($delivery->id)? 'd-none' : null }}">
            <div class="card">
                <div class="card-header" id="deliverySummary">
                     <strong>Summary</strong>
                </div>
                <div class="card-body">
                    <h5><strong>Total Amount</strong></h5>
                    <span class="badge badge-info p-2"><h3 class="m-0"><strong>Php {{ !is_null($delivery->id)? number_format($delivery->TotalAmount, 2) : 'N/A' }}</strong></h3></span>
                </div>
                <div class="card-footer">
                    {{-- @if ($delivery->complete_status)
                        <button class="btn btn-sm btn-success">APPROVE DELIVERY RECEIPT"</button>
                    @else
                    <form action="{{ route('deliveryconfirm', ['id' => $delivery->id]) }}" method="post">
                        @csrf
                        <input type="hidden" name="id" value="{{ $delivery->id }}">
                        <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#confirmdeliveryModal">CONFIRM DELIVERY RECEIPT</button>
                    </form>
                    @endif --}}

                    @if ($delivery->complete_status && $delivery->approved_by_id == 0)
                        <form action="{{ route('deliveryapprove', ['id' => $delivery->id]) }}" method="post" class="d-inline">
                            @csrf
                            <input type="hidden" name="id" value="{{ $delivery->id }}">
                            <button class="btn btn-sm btn-success mb-1" type="submit">APPROVE PURCHASE ORDER</button>
                        </form>
                    @endif

                    @if ($delivery->complete_status == 0)
                        <form action="{{ route('deliveryconfirm', ['id' => $delivery->id]) }}" method="post" class="d-inline">
                            @csrf
                            <input type="hidden" name="id" value="{{ $delivery->id }}">
                            <button class="btn btn-sm btn-primary mb-1" type="submit">CONFIRM PURCHASE ORDER</button>
                        </form>
                    @endif

                    {{-- @if ($delivery->status['title'] != 'Draft')
                        <form action="{{ route('deliverydraft', ['id' => $delivery->id]) }}" method="post" class="d-inline">
                            @csrf
                            <input type="hidden" name="id" value="{{ $delivery->id }}">
                            <button class="btn btn-sm btn-warning mb-1" type="submit">REVERT BACK TO DRAFT</button>
                        </form>
                    @endif --}}
                </div>
            </div>
            {{-- FILE ATTACHMENT ONGOING--}}
            @include('transaction.delivery.deliveryfileattachment') 
            @include('transaction.deliverydetail.purchaseorderdetaillist')
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
    <script src="/js/app.js"></script>
   <script src="/vendor/filepond/filepond.min.js"></script>
   <script src="/js/fileattachment.js"></script>
   <script src="/js/custom.js"></script>
   <script src="/js/delivery.js"></script>
@stop
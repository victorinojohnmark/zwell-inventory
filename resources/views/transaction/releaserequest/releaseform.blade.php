@extends('adminlte::page')

@section('title', config('app.name') . " - Release Form")

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
                        <a href="{{ route('releaseview') }}" class="btn btn-success font-weight-bold btn-sm"><i class="fas fa-fw fa-angle-left"></i> Purchase Orders</a>
                        @if (!Request::is('release/create')) <a href="{{ route('releasecreate') }}" class="btn btn-success font-weight-bold btn-sm"><i class="fas fa-fw fa-plus"></i> New Purchase Order</a> @endif
                    </div>
        
                    <form action="{{ route('releasesave') }}" method="post">
                        @csrf
        
                       
                    </form>
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
                        <form action="{{ route('releaseapprove', ['id' => $purchaseOrder->id]) }}" method="post" class="d-inline">
                            @csrf
                            <input type="hidden" name="id" value="{{ $purchaseOrder->id }}">
                            <button class="btn btn-sm btn-success mb-1" type="submit">APPROVE PURCHASE ORDER</button>
                        </form>

                        <form action="{{ route('releasedraft', ['id' => $purchaseOrder->id]) }}" method="post" class="d-inline">
                            @csrf
                            <input type="hidden" name="id" value="{{ $purchaseOrder->id }}">
                            <button class="btn btn-sm btn-warning mb-1" type="submit">REVERT BACK TO DRAFT</button>
                        </form>
                    @endif

                    @if ($purchaseOrder->complete_status == 0)
                        <form action="{{ route('releaseconfirm', ['id' => $purchaseOrder->id]) }}" method="post" class="d-inline">
                            @csrf
                            <input type="hidden" name="id" value="{{ $purchaseOrder->id }}">
                            <button class="btn btn-sm btn-primary mb-1" type="submit">CONFIRM PURCHASE ORDER</button>
                        </form>
                    @endif

                    @if ($purchaseOrder->complete_status && $purchaseOrder->approved_by_id != 0)
                        <a href="{{ route('releaseprint', ['id' => $purchaseOrder->id ]) }}" target="_blank" class="btn btn-sm btn-primary mb-1" type="submit">PRINT PREVIEW</a>
                    @endif

                    {{-- @if ($purchaseOrder->status['title'] != 'Draft')
                        
                    @endif --}}
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
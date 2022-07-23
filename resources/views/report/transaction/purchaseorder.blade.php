@extends('adminlte::page')

@section('title', config('app.name') . " - Purchase Order Report")

@section('content')
    <div class="card">
        <div class="card-header">
            <strong>Purchase Order Report</strong>
        </div>
        <div class="card-body">
            <div class="options mb-3">
                <div class="btn-group" role="group" aria-label="Basic example">
                    <button type="button" class="btn btn-secondary btn-sm" onclick="selectElementContents( document.getElementById('table') );">Copy</button>
                    <button type="button" class="btn btn-secondary btn-sm" onclick="ExportToExcel('xlsx');">Excel</button>
                  </div>
            </div>

            <div class="table-responsive">
                <table id="table" class="table table-bordered table-sm datatable">
                    <thead>
                        <tr>
                            <th scope="col">Transaction Code</th>
                            <th scope="col">PO No</th>
                            <th scope="col">Supplier</th>
                            <th scope="col">Location</th>
                            <th scope="col">Item</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Unit Cost</th>
                            <th scope="col">Total Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($purchaseOrders as $purchaseOrder)
                            @php
                                $rowspan = $purchaseOrder->purchaseOrderDetails->count();
                            @endphp
                            @foreach ($purchaseOrder->purchaseOrderDetails as $key => $purchaseOrderDetail)
                            <tr>
                                @if ($key == 0)
                                    <td rowspan="{{ $rowspan }}">{{ $purchaseOrder->transaction_code }}</td>
                                    <td rowspan="{{ $rowspan }}">{{ $purchaseOrder->po_no }}</td>
                                    <td rowspan="{{ $rowspan }}">{{ $purchaseOrder->supplier->supplier_name }}</td>
                                    <td rowspan="{{ $rowspan }}">{{ $purchaseOrder->location->location_name }}</td>
                                @endif
                                    <td>{{ $purchaseOrderDetail->item_name }}</td>
                                    <td>{{ $purchaseOrderDetail->quantity + 0 }} {{ $purchaseOrderDetail->item->unit }}</td>
                                    <td>PHP {{ number_format($purchaseOrderDetail->unit_cost, 2) }}</td> 
                                @if ($key == 0)
                                    <td rowspan="{{ $rowspan  }}">PHP {{ number_format($purchaseOrder->TotalAmount, 2)}}</td>
                                @endif             
                            </tr>
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>

            
        </div>
    </div>
    
@stop

@section('css')
    {{-- <link rel="stylesheet" href="{{ asset('vendor/datatables/datatables.min.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    
@stop

@section('js')
    <script src="{{ asset('vendor/xlsxjs/xlsx.full.min.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>
    <script>
        function selectElementContents(el) {
          var body = document.body,
            range, sel;
          if (document.createRange && window.getSelection) {
            range = document.createRange();
            sel = window.getSelection();
            sel.removeAllRanges();
            range.selectNodeContents(el);
            sel.addRange(range);
          }
          document.execCommand("Copy");
          document.getSelection().removeAllRanges();
        }

        function ExportToExcel(type, fn, dl) {
            var elt = document.getElementById('table');
            var wb = XLSX.utils.table_to_book(elt, { sheet: "sheet1" });
            return dl ?
                XLSX.write(wb, { bookType: type, bookSST: true, type: 'base64' }):
                XLSX.writeFile(wb, fn || ('Purchase Order List.' + (type || 'xlsx')));
        }
      </script>
@stop
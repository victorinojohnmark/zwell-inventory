@extends('layouts.report')

@section('title')
{{ $purchaseOrder->transaction_code }}
@endsection

@section('document-type')
<h2>PURCHASE ORDER</h2>
@endsection

@section('button-options')
  <button id="dataToggler">Toggle Data</button>
@endsection

@section('content')

<table class="tbl header" id="table" style="margin-top: 20px;" cellspacing="0">
  <tbody>
      <tr><td class="bg-dark">Transaction Code:</td><td>{{ $purchaseOrder->transaction_code }}</td><td class="bg-dark">Purchasing Date:</td><td>{{ $purchaseOrder->purchase_date }}</td></tr>
      <tr><td class="bg-dark">Supplier:</td><td>{{ $purchaseOrder->supplier->supplier_name }}</td><td class="bg-dark">Terms:</td><td>{{ $purchaseOrder->terms }}</td></tr>
  </tbody>
</table>
<div id="tableDataWrapper">
  <table class="tbl header" id="tableData" style="margin-top: 20px;" cellspacing="0">
    <thead>
      <tr>
        <th class="bg-dark" style="width:20px;">#</th>
        <th class="bg-dark" style="width:250px;">DESCRIPTION</th>
        <th class="bg-dark" style="width:50px;">QTY</th>
        <th class="bg-dark" style="width:40px;">UNIT</th>
        <th class="bg-dark" style="width:100px;">UNIT PRICE</th>
        <th class="bg-dark" style="width:150px;">TOTAL</th>
      </tr>
    </thead>
    <tbody style="vertical-align: center;">
        @php $ctr = 1; @endphp
        @forelse ($purchaseOrder->purchaseOrderDetails as $purchaseOrderDetail)
        <tr>
          <td><span class="data">{{ $ctr }}</span></td>
          <td><span class="data">{{ $purchaseOrderDetail->item->item_name }} {{ is_null($purchaseOrderDetail->item->description) ? '' :  '</br>' . $purchaseOrderDetail->item->description }}</span></td>
          <td><span class="data">{{ $purchaseOrderDetail->quantity + 0 }}</span></td>
          <td><span class="data">{{ $purchaseOrderDetail->item->unit }}</span></td>
          <td><span class="data">PHP {{ number_format($purchaseOrderDetail->unit_cost, 2) }}</span></td>
          <td><span class="data">PHP {{ number_format($purchaseOrderDetail->SubTotal, 2) }}</span></td>
        </tr>
        @php $ctr++; @endphp
        @empty
            <tr>
              <td colspan="6">No Purchase Order Details record/s.</td>
            </tr>
        @endforelse
    </tbody>
  </table>
</div>

<footer>
  <table cellspacing="0">
      <tbody>
          <tr height="35">
            <td style="border-right: 0px;" class="bg-dark"></td>
            <td style="border-right: 0px; border-left: 0px;" class="bg-dark"></td>
            <td width="25%" colspan="" class="bg-dark" style="text-align:right; border-left: 0px;"><strong><span class="data">TOTAL AMOUNT</span></strong></td>
            <td width="25%"><strong><span class="data">PHP 29,750.00</span></strong></td>
          </tr>
          <tr>
            <td colspan="4">
              <strong style="padding-left: 25px;">Terms</strong>
              <ul>
                <li>Goods delivered to our warehouse are subjected to final inspection and if found not in accordance within specification will be returned to the supplier.</li>
                <li>Replacement should not be made without instructions from us.</li>
                <li>No Account will be paid unless original copies of the covering invoice and purchase order are presented.</li>
              </ul>
            </td>
          </tr>
          <tr><td colspan="2" class="bg-dark"><center>Prepared by:</center></td><td colspan="2" class="bg-dark"><center>Approved by:</center></td></tr>
          <tr>
              <td colspan="2">
                <span class="data">
                  <img src="/img/signature-1.png" alt="signature">
                  <center style="margin-top: -20px;">John Mark Victorino</center>
                  <center><strong>Position Here</strong></center>
                </span>
              </td>
              <td colspan="2">
                <span class="data">
                  <img src="/img/signature-2.png" alt="signature">
                  <center style="margin-top: -20px;">Sarah Lee</center>
                  <center><strong>Position Here</strong></center>
                </span>
              </td>
          </tr>
  
      </tbody>
  </table>
</footer>
@endsection

@section('scripts')
    <script>
      const toggler = document.querySelector('#dataToggler');
      if(toggler) {
        let allElement = document.querySelector('*');
        let data = document.querySelectorAll('.data');
        toggler.addEventListener('click', (e)=> {
          if(allElement.style.visibility == 'hidden'){
            allElement.style.visibility = 'visible';
          } else {
            allElement.style.visibility = 'hidden';
            Array.from(data).forEach((el) => {
              el.style.visibility = 'visible';
            });
          }
          toggler.style.visibility = 'visible';
        });
      }
    </script>
@endsection
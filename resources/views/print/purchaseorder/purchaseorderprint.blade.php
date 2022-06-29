<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>{{ $page_title ?? 'Checkout' }} {{ $checkout->ReferenceNo }}</title>
  <link rel="stylesheet" href="{{ asset('vendor/normalize/normalize.css') }}">
  <link rel="stylesheet" href="{{ asset('css/print.css') }}">

  <style style="text/css">
    .p-bottom {
      padding-top:10px;
      border-top:2px solid black;
    }

    .mt-50 {
      margin-top: 50px;
    }
  </style>
</head>
<body>

@if ($checkout->status)
  <button class="print-button" onclick="window.print()">Print</button>
  <button class="print-button" onclick="selectElementContents( document.getElementById('table') );">Copy</button>
  <br>
  <table>
    <tr>
      <td rowspan="4" style="width:60px; padding:10px;">
        <img src="/img/zwell-logo.png" alt="HRM Logo" style="width:100%;">
      </td>
    </tr>
    <tr>
      <td><h2>Zwell Philippine Realty Development Corporation</h2></td>
    </tr>
    <tr>
      <td>Arnaldo Highway, Brgy. Santiago Gen. Trias Cavite</td>
    </tr>
    <tr>
      <td>Tel.: 09090909 <br> Website: https://website.com</td>
    </tr> 
  </table>
  <br>
  <table class="tbl" id="table" style="margin-top: 20px;">
    <thead>
      <tr>
        <th colspan="2">Location</th>
        <td colspan="4">{{ $checkout->location->location_code }}</td>
      </tr>
      <tr>
        <th colspan="2">Address</th>
        <td colspan="4">{{ $checkout->location->address }}</td>
      </tr>
      <tr>
        <th colspan="2">Contact Person</th>
        <td colspan="4">{{ $checkout->location->contact_person }}</td>
      </tr>
      <tr>
        <th colspan="2">Contact No.</th>
        <td colspan="4">{{ $checkout->location->contact_no }}</td>
      </tr>
      <tr>
        <th colspan="6"><h3>{{ $checkout->return_to_supplier ? 'Return to supplier - ' : '' }}{{ $page_title ?? '' }}: {{ $checkout->ReferenceNo }}</h3></th>
      </tr>
      <tr>
        {{-- <th>Location</th> --}}
        <th>DR</th>
        <th>Sales Invoice</th>
        <th>PO</th>
        <th>Delivery Date</th>
        <th>Delivery By</th>
        <th style="width:100px !important">Status</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>{{ $checkout->delivery->dr_no ?? 'N/A' }}</td>
        <td>{{ $checkout->invoice_no }}</td>
        <td>{{ $checkout->po_no }}</td>
        <td>{{ $checkout->delivery_date }}</td>
        <td>{{ $checkout->delivery_by ?? 'N/A' }}</td>
        <td>{{ $checkout->DeliveryStatus }}</td>
      </tr>
      <tr>
        <th colspan="6"><h4>Total</h4></th>
      </tr>
      <tr>
        <th colspan="3">Toner</th>
        <th>Type</th>
        <th>Total Qty</th>
        <th>Units</th>
      </tr>
      @forelse ($totalReleases->sortBy('id') as $totalRelease)
      <tr>
          <td colspan="3">{{ $totalRelease->stock->toner->model_name }}</td>
          <td>{{ $totalRelease->stock->toner->toner_type->name }}</td>
          <td>{{ $totalRelease->total_count }}</td>
          <td>{{ $totalRelease->stock->toner->unit->name }}</td>
      </tr>
      @empty
          <tr>
              <td colspan="4">No record found.</td>
          </tr>
      @endforelse
    </tbody>
  </table>

  <div style="width:250px;float:right;position:fixed;bottom:0;right:0;padding:30px 20px;text-align:center;">
    <p class="p-bottom mt-50">Authorized Signature & Printed Name</p>
    <p class="p-bottom mt-50">Date Received</p>
  </div>

  <div style="width:250px;float:left;position:fixed;bottom:0;left:0;padding:30px 20px;text-align:center;">
    <p style="height:25px;"><strong>ACD</strong></p>
    <p class="p-bottom">Prepared By</p>
    <p style="height:25px;"><strong>GOA</strong></p>
    <p class="p-bottom">Approved By</p>
  </div>
@else
 @if ($checkout->void_status)
  <p>This transaction is void.</p>
 @else
  <p>Cannot view report, Please update the checkout status first.</p>
 @endif
@endif



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
</script>



</body>
</html>
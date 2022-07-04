@extends('layouts.report')

@section('title')
Purchase Order - 0000001
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
      <tr><td class="bg-dark">Transaction Code:</td><td>202206-PO0000001</td><td class="bg-dark">Purchasing Date:</td><td>2022-06-30</td></tr>
      <tr><td class="bg-dark">Supplier:</td><td>JCL Hardware Incorporated</td><td class="bg-dark">Terms:</td><td>15 days</td></tr>
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
        <th class="bg-dark" style="width:150px;">SUBTOTAL AMOUNT</th>
      </tr>
    </thead>
    <tbody style="vertical-align: center;">
        <tr>
          <td><span class="data">1</span></td>
          <td><span class="data">Cement <br>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ex ad illo nostrum corrupti molestias reiciendis sapiente, animi sunt expedita placeat nihil blanditiis repellendus suscipit autem porro! Eveniet vero praesentium omnis ea in! Mollitia, perspiciatis ex alias tenetur atque culpa maxime blanditiis qui, sapiente similique molestiae vero inventore veritatis nobis ipsa.</span></td>
          <td><span class="data">150</span></td>
          <td><span class="data">PC/S</span></td>
          <td><span class="data">PHP 265.00</span></td>
          <td><span class="data">PHP 39,750.00</span></td>
        </tr>
        
        <tr height="35">
          <td colspan="5" class="bg-dark" style="text-align:right;"><strong><span class="data">TOTAL AMOUNT</span></strong></td>
          <td><strong><span class="data">PHP 29,750.00</span></strong></td>
        </tr>
  
    </tbody>
  </table>
</div>

<footer>
  <table cellspacing="0">
      <tbody>
          <tr>
            <td colspan="2">
              <strong style="padding-left: 25px;">Terms</strong>
              <ul>
                <li>Goods delivered to our warehouse are subjected to final inspection and if found not in accordance within specification will be returned to the supplier.</li>
                <li>Replacement should not be made without instructions from us.</li>
                <li>No Account will be paid unless original copies of the covering invoice and purchase order are presented.</li>
              </ul>
            </td>
          </tr>
          <tr><td class="bg-dark"><center>Prepared by:</center></td><td class="bg-dark"><center>Approved by:</center></td></tr>
          <tr>
              <td>
                <span class="data">
                  <img src="/img/signature-1.png" alt="signature">
                  <center style="margin-top: -20px;">John Mark Victorino</center>
                  <center><strong>Position Here</strong></center>
                </span>
              </td>
              <td>
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
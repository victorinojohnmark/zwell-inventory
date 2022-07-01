<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>@yield('title')</title>
  <link rel="stylesheet" href="{{ asset('vendor/normalize/normalize.css') }}">
  <link rel="stylesheet" href="{{ asset('css/print.css') }}">

  <style>
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
  @yield('button-options')
  <table style="margin-bottom: 20px;">
    <tr>
      <td rowspan="4" style="width:100px; padding-right:10px;">
        <img src="/img/logo.png" alt="HRM Logo" style="width:100%;">
      </td>
    </tr>
    <tr>
      <td><h2 style="margin-bottom: 0px;">Zwell Philippine Realty Development Corporation</h2></td>
    </tr>
    <tr>
      <td>Arnaldo Highway, Brgy. Santiago Gen. Trias Cavite</td>
    </tr>
    <tr>
        <td>Contact No.: (046)513-5935; (0917)169-5935; (0943)708-8592 &nbsp;Website: https://website.com</td>
    </tr> 
  </table>
  <center>@yield('document-type')</center>
@yield('content')

{{-- <script>
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
</script> --}}

@yield('scripts')




</body>
</html>
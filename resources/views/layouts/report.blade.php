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
  @yield('document-header')
  <center>@yield('document-type')</center>
  @yield('content')

  @yield('scripts')




</body>
</html>
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>RSDea | VClaim</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{ asset('uiadminlte/plugins/fontawesome-free/css/all.min.css') }} ">

  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('uiadminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }} ">
  <link rel="stylesheet" href="{{ asset('uiadminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }} ">
  <link rel="stylesheet" href="{{ asset('uiadminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }} ">

  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('uiadminlte/dist/css/adminlte.min.css') }}">

  <!-- Toast -->
  <link rel="stylesheet" href="{{ asset('uiadminlte/plugins/toastr/toastr.css') }}">
  <!-- nprogress -->
  <!-- <link rel="stylesheet" href="{{ asset('uiadminlte/plugins/nprogress/nprogress.css') }} "> -->
  <!-- jquery css -->
  <link rel="stylesheet" href="{{ asset('uiadminlte/plugins/jquery-ui/jquery-ui.min.css') }} ">

  <!-- Top Scripts tambahan -->
  @yield('topscript')

</head>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">
    @include('layouts.navbar')
    @include('layouts.sidebar')

    @yield('contents')
    @include('layouts.footer')
  </div>
  <!-- ./wrapper -->

  <!-- REQUIRED SCRIPTS -->
  @include('layouts.script_js_bottom')

  <!-- Bottom Scripts tambahan -->
  @yield('bottomscript')
</body>

</html>
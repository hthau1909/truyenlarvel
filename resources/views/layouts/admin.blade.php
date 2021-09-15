<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  @yield('title')
  @include('admin.partials.link')
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
@include('admin.partials.header')
@include('admin.partials.sidebar')

@yield('content')
  <!-- /.content-wrapper -->
@include('admin.partials.footer')

</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
@include('admin.partials.script')
@yield('js')
</body>
</html>

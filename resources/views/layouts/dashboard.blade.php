<!doctype html>
<html lang="en" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../favicon.ico">

    <title>داشبرد ادمین</title>

    <link href="{{asset('DataTables/datatables.css')}}" rel="stylesheet">
    <link href="{{asset('css/app.css')}}" rel="stylesheet">
    <link href="{{asset('css/admin.css?v=1')}}" rel="stylesheet">
    <link href="{{asset('css/tagsinput.css')}}" rel="stylesheet"/>

    @yield('styles')
</head>

<body>

@include('layouts.partials.dashboard_header')

@include('layouts.partials.dashboard_sidebar')

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->

<script src="{{asset('js/app.js')}}"></script>
<script src="{{asset('DataTables/datatables.js')}}"></script>
<script src="{{asset('js/bootstrap.min.js')}}"></script>

@yield('scripts')

</body>
</html>



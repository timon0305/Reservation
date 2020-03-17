<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{general_setting()->title}} | @yield('title','admin')</title>
    <link rel="shortcut icon" href="{{general_setting()->favicon}}">
    <link rel="stylesheet" href="{{asset('assets/plugin/bootstrap-4.0.0/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/plugin/font-awesome/css/font-awesome.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/css/bootadmin.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/css/custom.css')}}">
    <link rel="stylesheet" href="{{asset('assets/plugin/toastr/build/toastr.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/plugin/bootstrap-toggle/css/bootstrap2-toggle.min.css')}}">

    <link rel="stylesheet" href="{{asset('assets/plugin/select2/dist/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/plugin/select2-bootstrap-theme/dist/select2-bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/plugin/gijgo-combined-1.9.11/css/gijgo.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/plugin/date-time/mdtimepicker.min.css')}}">
    <link href="{{url('/')}}/assets/backend/css/color.php?color={{general_setting()->color}}" rel="stylesheet">
    @yield('style')
</head>
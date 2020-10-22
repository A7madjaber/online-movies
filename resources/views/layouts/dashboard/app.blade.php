
<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    <meta name="description" content="Vali is a responsive and free admin theme built with Bootstrap 4, SASS and PUG.js. It's fully customizable and modular.">

    <style>
        label{
            font-weight: bold;
        }
    </style>

         @stack('styles')


    <title>OnlineMovies | {{@$title}}</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Main CSS-->

    <link rel="stylesheet" type="text/css" href="{{asset('dashboard/css/main.css')}}">
    <!-- Font-icon css-->

    <script src="{{asset('dashboard/js/jquery-3.3.1.min.js')}}"></script>

    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
{{-- noty--}}
    <link rel="stylesheet" type="text/css" href="{{asset('dashboard/plugins/noty.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('dashboard/plugins/themes/sunset.css')}}">


    <script src="{{asset('dashboard/plugins/noty.min.js')}}"></script>
</head>

<body class="app sidebar-mini">
<!-- Navbar-->

@include('layouts.dashboard._header')

<!-- Sidebar menu-->
@include('layouts.dashboard._aside')

<main class="app-content">
@include('dashboard.partials._sessions')
@yield('content')

</main>
<!-- Essential javascripts for application to work-->
<script src="{{asset('dashboard/js/popper.min.js')}}"></script>
<script src="{{asset('dashboard/js/bootstrap.min.js')}}"></script>
<script src="{{asset('dashboard/js/main.js')}}"></script>
<script src="{{asset('dashboard/js/plugins/select2.min.js')}}"></script>
<!-- The javascript plugin to display page loading on top-->
<script src="{{asset('dashboard/js/plugins/pace.min.js')}}"></script>
<script src="{{asset('dashboard/js/custom/movie.js')}}"></script>


    <script>

        $.ajaxSetup({

        headers:{
            'x-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
        }
        });

        Noty.overrideDefaults({
            theme    : 'sunset',
        });

        $(document).ready(function () {

            $(document).on('click','.delete',function (e) {

                e.preventDefault();

                var that=$(this);
                var n=new Noty({
                    text:"Confirm deleting record",
                    killer:true,
                    buttons:[
                        Noty.button('yes','btn btn-success mr-2',function () {

                            that.closest('form').submit();

                        }),
                        Noty.button('no','btn btn-danger',function () {

                            n.close();

                        })
                    ]

                });

                n.show()

            });

        });

        $('.select2').select2({
            width:'100%'
        });
    </script>

</body>
</html>



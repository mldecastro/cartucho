<!DOCTYPE html>
<html>
    <head>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
    <link href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet">
    <link href="{{ asset('css/materialize.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">

    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    
    <title>Dashboard</title>

    <style media="screen">
        .pagination li.active {
            background-color: {{ config('app.dashboardCodColor') }};
        }
    </style>
</head>

<body>
@include('admin.components.sidenav')

<main>
    <div class="container">
        @yield('content')
    </div>
</main>

<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="{{ asset('js/materialize.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/dashboard.js') }}"></script>
</body>
</html>



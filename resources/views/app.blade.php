<!DOCTYPE HTML>
<!--[if lt IE 8]>
<html class="no-js lt-ie8" lang="es" ng-app="events"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="es" ng-app="events"> <!--<![endif]-->
<head>
    <meta charset="utf-8"/>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'/>

    <title>Crossover Events</title>

    <link type="text/css" rel="stylesheet" href="{{ asset('/css/vendor.css?') . env('VERSION') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/main.css?') . env('VERSION') }}"/>

    <link rel="icon" href="{{ asset('/img/icon_32x32.png') }}" sizes="32x32"/>
    <link rel="icon" href="{{ asset('/img/icon_192x192.png') }}" sizes="192x192"/>
    <link rel="apple-touch-icon-precomposed" href="{{ asset('/img/icon_192x192.png') }}"/>

    <script>
        var BASE_URL = '{{ asset('/')}}';
        var MAPS_KEY = '{{ env('GOOGLE_MAPS_KEY')}}';
    </script>
</head>
<body>
<!--[if lt IE 9]>
<div class="lt-ie9-bg">
    <p class="browsehappy">Estas usando un navegador <strong>muy antiguo</strong>
        <a href="http://browsehappy.com/">actualizate</a>, vive una mejor experiencia y se feliz :D</p>
</div>
<![endif]-->

<div class="container">
    <div ui-view></div>
</div>

<div class="error_message" ng-class="{success_message:messageSuccess}" ng-show="contextualMessage">
    [[ messageForm ]]
</div>

<script src="{{ asset('/js/vendor.js') . '?' . env('VERSION') }}"></script>
<script src="{{ asset('/js/app.js') . '?' . env('VERSION') }}"></script>

</body>
</html>

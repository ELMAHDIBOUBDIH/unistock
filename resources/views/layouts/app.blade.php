<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @yield('meta')
    <link rel="icon" type="image/png" href="{{asset('favicon.png')}}">

    <!-- Styles -->
    <link href="{{ asset('css/app_' .config('unistock.version') . '.css') }}" rel="stylesheet">

    @yield('head')
    <script>
        window.App = {!! json_encode([
                'csrfToken' => csrf_token(),
                'prefix' => getPrefix(),
                'locale' => LaravelLocalization::getCurrentLocale() ,
                'user' => Auth::user()
        ]) !!};
    </script>
</head>
<body class="{{ LaravelLocalization::getCurrentLocaleDirection() }}">
    <div id="app" dir="{{ LaravelLocalization::getCurrentLocaleDirection() }}">
        <div class="header">
            <div class="container">
                <div class="main-logo">
                      <img src="{{ asset('img/logo.png') }}" />
                </div>
            </div>
        </div>
        <div class="container">
            <router-view>
                @yield('content')
            </router-view>
        </div>
        <div class="copyright">
            <div class="container ">
                {!! trans('text.copyright', ['year' => Carbon\Carbon::now()->year, 'name' => $settings['app_name']])!!}
            </div>
        </div>
    </div>
    <!-- Scripts -->
    <script src="{{ asset('js/trans/'.LaravelLocalization::getCurrentLocale().'/text.js') }}"></script>
    <script src="{{ asset('js/app_' .config('unistock.version') . '.js') }}"></script>
</body>
</html>

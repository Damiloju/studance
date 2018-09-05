<!DOCTYPE html>
    <html>
        <head>
            <meta charset="utf-8" />
            <title>McPherson University</title>
            <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
            <meta content="McU" name="author" />
            <meta http-equiv="X-UA-Compatible" content="IE=edge" />

            @yield('styles')
            @include('layouts.styles')
        </head>

        <body>

            <div id="app">
                @yield('content')
            </div>


            @include('layouts.scripts')
            @yield('scripts')

        </body>
</html>
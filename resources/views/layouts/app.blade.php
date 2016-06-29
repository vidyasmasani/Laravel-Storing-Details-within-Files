<!-- resources/views/layouts/app.blade.php -->

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Laravel Quickstart - Basic</title>

        <!-- CSS And JavaScript -->
        {!! Html::style('css/app.css') !!}

        {!! Html::script('js/jquery.min.js') !!}
        {!! Html::script('js/bootstrap.min.js') !!}

        <style>
        body { padding-top: 60px; }
        @media (max-width: 979px) {
            body { padding-top: 0px; }
        }
        </style>
    </head>

    <body>
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="/">Products</a>
            </div>
        </div>
        @yield('content')
    </body>
</html>
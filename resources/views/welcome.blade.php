<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Book My Studio</title>

        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                <div class="card" style="border:1px solid black;height:50px;background-color:black">
                    <div class="card-title text-center">
                        <h4 style="color:white;margin-top:10px">Book My Studio</h4>
                    </div>
                </div>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-sm-12">
                    <div id="app">
                        <div class="card">
                            <studio-app></studio-app>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Examen Tribunal</title>
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <script type="text/javascript" src="{{ asset('assets/js/jquery-1.9.1.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
  </head>
  <style media="screen">
    div{
      margin: 10px auto;
    }
  </style>
  <body>
    <div class="container">
      @yield('content')
    </div>
  </body>
</html>

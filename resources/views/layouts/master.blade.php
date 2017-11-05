<!doctype html>
<html lang="en">
  <head>
    <title>Fritz - Das Fahrkarten Tagging Tool</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    @yield('styles')

    <!-- VENDOR STYLESHEETS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.2.0/dist/leaflet.css"
integrity="sha512-M2wvCLH6DSRazYeZRIm1JnYyh22purTM+FDB5CsyxtQJYeKq83arPe5wgbNmcFXGqiSH2XR8dT/fJISVA1r/zQ=="
crossorigin=""/>

    <!-- APP STYLESHEET -->
    <link rel="stylesheet" href="/css/app.css">
  </head>

  <body>

    <div id="app">
      @section('nav')
        @include('layouts.nav')
      @show

      @yield('content')

    </div>

    <!-- VENDOR JS LIBRARIES -->
    <script src="https://use.fontawesome.com/f1be374268.js"></script>
    <script src="https://unpkg.com/leaflet@1.2.0/dist/leaflet.js"
integrity="sha512-lInM/apFSqyy1o6s89K4iQUKg6ppXEgsVxT35HbzUupEVRh2Eu9Wdl4tHj7dZO0s1uvplcYGmt3498TtHq+log=="
crossorigin=""></script>

    <!-- APP JS -->
    <script src="/js/app.js"></script>

    @yield('scripts')

  </body>
</html>
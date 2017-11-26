<!doctype html>
<html lang="en">
  <head>
    <title>Fritz - Das Fahrkarten Tagging Tool</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    @yield('styles')

    <link rel="stylesheet" href="/css/font-awesome.min.css"> {{-- TODO: create custom icon font --}}
    <link rel="stylesheet" href="/css/app.css">
  </head>

  <body class="{{ $body_class or '' }}">

    <div id="app">
      @section('nav')
        @include('explorer.nav')
      @show

      <main class="site-content">
        @yield('content')
      </main>
    </div>

    @yield('scripts_before_app')

    <script src="/js/app.js"></script>
    <script async defer
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB8Hv1DiXXRRs2iz9KpSABeoi3jaA0JddM&language=de&callback=initMap">
    </script>

    @yield('scripts_after_app')
  </body>
</html>
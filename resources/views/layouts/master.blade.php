<!doctype html>
<html lang="en">
  <head>
    <title>Fahrkartentool | Crowdsourcing für die historische Fahrkartensammlung des Deutschen Technikmuseum</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    @yield('styles')

    <link rel="stylesheet" href="/css/font-awesome.min.css"> {{-- TODO: create custom icon font --}}
    <link rel="stylesheet" href="/css/app.css">
  </head>

  <body class="{{ $body_class or '' }}">
    <div id="app" class="page-wrap">
      <header class="site-header">
        @section('nav')
          @include('explorer.nav')
        @show
      </header>

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
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="{{ route('index') }}">Fritz</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item {{ Route::currentRouteNamed('map.index') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('map.index') }}">
          <i class="fa fa-globe" aria-hidden="true"></i>
          Karte
        </a>
      </li>
      <li class="nav-item {{ Route::currentRouteNamed('tickets.index') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('tickets.index') }}">
          <i class="fa fa-ticket" aria-hidden="true"></i>
          Tickets
        </a>
      </li>
      <li class="nav-item {{ Route::currentRouteNamed('locations.index') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('locations.index') }}">
          <i class="fa fa-map-marker" aria-hidden="true"></i>
          Orte
        </a>
      </li>
      {{-- 
      <li class="nav-item {{ Route::currentRouteNamed('tags.index') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('tags.index') }}">Tags</a>
      </li>
      --}}
      <li class="nav-item {{ Route::currentRouteNamed('game.index') ? 'active' : '' }} ml-auto">
        <a class="nav-link" href="{{ route('game.index') }}">
          <i class="fa fa-arrow-right" aria-hidden="true"></i>
          Zum Spiel
        </a>
      </li>
    </ul>
  </div>
</nav>
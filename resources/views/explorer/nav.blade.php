<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="{{ route('home') }}">Fahrkartentool</a>
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
      <li class="nav-item {{ Route::currentRouteNamed('categories.index') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('categories.index') }}">
          <i class="fa fa-tag" aria-hidden="true"></i>
          Kategorien
        </a>
      </li>
      <li class="nav-item {{ Route::currentRouteNamed('about') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('about') }}">
          <i class="fa fa-info-circle" aria-hidden="true"></i>
          Info
        </a>
      </li>
      
      <li class="nav-item ml-auto">
        <a class="btn btn-primary" href="{{ route('game.index') }}">
          <i class="fa fa-arrow-right" aria-hidden="true"></i>
          Spielen
        </a>
      </li>
    </ul>
  </div>
</nav>
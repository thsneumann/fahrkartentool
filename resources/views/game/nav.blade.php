<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="{{ route('index') }}">Fritz</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    {{-- 
    @if (isset($points))
      @if ($points > 0)
        <li class="navbar-text">
          <span>Punktestand: {{ $points }}</span>
        </li>
      @endif
    @endif
    --}}
    <ul class="navbar-nav">
      @if (Auth::check())
        <li class="nav-item">
          <a class="nav-link" href="{{ route('logout') }}">
            <i class="fa fa-sign-out" aria-hidden="true"></i>
            Ausloggen
          </a>
        </li> 
      @endif
      <li class="nav-item {{ Route::currentRouteNamed('game.highscore') }}">
        <a class="nav-link" href="{{ route('game.highscore') }}">
          <i class="fa fa-trophy" aria-hidden="true"></i>
          Bestenliste
        </a>
      </li>
      <li class="nav-item {{ Route::currentRouteNamed('game.index') ? 'active' : '' }} ml-auto">
        <a class="nav-link" href="{{ route('map.index') }}">
          <i class="fa fa-arrow-right" aria-hidden="true"></i>
          Zum Explorer
        </a>
      </li>
    </ul>
  </div>
</nav>
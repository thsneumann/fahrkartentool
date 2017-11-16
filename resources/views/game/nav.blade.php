<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="{{ route('index') }}">Fritz</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    @if (isset($points))
      @if ($points > 0)
        <li class="navbar-text">
          <span>Punktestand: {{ $points }}</span>
        </li>
      @endif
    @endif
    <ul class="navbar-nav">
      <li class="nav-item {{ Route::currentRouteNamed('game.index') ? 'active' : '' }} ml-auto">
        <a class="nav-link" href="{{ route('map.index') }}">Zum Explorer</a>
      </li>
    </ul>
  </div>
</nav>
<nav class="navbar navbar-expand-lg navbar-light bg-light mb-3">
  <a class="navbar-brand" href="{{ route('admin.index') }}">Admin</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="{{ route('admin.index') }}">Start <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('map.index') }}">Karte</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('tickets.index') }}">Tickets</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('locations.index') }}">Orte</a>
      </li>
    </ul>
  </div>
</nav>
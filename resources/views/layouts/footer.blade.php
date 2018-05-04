<footer class="site-footer">

  <nav class="navbar navbar-expand-md navbar-light bg-light">
    <ul class="navbar-nav">
      <li class="ml-md-auto nav-item {{ Route::currentRouteNamed('privacy') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('privacy') }}">
          <i class="fa fa-info-circle" aria-hidden="true"></i>
          Datenschutzerklärung
        </a>
      </li>
      <li class="nav-item {{ Route::currentRouteNamed('imprint') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('imprint') }}">
          <i class="fa fa-info-circle" aria-hidden="true"></i>
          Impressum
        </a>
      </li>
    </ul>
  </nav> 

</footer>
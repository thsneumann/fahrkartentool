@extends('layouts.master', ['body_class' => 'intro-page'])

@section('nav')
@endsection

@section('content')
  <div class="container-fluid">
    <div class="row mb-3">
      <div class="col-sm-6">
        <h1 class="text-uppercase text-nowrap font-weight-bold">Los geht&apos;s!</h1>
      </div>
      <div class="col-sm-6">
        <nav class="navbar navbar-light">
            <ul class="navbar-nav">
              <li class="nav-item ml-sm-auto">
                <a class="nav-link text-size-2" href="{{ route('about') }}">
                  <i class="fa fa-info-circle" aria-hidden="true"></i>
                  Info
                </a>
              </li>
            </ul>
          </div>
        </nav>
    </div>
    
    <div class="row mb-3">
      <div class="col-lg-7">
        <p class="mb-2">Wie schön, dass Sie sich an der Erschließung der historischen Fahrkartensammlung des Deutschen Technikmuseums in Berlin beteiligen wollen.</p>
        <p class="mb-2"><strong>Und so funktioniert das Ganze:</strong> Sie können auf zwei Arten an den Fahrkarten arbeiten: Im ersten Modus schreiben Sie bitte die Informationen von den Karten in die passenden Felder. Im zweiten Modus überprüfen Sie die Einträge, die bereits gemacht wurden.</p>
        <p class="mb-2"><strong>Und für alle Ihre Aktionen sammeln Sie PUNKTE!</strong> Schaffen Sie es bis zum 31. Dezember 2018 ganz nach oben in der Bestenliste? Die ersten Drei nach Punkten dürfen sich auf ein Dankeschön von der Stiftung Deutsches Technikmuseum Berlin freuen!</p>
        <p class="mb-2"><strong>Im Menü Erkunden können Sie mitverfolgen, wie die Daten wachsen.</strong> Dort sind die Infos von allen bereits bearbeiteten Tickets abrufbar – auf einer Karte oder in verschiedenen Listen.</p>
        <p><strong>Und noch besser:</strong> Alle Einträge, die gesammelt wurden, können per JSON/CSV-Export runterladen werden. Bitte nutzen oder teilen Sie die Daten. Es gilt die Creative Commons Lizenz CC0.</p> 
      </div>
      <div class="col-lg-4 offset-lg-1">
        @include('partials/image-grid')
      </div>
    </div>

    <div class="row">
      <div class="col-sm-8">
        <div class="footer-links">
          <a href="{{ route('explore.index') }}" class="d-flex align-items-center font-weight-bold text-uppercase text-size-3">
              Erkunden
              <img src="img/pfeil_rechts.png" alt="Pfeil nach rechts." class="ml-auto">
          </a>
          <br>
          <a href="{{ route('edit.index') }}" class="d-flex align-items-center font-weight-bold text-uppercase text-size-3">
              Bearbeiten
              <img src="img/pfeil_rechts.png" alt="Pfeil nach rechts." class="ml-auto">
          </a>
        </div>
      </div>
    </div>
  </div>
@endsection
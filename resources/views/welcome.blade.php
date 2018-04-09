@extends('layouts.master', ['body_class' => 'welcome-page'])

@section('nav')
@endsection

@section('content')

<div class="container-fluid">
    <div class="row mb-5">
        <div class="col">
            <p class="text-size-3 text-uppercase font-weight-bold">Herzlich Willkommen!</p>
        </div>
    </div>

    <div class="row mb-5">
        <div class="col-sm-5">
            <h1 class="text-uppercase font-weight-bold mb-4">Fritz-Ticket-Tool</h1>
            <div class="text-size-1 font-weight-bold">
                <p>Die Historische Fahrkartensammlung<br>
                des Deutschen Technikmuseums<br>
                … gesammelt von Opernsänger Fritz Hellmuth,<br>
                … abgeschrieben von der Crowd!<br>
                </p>
                <p>
                Bergen Sie mit uns den Schatz von 120.000 internationalen Tickets aus der Zeit der Entstehung des Personenverkehrs Mitte des 19. Jahrhunderts bis 1925.
                </p>
            </div>
        </div>
        <div class="col-sm-4 offset-sm-3">
            @include('partials/image-grid')
        </div>
    </div>

    <div class="row">
        <div class="col-sm-8">
            <a href="{{ route('intro') }}" class="arrow-link">
                Los geht&apos;s!
                <img src="img/pfeil_rechts.png" alt="Pfeil nach rechts.">
            </a>
        </div>
        <div class="col-sm-4">
            <a href="#intro-video" class="video-preview" data-fancybox data-small-btn="true">
                <img src="img/video-vorschau.jpg" alt="Vorschaubild Erklärvideo.">
                <img src="img/pfeil_rechts.png" alt="Pfeil nach rechts." class="play-button">
            </a>
        </div>
    </div>
</div>

<video id="intro-video" controls style="display: none">
    <source src="{{ asset('video/intro.mp4') }}" type="video/mp4">
    Ihr Browser unterstützt keine HTML5-Videos.
</video>

</div>

@endsection
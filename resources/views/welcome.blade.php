@extends('layouts.master', ['body_class' => 'welcome-page'])

@section('nav')
@endsection

@section('content')

    <div class="container-fluid d-flex flex-column">
        <div class="row mb-3">
            <div class="col-lg-6 col-xl-5">
                <p class="text-size-3 text-uppercase font-weight-bold">Herzlich Willkommen!</p>

                <h1 class="text-size-3 text-uppercase font-weight-bold mb-4">Fritz-Fahrkartentool</h1>
                <div class="text-size-1 font-weight-bold">
                    <p>Die historische Fahrkartensammlung
                        <br> des Deutschen Technikmuseums
                        <br> … gesammelt von Opernsänger Fritz Hellmuth,
                        <br> … bearbeitet von der Crowd!
                        <br>
                    </p>
                    <p>
                        Bergen Sie mit uns den Schatz von 120.000 internationalen Tickets aus der Zeit der Entstehung des Personenverkehrs Mitte
                        des 19. Jahrhunderts bis 1925.
                    </p>
                </div>
            </div>
            <div class="col-lg-5 offset-lg-1 col-xl-4 offset-xl-3">
                @include('partials/image-grid')
            </div>
        </div>

        <div class="row align-items-end mt-auto">
            <div class="col-md-7 col-lg-8 mb-3 mb-md-0">
                <img src="{{ asset('img/raute_technikmuseum.png') }}" alt="Logo Stiftung Deutsches Technikmuseum" class="mb-3">
                <div class="d-flex align-items-start">
                    <a href="{{ route('intro') }}" class="d-flex align-items-center font-weight-bold text-uppercase text-size-3 mb-2 mb-sm-0">
                        Los geht&apos;s!
                        <img src="{{ asset('img/pfeil_rechts.png') }}" alt="Pfeil nach rechts." class="ml-4">
                    </a>
                </div>
            </div>
            <div class="col-md-5 col-lg-4">
                <a href="#intro-video" class="video-preview" data-fancybox-video data-small-btn="true">
                    <figure class="mb-0">
                        <img src="{{ asset('img/video-vorschau.jpg') }}" alt="Vorschaubild Erklärvideo.">
                        <figcaption class="d-flex align-items-center caption text-size-1 text-uppercase">
                            Zum Video über Fritz
                            <img src="{{ asset('img/pfeil_rechts.png') }}" width="30" alt="Pfeil nach rechts." class="ml-2">
                        </figcaption>
                    </figure>
                </a>
            </div>
        </div>
    </div>

    <video id="intro-video" controls style="display: none">
        <source src="{{ asset('video/intro.mp4') }}" type="video/mp4"> Ihr Browser unterstützt keine HTML5-Videos.
    </video>

@endsection
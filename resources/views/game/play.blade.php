@extends('layouts.master')

@section('nav')
    @include('game.nav')
@endsection

@section('content')

<div class="container">
    <div class="media mb-4">
        <div class="media-body">
            @if ($points == 0)
                <h2>Auf geht die Reise!</h2>
                <p>
                    Hilf mir, das Bild mit Metadaten anzureichern.<br>
                    Trage Abfahrts- und Zielort ein.<br>
                    Ordne das Ticket einer Kategorie zu.<br>
                    Falls du es erkennen kannst, gib Wagenklasse und Preis an.<br>
                    Du weißt noch mehr? Notiere es unter "Zusatzinformationen". 
                </p>
            @elseif ($points == 1)
                <h2>Klasse!</h2>
                <p>Du hast dein erstes Ticket bearbeitet.<br>
                Für jedes Ticket erhältst du einen Punkt.<br>
                Sammle viele Punkte und erobere die Bestenliste.</p>
            @else
                <h2>Vielen Dank!</h2>

                @if (Auth::check())
                    <p>Du hast jetzt {{ session()->get('points') }} Punkte.</p>
                @else
                    <p>Du hast schon {{ $points }} Punkte.<br>
                        <a href="{{ route('register') }}">Erstelle ein Profil, um deinen Punktestand zu speichern.</a><br>
                        Du hast bereits ein Profil? <a href="{{ route('login') }}">Dann logge dich ein.</a>
                    </p>
                @endif
            @endif

            @if ($mode == 'check') 
                <div class="alert alert-info mb-0">
                    Hilf uns, die Eingaben anderer Benutzer zu kontrollieren.
                    Ergänze fehlende oder korrigiere falsche Angaben.
                </div>
            @endif
        </div>
        <img class="ml-5 img-small align-self-end" src="/img/fritz_portrait.jpg" alt="Ein imaginiertes Porträt von Fritz Hellmuth.">
    </div>


    

    @include('tickets.edit-form', ['mode' => 'mode', 'redirect' => 'back'])

    <hr>

    @include('partials.back-button', ['route' => route('game.index')])
</div>


@endsection
@extends('layouts.master', ['mode' => 'edit'])

@section('content')

<div class="container">
    <div class="media mb-4">
        <div class="media-body">
            @if ($points == 0)
                <h2>Die Reise beginnt!</h2>
                <p>Bitte schreiben Sie alle Informationen der Fahrkarten ab.</p>
                <p>Besonders interessieren uns die Abfahrts- und Zielort. Sind Zwischenstopps angegeben, notieren Sie diese auch!<br>
                    Ordnen Sie die Tickets bitte auch den Kategorien zu.<br>
                    Falls es erkennbar ist, geben Sie bitte Wagenklasse und Preis an.<br>
                    Das Datum ist oftmals eingeprägt und in der Vergrößerung gut sichtbar. Bitte dafür auf´s Bild klicken.<br>
                    Wissen Sie noch mehr? Notieren Sie es gern im Feld für Zusatzinformationen.
                </p>
            @elseif ($points == 1)
                <h2>Klasse!</h2>
                <p>Sie haben Ihr erstes Ticket bearbeitet.<br>
                Für jedes Ticket erhalten Sie einen Punkt.<br>
                Sammeln Sie viele Punkte und erobern Sie die Bestenliste!</p>
            @else
                <h2>Vielen Dank!</h2>

                @if (Auth::check())
                    <p>Sie haben jetzt {{ session()->get('points') }} Punkte.</p>
                @else
                    <p>
                        Sie haben schon {{ $points }} Punkte.<br>
                        <a href="{{ route('register') }}">
                            Erstellen Sie ein Profil, um Ihren Punktestand zu speichern.
                        </a>
                        <br>
                        Sie haben bereits ein Profil? 
                        <a href="{{ route('login') }}">Dann loggen Sie sich ein.</a>
                    </p>
                @endif
            @endif

            @if ($mode == 'check') 
                <div class="alert alert-info mb-0">
                    Helfen Sie uns bitte, die Eingaben anderer Benutzer zu kontrollieren.
                    Ergänzen Sie bitte fehlende oder korrigieren Sie falsche Angaben.
                </div>
            @endif
        </div>
    </div>

    @include('tickets.edit-form')
</div>


@endsection
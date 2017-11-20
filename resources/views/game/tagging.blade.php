@extends('layouts.master')

@section('nav')
    @include('game.nav')
@endsection

@section('content')

<div class="container">
    @if ($points == 0)
        <h2>Auf geht die Reise!</h2>
        <p>Hilf uns, das Bild mit Metadaten anzureichern.<br>
        Notiere im Feld "Beschreibung", was auf dem Ticket zu lesen ist.<br>
        Trage Abfahrts- und Zielort ein.</p>
    @elseif ($points == 1)
        <h2>Klasse!</h2>
        <p>Du hast dein erstes Ticket bearbeitet. Gratuliere!<br>
        Für jedes Ticket erhältst du einen Punkt.<br>
        Sammle viele Punkte, um tolle Extras zu erhalten.</p>
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

    @include('tickets.edit-form', ['redirect' => 'back'])

    <hr>

    @include('partials.back-button', ['route' => route('game.index')])
</div>


@endsection
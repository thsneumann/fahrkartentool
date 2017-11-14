@extends('layouts.master')

@section('content')

<div class="container">
    <h2>Auf geht die Reise!</h2>
    <p>Hilf uns, das Bild mit Metadaten anzureichern.<br>
     Notiere im Feld "Beschreibung", was auf dem Ticket zu lesen ist.<br>
     Trage Abfahrts- und Zielort ein.</p>
    
    @include('tickets.edit-form', ['redirect' => 'back'])

    <hr>

    @include('partials.back-button', ['route' => route('game.index')])
</div>


@endsection
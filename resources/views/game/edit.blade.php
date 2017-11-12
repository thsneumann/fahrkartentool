@extends('layouts.master')

@section('nav')
@endsection

@section('content')

<div class="container">
    <h2>Los geht's</h2>
    <p>Hilf uns, das Bild mit Metadaten anzureichern.<br>
     Notiere im Feld "Beschreibung", was auf dem Ticket zu lesen ist.</p>
    
    @include('tickets.edit-form', ['redirect' => 'back'])

    <hr>

    @include('partials.back-button', ['route' => route('home')])
</div>


@endsection
@extends('layouts.master', ['body_class' => 'homepage'])

@section('nav')
@endsection

@section('content')

<h1 class="home-title">Das Fahrkartentool</h1>

<nav id="home-nav" class="home-nav">
    <a href="{{ route('map') }}" role="button" class="btn btn-lg btn-primary mr-3">Erkunden</a>
    <a href="{{ route('game.index') }}" role="button" class="btn btn-lg btn-primary">Spielen</a>
</nav>

@endsection
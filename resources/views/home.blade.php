@extends('layouts.master', ['body_class' => 'homepage'])

@section('nav')
@endsection

@section('scripts_before_app')

<script src="//d3js.org/d3.v3.min.js"></script>
<script src="//d3js.org/topojson.v1.min.js"></script>

@endsection

@section('content')

<h1 class="home-title"><strong>FRITZ</strong><br>reist um die Welt</h1>

<video id="home-globe" class="home-globe" src="/video/globe.m4v" autoplay="true" loop="true"></video>

<nav id="home-nav" class="home-nav">
    <a href="{{ route('map.index') }}" role="button" class="btn btn-lg btn-primary mr-3">Erkunden</a>
    <a href="{{ route('game.index') }}" role="button" class="btn btn-lg btn-primary">Spielen</a>
</nav>

@endsection
@extends('layouts.master', ['body_class' => 'page-home'])

@section('nav')
@endsection

@section('scripts')

<script src="//d3js.org/d3.v3.min.js"></script>
<script src="//d3js.org/topojson.v1.min.js"></script>

@endsection

@section('content')

<rotating-globe></rotating-globe>

<nav id="home-nav">
    <a href="{{ route('map.index') }}" role="button" class="btn btn-lg btn-primary mr-3">Erkunden</a>
    <a href="{{ route('game.index') }}" role="button" class="btn btn-lg btn-primary">Taggen</a>
</nav>

@endsection
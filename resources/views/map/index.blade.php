@extends('layouts.master', ['body_class' => 'map-page'])

@section('styles')

@endsection

@section('content')

@include('map.technikmuseum')

<explorer-map></explorer-map>

@endsection
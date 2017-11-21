@extends('layouts.master')

@section('content')

<div class="container-fluid">
    <h2>Ort bearbeiten</h2>

    <div class="row">
    <div class="col-md-4">
        <form method="POST" action="{{ route('locations.update', ['id' => $location->id]) }}">
            {{ csrf_field() }}
            <input type="hidden" name="_method" value="PUT">

            <location-editor :default-location="{{ json_encode($location) }}"></location-editor>

            <button type="submit" class="btn btn-primary">Speichern</button>
        </form>
    </div>
</div>

<hr>

@include('partials.back-button')
</div>

@endsection
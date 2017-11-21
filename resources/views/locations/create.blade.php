@extends('layouts.master')

@section('content')

<div class="container-fluid">
    <h2>Ort hinzufügen</h2>

    <div class="row">
        <div class="col-md-4">
            <form method="POST" action="{{ route('locations.store') }}">
                {{ csrf_field() }}
                <input type="hidden" name="redirect" value="{{ $redirect or '' }}">

                <location-editor></location-editor>

                <button type="submit" class="btn btn-primary">Speichern</button>
            </form>
        </div>
    </div>

    <hr>

    @include('partials.back-button')
</div>

@endsection
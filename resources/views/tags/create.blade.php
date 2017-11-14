@extends('layouts.master')

@section('content')

<div class="container-fluid">
    <h2>Tag hinzufügen</h2>

    <div class="row">
    <div class="col-md-4">
        <form method="POST" action="{{ route('tags.store') }}">
            {{ csrf_field() }}

            <div class="form-group">
                <label for="name">Name:</label>
                <input id="name" name="name" class="form-control">
            </div>

            <button type="submit" class="btn btn-primary">Speichern</button>
        </form>
    </div>
</div>

<hr>

@include('partials.back-button')
</div>

@endsection
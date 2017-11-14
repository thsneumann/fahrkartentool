@extends('layouts.master')

@section('content')

<div class="container-fluid">
    <h2>Tag bearbeiten</h2>

    <div class="row">
    <div class="col-md-4">
        <form method="POST" action="{{ route('tags.update', ['id' => $tag->id]) }}">
            {{ csrf_field() }}
            <input type="hidden" name="_method" value="PUT">

            <div class="form-group">
                <label for="name">Name:</label>
                <input id="name" name="name" class="form-control" value="{{ $tag->name }}">
            </div>

            <button type="submit" class="btn btn-primary">Speichern</button>
        </form>
    </div>
</div>

<hr>

@include('partials.back-button')
</div>

@endsection
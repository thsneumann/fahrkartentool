@extends('layouts.master')

@section('content')

<div class="container">
    <h2>Ticket bearbeiten</h2>

    @include('tickets.edit-form')
    
    <hr>

    @include('partials.back-button')
</div>


@endsection
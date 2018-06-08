@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            @if (Auth::check())
                <p class="mb-4">
                    Sie sind jetzt als Benutzer <strong>{{ auth()->user()->name }}</strong> angemeldet.
                </p>
                <a href="{{ route('delete-account.index') }}" class="btn btn-danger">Account löschen</a>
            @else
                Sie wurden erfolgreich ausgeloggt.
            @endif
        </div>
    </div>
</div>
@endsection
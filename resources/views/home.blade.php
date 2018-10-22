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
                <p>
                    Sie sind jetzt als Benutzer <strong>{{ auth()->user()->name }}</strong> angemeldet.
                </p>
                <p class="mb-4">
                    Ihr aktueller Punktestand beträgt <strong>{{ auth()->user()->points }} Punkt{{ auth()->user()->points != 1 ? 'e' : '' }}.</strong>
                </p>
                @if (Auth()->user()->is_admin)
                    <p>
                        <a href="{{ route('admin') }}">Zur Admin-Seite</a>
                    </p>
                @endif
                @if (!Auth()->user()->is_super_admin)
                    <p>
                        <a href="{{ route('delete-account.index') }}" class="btn btn-danger">Account löschen</a>
                    </p>
                @endif
            @else
                Sie wurden erfolgreich ausgeloggt.
            @endif
        </div>
    </div>
</div>
@endsection
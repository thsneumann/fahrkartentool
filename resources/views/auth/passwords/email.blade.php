@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-2">
            <h2>Passwort zurücksetzen</h2>

            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}">
                {{ csrf_field() }}

                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email">E-Mail-Adresse</label>
                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                    @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                    @endif
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">
                        Link zum Zurücksetzen des Passworts senden
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-2">
            <h2>Einloggen</h2>

            <form method="POST" action="{{ route('login') }}">
                {{ csrf_field() }}

                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email">E-Mail-Adresse</label>

                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <label for="password">Passwort</label>

                    <input id="password" type="password" class="form-control" name="password" required>

                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Angemeldet bleiben
                        </label>
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">
                        Login
                    </button>

                    <a class="btn btn-link" href="{{ route('password.request') }}">
                        Passwort vergessen?
                    </a>
                </div>
            </form>

            <p>Noch kein Profil?<br>
            <a href="{{ route('register') }}">Hier können Sie sich registrieren.</a>
        </div>
    </div>
</div>
@endsection

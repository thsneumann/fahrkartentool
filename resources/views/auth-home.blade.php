@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    Du bist jetzt eingeloggt.<br>
                    <a href="{{ route('game.index') }}">Zum Spiel</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

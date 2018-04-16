@extends('layouts.master')

@section('nav')
@endsection

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
                    
                    <a href="{{ route('edit.index') }}">Bearbeiten</a><br>
                    <a href="{{ route('map') }}">Erkunden</a>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
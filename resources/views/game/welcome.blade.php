@extends('layouts.master')

@section('nav')
    @include('game.nav')
@endsection

@section('content')

<div class="container">
    <div class="media">
        <div class="media-body">
            <h2 class="mt-0 mb-4">Willkommen!</h5>
            <p>Ich bin Fritz. Fritz Hellmuth. Als Opernsänger bereiste ich die ganze Welt.<br> 
            Auf meinen Reisen sammelte ich Tausende von Fahrkarten aus aller Herren Länder.<br>
            Ach Gott, es sind so viele, ich habe ganz den Überblick verloren.<br>
            Kannst du mir helfen, etwas Ordnung in dieses Wirrwarr zu bringen?<br>

            <a href="{{ route('game.play') }}" class="btn btn-primary mt-5">
                <i class="fa fa-thumbs-o-up" aria-hidden="true"></i>
                Na klar, Fritz!
            </a>
        </div>
        <img class="ml-3" src="/img/fritz_portrait.jpg" alt="Ein imaginiertes Porträt von Fritz Hellmuth.">
    </div>
    

</div>

@endsection
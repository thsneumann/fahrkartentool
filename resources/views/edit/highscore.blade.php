@extends('layouts.master', ['mode' => 'edit'])

@section('content')

<div class="container-fluid">
    <h2>Bestenliste</h2>

    <div class="alert alert-success" role="alert">
        <p>Danke für alle Unterstützer im Jahr 2018. Durch Ihre Hilfe konnten in nur wenigen Monaten beachtlich viele Karten verschlagwortet werden.</p>
        <p>Unser besonderer Dank geht an Schwarze Jule Frost, snoor 33 und Max!</p>
    </div>

    <table class="table">
        <thead>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Punkte</th>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <th scope="row">{{ $loop->iteration }}</th>
                <td>
                    {{ $user->name }}
                    @if ($loop->iteration <= 3)
                        <i class="fa fa-lg fa-trophy"></i>
                    @endif
                </td>
                <td>{{ $user->points or 0 }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
@extends('layouts.master', ['mode' => 'edit'])

@section('content')

<div class="container-fluid">
    <h2>Bestenliste</h2>

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
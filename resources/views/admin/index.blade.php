@extends('layouts.master')

@section('content')

  <div class="container-fluid">
    <h2 class="mb-4">Adminbereich</h2>

    <section class="mb-4">
      <h3>Statistiken</h3>

      <p>Tickets insgesamt:
        <strong>{{ $ticketsCount }}</strong>
      </p>
      <p>Bearbeitete Tickets:
        <strong>{{ $editedTicketsCount }}</strong>
      </p>
    </section>

    <section>
      <h3>Benutzer</h3>

      @if (count($users) > 0)
        <table class="table">
          <thead>
            <tr>
              <th scope="col">ID</th>
              <th scope="col">Name</th>
              <th scope="col">E-Mail</th>
              <th scope="col">Punkte</th>
              <th scope="col">registriert am</th>
              <th scope="col">Admin?</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($users as $user)
              <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->points }}</td>
                <td>{{ $user->created_at->format('d. m. Y') }}</td>
                <td>
                  @if ($user->is_admin)
                    <i class="fa fa-check" aria-hidden="true"></i>
                    @else
                    <i class="fa fa-times" aria-hidden="true"></i>
                  @endif
              </tr>
            @endforeach
          </tbody>
        </table>
        @else
        <em>Keine Benutzer vorhanden.</em>
      @endif
    </section>
  </div>

@endsection
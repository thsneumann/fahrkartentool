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
                  <form action="{{ route('admin.toggle') }}" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                    @if ($user->is_admin)
                      <button class="btn btn-sm btn-success" type="submit" {{ $user->id == auth()->user()->id || $user->is_super_admin ? 'disabled' : '' }}>
                        <i class="fa fa-check" aria-hidden="true"></i>
                      </button>
                    @else
                      <button class="btn btn-sm btn-danger" type="submit">
                        <i class="fa fa-times" aria-hidden="true"></i>
                      </button>
                    @endif
                  </form>
                </td>
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
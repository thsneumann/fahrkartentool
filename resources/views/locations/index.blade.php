@extends('layouts.master')

@section('content')

<div class="container-fluid">
    @if (Auth::check() && Auth::user()->is_admin)
        <div class="form-group">
            <a href="{{ route('locations.create') }}" role="button" class="btn btn-primary mb-3">
                <i class="fa fa-plus" aria-hidden="true"></i>
                Ort hinzufügen
            </a>
        </div>
    @endif

    @if (count($locations) > 0)
        <table class="table">
            <thead>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Langname</th>
                <th scope="col">Breitengrad</th>
                <th scope="col">Längengrad</th>
                <th scope="col">Tickets mit diesem Abfahrort</th>
                <th scope="col">Tickets mit diesem Zielort</th>
                <th scope="col">Aktionen</th>
            </thead>
            <tbody>
                @foreach ($locations as $location)
                    <tr>
                        <th scope="row">{{ $location->id }}</th>
                        <td>{{ $location->name }}</td>
                        <td>{{ $location->longname }}</td>
                        <td>{{ $location->lat }}</td>
                        <td>{{ $location->lng }}</td>
                        <td>{{ count($location->originFor) }}</td>
                        <td>{{ count($location->destinationFor) }}</td>
                        <td class="d-flex">
                            <a href="{{ route('locations.edit', $location->id) }}" class="btn btn-sm btn-primary mr-2" role="button">
                                <i class="fa fa-pencil" aria-hidden="true"></i>
                            </a>

                            @if (Auth::check() && Auth::user()->is_admin)
                                <form method="POST" action="{{ route('locations.destroy', $location->id) }}">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                    </button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $locations->links() }}
    @else
        <p><em>Es sind noch keine Orte vorhanden.</em></p>
    @endif
</div>
    
</body>
</html>
@endsection
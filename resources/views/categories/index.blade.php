@extends('layouts.master')

@section('content')

<div class="container-fluid">
    <div class="form-group">
        @if (Auth::check() && Auth::user()->is_admin)
            <a href="{{ route('categories.create') }}" role="button" class="btn btn-primary mb-3">
                <i class="fa fa-plus" aria-hidden="true"></i>
                Kategorie hinzufügen
            </a>
        @endif
    </div>

    <table class="table">
        <thead>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Anzahl Tickets</th>
            <th scope="col">Aktionen</th>
        </thead>
        <tbody>
            @foreach ($categories as $category)
                <tr>
                    <th scope="row">{{ $category->id }}</th>
                    <td>{{ $category->name }}</td>
                    <td>{{ count($category->tickets) }}</td>
                    <td class="d-flex">
                        <a href="{{ route('categories.edit', ['id' => $category->id]) }}" class="btn btn-sm btn-primary mr-2" role="button">
                            <i class="fa fa-pencil" aria-hidden="true"></i>
                        </a>
                        
                        @if (Auth::check() && Auth::user()->is_admin)
                            <form method="POST" action="{{ route('categories.destroy', ['id' => $category->id]) }}">
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
</div>
    
</body>
</html>
@endsection
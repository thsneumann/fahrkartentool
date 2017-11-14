@extends('layouts.master')

@section('content')

<div class="container-fluid">
    <div class="form-group">
        <a href="{{ route('tags.create') }}" role="button" class="btn btn-primary mb-3">
            <i class="fa fa-plus" aria-hidden="true"></i>
            Tag hinzufügen
        </a>
    </div>

    <table class="table">
        <thead>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Anzahl Tickets</th>
            <th scope="col">Aktionen</th>
        </thead>
        <tbody>
            @foreach ($tags as $tag)
                <tr>
                    <th scope="row">{{ $tag->id }}</th>
                    <td>{{ $tag->name }}</td>
                    <td>{{ count($tag->tickets) }}</td>
                    <td class="d-flex">
                        <a href="{{ route('tags.edit', ['id' => $tag->id]) }}" class="btn btn-sm btn-primary mr-2" role="button">
                            <i class="fa fa-pencil" aria-hidden="true"></i>
                        </a>
                        <form method="POST" action="{{ route('tags.destroy', ['id' => $tag->id]) }}">
                            {{ csrf_field() }}
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit" class="btn btn-sm btn-danger">
                                <i class="fa fa-trash" aria-hidden="true"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $tags->links() }}
</div>
    
</body>
</html>
@endsection
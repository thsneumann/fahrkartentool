@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-7 col-md-offset-2">
            @if (isset($account_deleted))
                <p>Ihr Account wurde gelöscht.</p>
            @else
                <div class="alert alert-danger">
                Sind Sie sicher, dass Sie Ihren Account löschen möchten?<br>
                Damit werden Ihre Logindaten und die erreichte Punktezahl gelöscht.
                </div>

                <form method="POST" action="{{ route('delete-account.delete') }}">
                    {{ csrf_field() }}
                    <button typ="submit" class="btn btn-danger">Löschung bestätigen</button>
                </form>  
            @endif
        </div>
    </div>
</div>
@endsection
@extends('layouts.master')

@section('styles')

@endsection

@section('content')

<explorer-map></explorer-map>

@endsection

@section('scripts_after_app')
<script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB8Hv1DiXXRRs2iz9KpSABeoi3jaA0JddM&language=de&callback=initMap">
    </script>
    
@endsection
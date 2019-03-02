@extends('layouts.default')

@section('content')

    <div class="container">
        <playlist-stats
            playlist_type="{{ $playlist_type }}"
        ></playlist-stats>
    </div>

@endsection

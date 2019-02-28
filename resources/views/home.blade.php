@extends('layouts.default')

@section('content')

    <div class="container">
        <h1 class="header-font">All Playlists <span style="white-space: nowrap">(Cross-Platform)</span></h1>

        <div class="grid-3-col">
            @foreach ($player_stats as $username => $stat)
                <div class="card">
                    <h2 class="card-header">{{ $username }}</h2>
                    <ul>
                        <li><strong>Matches:</strong> {{ $stat['matches_played'] }}</li>
                        <li><strong>Wins:</strong> {{ $stat['top_1'] }}</li>
                        <li><strong>Kills:</strong> {{ $stat['kills'] }}</li>
                        <li><strong>Deaths:</strong> {{ $stat['deaths'] }}</li>
                        <li><strong>K/D:</strong> {{ $stat['kd'] }}</li>
                    </ul>
                </div>
            @endforeach
        </div>

    </div>

@endsection

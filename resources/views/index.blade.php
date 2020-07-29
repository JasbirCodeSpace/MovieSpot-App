@extends('layouts.main')

@section('content')
<div class="container mx-auto px-4 pt-16">
    {{-- start of popular movies --}}
    <div class="popular-movies">
        <h2 class="uppercase tracking-wider text-orange-500 text-lg font-semibold">
            Popular Movies
        </h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-16">
            @foreach($popularMovies as $movie)
                <x-movie-card :movie="$movie" />
            @endforeach
        </div>
    </div>
    {{-- end of popular movies --}}
    {{-- start of now playing movies --}}
    <div class="now-playing-movies">
        <h2 class="uppercase tracking-wider text-orange-500 text-lg font-semibold mt-4">
            Now Playing
        </h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-16">
            @foreach($nowPlayingMovies as $movie)
                <x-movie-card :movie="$movie" />
            @endforeach
        </div>
    </div>
    {{-- end of now playing movies --}}
</div>
@endsection

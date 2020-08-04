@extends('layouts.main')

@section('content')
<div class="container mx-auto px-4 pt-16">
    {{-- start of popular tv --}}
    <div class="popular-tv">
        <h2 class="uppercase tracking-wider text-orange-500 text-lg font-semibold">
            Popular Shows
        </h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-16">
            @foreach($popularTv as $tvShow)
                <x-tv-card :tvShow="$tvShow" />
            @endforeach
        </div>
    </div>
    {{-- end of popular tv --}}

    {{-- start of top rated shows --}}
    <div class="top-rated-shows py-24">
        <h2 class="uppercase tracking-wider text-orange-500 text-lg font-semibold mt-4">
            Top Rated Shows
        </h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-16">
            @foreach($topRatedTv as $tvShow)
                <x-tv-card :tvShow="$tvShow" />
            @endforeach
        </div>
    </div>
    {{-- end of top rated shows  --}}
</div>
@endsection

<?php

namespace App\ViewModels;

use Spatie\ViewModels\ViewModel;
use Carbon\Carbon;

class MovieViewModel extends ViewModel
{
    private $movie;

    public function __construct($movie)
    {
        $this->movie = $movie;
    }

    public function movie(){

        return collect($this->movie)->merge([
        'poster_path' => 'https://image.tmdb.org/t/p/w500'.$this->movie['poster_path'],
        'vote_average' => $this->movie['vote_average']*10 .'%',
        'release_date' => isset($movie['release_date']) ? Carbon::parse($movie['release_date'])->format('M d, Y') : '',
        'genres' => collect($this->movie['genres'])->pluck('name')->flatten()->implode(', '),
        'crew' => collect($this->movie['credits']['crew'])->take(2),
        'cast' => collect($this->movie['credits']['cast'])->take(5)->map(function($cast){
            return collect($cast)->merge([
                'profile_path'=>isset($cast['profile_path'])
                ?'https://image.tmdb.org/t/p/w500'.$cast['profile_path']
                :'https://via.placeholder.com/300x450',
            ]);
        }),
        'images' => collect($this->movie['images']['backdrops'])->take(9),
        ]
        )->only([
            'poster_path', 'id', 'genres', 'title', 'vote_average', 'overview', 'release_date',
            'credits', 'videos', 'images', 'crew', 'cast', 'images',
        ]);
    }


}

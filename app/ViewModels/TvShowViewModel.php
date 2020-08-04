<?php

namespace App\ViewModels;

use Spatie\ViewModels\ViewModel;
use Carbon\Carbon;

class TvShowViewModel extends ViewModel
{
    public $tvShow;

    public function __construct($tvShow)
    {
        $this->tvShow = $tvShow;
    }

    public function tvShow(){

        return collect($this->tvShow)->merge([
        'poster_path' => 'https://image.tmdb.org/t/p/w500'.$this->tvShow['poster_path'],
        'vote_average' => $this->tvShow['vote_average']*10 .'%',
        'first_air_date' => Carbon::parse($this->tvShow['first_air_date'])->format('M d, Y'),
        'genres' => collect($this->tvShow['genres'])->pluck('name')->flatten()->implode(', '),
        'crew' => collect($this->tvShow['credits']['crew'])->take(2),
        'cast' => collect($this->tvShow['credits']['cast'])->take(5)->map(function($cast){
            return collect($cast)->merge([
                'profile_path'=>isset($cast['profile_path'])
                ?'https://image.tmdb.org/t/p/w500'.$cast['profile_path']
                :'https://via.placeholder.com/300x450',
            ]);
        }),
        'images' => collect($this->tvShow['images']['backdrops'])->take(9),
        ]
        )->only([
            'poster_path', 'id', 'genres', 'name', 'vote_average', 'overview', 'first_air_date',
            'credits', 'videos', 'crew', 'cast', 'images','created_by',
        ])->dump();
    }


}

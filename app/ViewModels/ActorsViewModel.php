<?php

namespace App\ViewModels;

use Spatie\ViewModels\ViewModel;

class ActorsViewModel extends ViewModel
{
    private $popularActors;

    public function __construct($popularActors)
    {
        $this->popularActors = $popularActors;
    }

    public function popularActors(){
        
        return collect($this->popularActors)->map(function($actor){

            return collect($actor)->merge([

                'profile_path' => $actor['profile_path']
                ?'https://image.tmdb.org/t/p/w470_and_h470_face'.$actor['profile_path']
                :'https://ui-avatars.com/api/?size=470&name='.$actor['name'],

                'known_for'=>collect($actor['known_for'])->where('media_type', 'tv')->pluck('name')->union(
                    collect($actor['known_for'])->where('media_type', 'movie')->pluck('title')
                )->implode(', '),

                ])->only([
                    'name', 'id', 'profile_path','known_for'
                ]);
            })->dump();
    }
}

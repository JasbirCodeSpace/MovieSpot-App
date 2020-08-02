<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Spatie\ViewModels\ViewModel;

class ActorViewModel extends ViewModel
{
    protected $actor;
    protected $social;
    protected $credits;

    public function __construct($actor, $social, $credits)
    {
        $this->actor = $actor;
        $this->social = $social;
        $this->credits = $credits;
    }

    public function actor(){
        return collect($this->actor)->merge([
            'birthday'=> Carbon::parse($this->actor['birthday'])->format('M d, Y'),
            'age'=> Carbon::parse($this->actor['birthday'])->age,

            'profile_path'=>$this->actor['profile_path']
            ?'https://image.tmdb.org/t/p/w300'.$this->actor['profile_path']
            :'https://via.placeholder.com/300x450',

        ]);
    }

    public function social(){
        return collect($this->social)->merge([
            'twitter'=> $this->social['twitter_id']
            ?'https://twitter.com/'.$this->social['twitter_id']:null,

            'facebook'=> $this->social['facebook_id']
            ?'https://www.facebook.com/'.$this->social['facebook_id']:null,

            'instagram'=> $this->social['instagram_id']
            ?'https://www.instagram.com/'.$this->social['instagram_id']:null,
        ]);
    }

    public function credits(){
        
        $castTitles = collect($this->credits)->get('cast');
        return collect($castTitles)->map(function($movie){
            if(isset($movie['release_date'])){
                $releaseDate = $movie['release_date'];
            }elseif(isset($movie['first_year_date'])){
                $releaseDate = $movie['first_year_date'];
            }else{
                $releaseDate = '';
            }

            if(isset($movie['title'])){
                $title = $movie['title'];
            }elseif(isset($movie['name'])){
                $title = $movie['name'];
            }else{
                $releaseDate = 'Untitled';
            }

            return collect($movie)->merge([
                'release_date'=>$releaseDate,
                'release_year'=>isset($releaseDate)?Carbon::parse($releaseDate)->format('Y'):'Future',
                'title'=>$title,
                'character'=>isset($movie['character'])?$movie['character']:'',
            ]);
        })->sortByDesc('release_date')->dump();
    }

    public function knownForMovies(){
        $castMovies = collect($this->credits)->get('cast');
        return collect($castMovies)->where('media_type', 'movie')->sortByDesc('popularity')->take(5)
        ->map(function($movie){
            return collect($movie)->merge([
                'poster_path'=>$movie['poster_path']
                    ?'https://image.tmdb.org/t/p/w185'.$movie['poster_path']
                    :'https://via.placeholder.com/185x278',
                'title'=> isset($movie['title'])?$movie['title']:'Untitled',
            ]);
        });
    }
}

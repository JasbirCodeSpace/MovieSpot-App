<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Support\Facades\Http;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ViewActorsTest extends TestCase
{
    /** @test */
    public function the_index_page_shows_the_correct_info()
    {
        Http::fake([
            config('services.tmdb.base_url').'/person/popular?page=1' => $this->fakePopularActors(),
        ]);

        $response = $this->get(route('actors.index'));

        $response->assertSuccessful();
        $response->assertSee('Popular Actors');
        $response->assertSee('Will Smith');
        $response->assertSee('Independence Day, Suicide Squad, I am Legend');

        $response->assertSee('Robert Downey Jr.');
        $response->assertSee('The Avengers, Iron Man, Avengers: Infinity War');
    }
     /** @test */
    public function the_index_page_2_shows_the_correct_info()
    {
        Http::fake([
            config('services.tmdb.base_url').'/person/popular?page=2' => $this->fakePopularActorsPage2(),
        ]);

        $response = $this->get('actors/page/2');

        $response->assertSuccessful();
        $response->assertSee('Popular Actors');
        $response->assertSee('Will Smith 2');
        $response->assertSee('Independence Day 2, Suicide Squad 2, I am Legend 2');

        $response->assertSee('Robert Downey Jr. 2');
        $response->assertSee('The Avengers 2, Iron Man 2, Avengers: Infinity War 2');
    }

    private function fakePopularActors()
    {
        return Http::response([
            'results' => [
                [
                    "popularity" => 18.03,
                    "known_for_department" => "Acting",
                    "gender" => 2,
                    "id" => 2888,
                    "profile_path" => "/eze9FO9VuryXLP0aF2cRqPCcibN.jpg",
                    "adult" => false,
                    "known_for" => [
                        [
                            "title" => "Independence Day",
                            "id" => "602",
                            "media_type" => "movie",
                            "poster_path" => "/e1mjopzAS2KNsvpbpahQ1a6SkSn.jpg"
                        ],
                        [
                            "title" => "Suicide Squad",
                            "id" => "297761",
                            "media_type" => "movie",
                            "poster_path" => "/e1mjopzAS2KNsvpbpahQ1a6SkSn.jpg"
                        ],
                        [
                            "title" => "I am Legend",
                            "id" => "6479",
                            "media_type" => "movie",
                            "poster_path" => "/e1mjopzAS2KNsvpbpahQ1a6SkSn.jpg"
                        ],
                    ],
                    "name" => "Will Smith"
                ],
                [
                    "popularity" => 18.491,
                    "known_for_department" => "Acting",
                    "gender" => 2,
                    "id" => 3223,
                    "profile_path" => "/5qHNjhtjMD4YWH3UP0rm4tKwxCL.jpg",
                    "adult" => false,
                    "known_for" => [
                        [
                            "title" => "The Avengers",
                            "id" => "24428",
                            "media_type" => "movie",
                            "poster_path" => "/e1mjopzAS2KNsvpbpahQ1a6SkSn.jpg"
                        ],
                        [
                            "title" => "Iron Man",
                            "id" => "1726",
                            "media_type" => "movie",
                            "poster_path" => "/e1mjopzAS2KNsvpbpahQ1a6SkSn.jpg"
                        ],
                        [
                            "title" => "Avengers: Infinity War",
                            "id" => "299536",
                            "media_type" => "movie",
                            "poster_path" => "/e1mjopzAS2KNsvpbpahQ1a6SkSn.jpg"
                        ],
                    ],
                    "name" => "Robert Downey Jr."
                ],
            ]
        ], 200);
    }
    
    private function fakePopularActorsPage2()
    {
        return Http::response([
            'results' => [
                [
                    "popularity" => 18.03,
                    "known_for_department" => "Acting",
                    "gender" => 2,
                    "id" => 2888,
                    "profile_path" => "/eze9FO9VuryXLP0aF2cRqPCcibN.jpg",
                    "adult" => false,
                    "known_for" => [
                        [
                            "title" => "Independence Day 2",
                            "id" => "602",
                            "media_type" => "movie",
                            "poster_path" => "/e1mjopzAS2KNsvpbpahQ1a6SkSn.jpg"
                        ],
                        [
                            "title" => "Suicide Squad 2",
                            "id" => "297761",
                            "media_type" => "movie",
                            "poster_path" => "/e1mjopzAS2KNsvpbpahQ1a6SkSn.jpg"
                        ],
                        [
                            "title" => "I am Legend 2",
                            "id" => "6479",
                            "media_type" => "movie",
                            "poster_path" => "/e1mjopzAS2KNsvpbpahQ1a6SkSn.jpg"
                        ],
                    ],
                    "name" => "Will Smith 2"
                ],
                [
                    "popularity" => 18.491,
                    "known_for_department" => "Acting",
                    "gender" => 2,
                    "id" => 3223,
                    "profile_path" => "/5qHNjhtjMD4YWH3UP0rm4tKwxCL.jpg",
                    "adult" => false,
                    "known_for" => [
                        [
                            "title" => "The Avengers 2",
                            "id" => "24428",
                            "media_type" => "movie",
                            "poster_path" => "/e1mjopzAS2KNsvpbpahQ1a6SkSn.jpg"
                        ],
                        [
                            "title" => "Iron Man 2",
                            "id" => "1726",
                            "media_type" => "movie",
                            "poster_path" => "/e1mjopzAS2KNsvpbpahQ1a6SkSn.jpg"
                        ],
                        [
                            "title" => "Avengers: Infinity War 2",
                            "id" => "299536",
                            "media_type" => "movie",
                            "poster_path" => "/e1mjopzAS2KNsvpbpahQ1a6SkSn.jpg"
                        ],
                    ],
                    "name" => "Robert Downey Jr. 2"
                ],
            ]
        ], 200);
    }
}

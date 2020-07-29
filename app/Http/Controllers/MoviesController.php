<?php

namespace App\Http\Controllers;

use App\ViewModels\MoviesViewModel;
use App\ViewModels\MovieViewModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MoviesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $popularMovies = Http::withToken(config('services.tmdb.token'))
            ->get(config('services.tmdb.base_url') . "/movie/popular")
            ->json()['results'];


        $nowPlayingMovies = Http::withToken(config('services.tmdb.token'))
            ->get(config('services.tmdb.base_url') . "/movie/now_playing")
            ->json()['results'];

        $popularMovies = array_slice($popularMovies, 0, 10);
        $nowPlayingMovies = array_slice($nowPlayingMovies, 0, 10);

        $genres =
            Http::withToken(config('services.tmdb.token'))
                ->get(config('services.tmdb.base_url') . "/genre/movie/list")
                ->json()['genres'];


        $viewModel = new MoviesViewModel(
            $popularMovies, 
            $nowPlayingMovies, 
            $genres
        );
        // return view('index', compact('popularMovies', 'nowPlayingMovies','genres'));
        return view('index', $viewModel);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $movie = Http::withToken(config('services.tmdb.token'))
            ->get(config('services.tmdb.base_url') . '/movie/' . $id . '?append_to_response=credits,videos,images')
            ->json();

        $viewModel = new MovieViewModel($movie);
        return view('show', $viewModel);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

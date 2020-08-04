<?php

namespace App\Http\Controllers;

use App\ViewModels\TvShowViewModel;
use App\ViewModels\TvViewModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TvController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $popularTv = Http::withToken(config('services.tmdb.token'))
            ->get(config('services.tmdb.base_url') . "/tv/popular")
            ->json()['results'];


        $topRatedTv = Http::withToken(config('services.tmdb.token'))
            ->get(config('services.tmdb.base_url') . "/tv/top_rated")
            ->json()['results'];

        $popularTv = array_slice($popularTv, 0, 20);
        $topRatedTv = array_slice($topRatedTv, 0, 20);

        $genres =
            Http::withToken(config('services.tmdb.token'))
                ->get(config('services.tmdb.base_url') . "/genre/tv/list")
                ->json()['genres'];


        $viewModel = new TvViewModel(
            $popularTv, 
            $topRatedTv, 
            $genres
        );
        return view('tv.index', $viewModel);
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
        $tvShow = Http::withToken(config('services.tmdb.token'))
            ->get(config('services.tmdb.base_url') . '/tv/' . $id . '?append_to_response=credits,videos,images')
            ->json();

        $viewModel = new TvShowViewModel($tvShow);
        return view('tv.show', $viewModel);
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

<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Film;
use App\Models\Genre;
use App\Models\Genre_relation;
use Illuminate\Http\Request;

class DetailGenreRelationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $gl =Genre_relation::with(['film', 'genre'])
        ->get()
        ->groupBy('film.judul');
        
        $genre = Genre::all();
        $film = Film::all();
        // $selectedGenres = $film->genres->pluck('id_genre')->toArray();
        
        return view('admin.detail-genre-relation', compact('film','genre','gl',));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

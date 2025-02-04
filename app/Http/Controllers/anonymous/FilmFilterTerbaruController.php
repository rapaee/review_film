<?php

namespace App\Http\Controllers\anonymous;

use App\Http\Controllers\Controller;
use App\Models\Film;
use App\Models\Genre;
use App\Models\Genre_relation;
use Illuminate\Http\Request;

class FilmFilterTerbaruController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $terbaru = Genre_relation::join('film', 'genre_relations.id_film', '=', 'film.id_film')
        ->orderByDesc('film.tahun_rilis')
        ->select('genre_relations.*') // Memilih semua data dari genre_relations
        ->get();
        $genre = Genre::all();
        return view('anonymous.filter-terbaru',compact('terbaru','genre'));
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

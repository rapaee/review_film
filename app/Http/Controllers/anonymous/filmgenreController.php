<?php

namespace App\Http\Controllers\anonymous;

use App\Http\Controllers\Controller;
use App\Models\Film;
use App\Models\Genre;
use App\Models\Genre_relation;
use Illuminate\Http\Request;

class filmgenreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        // Ambil nama genre berdasarkan ID
        $selectedGenre = Genre::where('id_genre', $id)->value('title');
    
        $genre = Genre_relation::select('genre_relations.id_genre', 'genre.title')
            ->join('genre', 'genre_relations.id_genre', '=', 'genre.id_genre')
            ->groupBy('genre_relations.id_genre', 'genre.title')
            ->get();
    
        // Ambil film tanpa duplikasi, lalu gabungkan genre dalam satu array
        $films = Film::select('film.id_film', 'film.judul', 'film.poster', 'film.tahun_rilis')
            ->join('genre_relations', 'film.id_film', '=', 'genre_relations.id_film')
            ->join('genre', 'genre_relations.id_genre', '=', 'genre.id_genre')
            ->where('genre_relations.id_genre', $id)
            ->groupBy('film.id_film', 'film.judul', 'film.poster', 'film.tahun_rilis')
            ->get()
            ->map(function ($film) {
                $film->genres = Genre_relation::join('genre', 'genre_relations.id_genre', '=', 'genre.id_genre')
                    ->where('genre_relations.id_film', $film->id_film)
                    ->pluck('genre.title')
                    ->toArray();
                return $film;
            });
    
            // $datafilm = Film::orderByDesc('tahun_rilis')->get();
        return view('anonymous.film-genre', compact('genre', 'films', 'selectedGenre'));
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

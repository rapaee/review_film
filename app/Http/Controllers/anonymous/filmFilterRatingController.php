<?php

namespace App\Http\Controllers\anonymous;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Film;
use App\Models\Genre;
use App\Models\Genre_relation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class filmFilterRatingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $comments = Comment::with('film')
            ->select('id_film', DB::raw('MAX(rating) as max_rating')) // Ambil rating tertinggi
            ->groupBy('id_film')
            ->get();

        // Ambil ID film dari hasil query komentar
        $idFilms = $comments->pluck('id_film');
        $genre = Genre_relation::select('genre_relations.id_genre', 'genre.title', 'genre.slug')
            ->join('genre', 'genre_relations.id_genre', '=', 'genre.id_genre')
            ->groupBy('genre_relations.id_genre', 'genre.title', 'genre.slug')
            ->get();
        // Ambil data film berdasarkan ID yang ada di komentar
        $films = Genre_relation::whereIn('id_film', $idFilms)->get();
        $dataFilm = Film::orderByDesc('tahun_rilis')->get();

        return view('anonymous/filter-rating', compact('dataFilm', 'comments', 'films', 'genre'));
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

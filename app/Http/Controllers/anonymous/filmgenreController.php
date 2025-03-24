<?php

namespace App\Http\Controllers\anonymous;

use App\Http\Controllers\Controller;
use App\Models\Film;
use App\Models\Genre;
use App\Models\Genre_relation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class filmgenreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($slug)
    {
        // Ambil nama genre berdasarkan ID
        $selectedGenre = Genre::where('slug', $slug)->value('title');

        $genre = Genre_relation::select('genre_relations.id_genre', 'genre.title', 'genre.slug')
            ->join('genre', 'genre_relations.id_genre', '=', 'genre.id_genre')
            ->groupBy('genre_relations.id_genre', 'genre.title', 'genre.slug')
            ->get();

        $dataFilm = Film::orderByDesc('tahun_rilis')->get();


        $films = Film::select(
            'film.id_film',
            'film.judul',
            'film.poster',
            'film.tahun_rilis',
            'genre.slug as genre_slug',
            DB::raw('COALESCE(AVG(comments.rating), 0) as averageRating')
        )
            ->join('genre_relations', 'film.id_film', '=', 'genre_relations.id_film')
            ->join('genre', 'genre_relations.id_genre', '=', 'genre.id_genre')
            ->leftJoin('comments', function ($join) {
                $join->on('film.id_film', '=', 'comments.id_film')
                    ->join('users', 'comments.id_user', '=', 'users.id')
                    ->where('users.role', 'subcriber'); // Hanya ambil rating dari subscriber
            })
            ->where('genre.slug', $slug)
            ->groupBy('film.id_film', 'film.judul', 'film.poster', 'film.tahun_rilis', 'genre.slug')
            ->get();

        $filmGenres = [];
        foreach ($films as $film) {
            $filmGenres[$film->id_film] = Genre_relation::join('genre', 'genre_relations.id_genre', '=', 'genre.id_genre')
                ->where('genre_relations.id_film', $film->id_film)
                ->pluck('genre.title')
                ->toArray();
        }

        
        $listNavbarUmur = Film::orderBydesc('kategori_umur')->get();

        return view('anonymous.film-genre', compact('listNavbarUmur','filmGenres', 'dataFilm', 'genre', 'films', 'selectedGenre'));
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

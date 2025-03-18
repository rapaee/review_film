<?php

namespace App\Http\Controllers\anonymous;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Comment;
use App\Models\Film;
use App\Models\Genre;
use App\Models\Genre_relation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class homeAnonymous extends Controller
{

    public function index()
    {
        $banner = Banner::all();

        $genre = Genre_relation::select('genre_relations.id_genre', 'genre.title', 'genre.slug')
            ->join('genre', 'genre_relations.id_genre', '=', 'genre.id_genre')
            ->groupBy('genre_relations.id_genre', 'genre.title', 'genre.slug')
            ->get();

        $Film = Film::all();
        $datafilm = Film::with('comments')->orderByDesc('tahun_rilis')->get();

        // Pastikan setiap koleksi film mendapatkan rating
        foreach ($datafilm as $film) {
            $film->averageRating = $this->calculateAverageRating($film->id_film);
        }

        $dataFilm = Film::orderByDesc('tahun_rilis')->get();
        $terbaru = Film::orderByDesc('tahun_rilis')->take(9)->get();

        $comments = Comment::with('film')
            ->select('id_film', DB::raw('MAX(rating) as max_rating'))
            ->groupBy('id_film')
            ->get();

        // Pastikan setiap koleksi film mendapatkan rating
        foreach ($comments as $comment) {
            if ($comment->film) {
                $comment->film->averageRating = $this->hitungrating($comment->film->id_film);
            }
        }

        return view('anonymous/home', compact('Film', 'datafilm', 'dataFilm', 'terbaru', 'comments', 'genre', 'banner'));
    }
    private function hitungrating($id_film)
    {
        return Comment::where('id_film', $id_film)->avg('rating') ?? 0;
    }


    public function search(Request $request)
    {
        $search = request('search');

        $film = Film::with('comments')
            ->where('judul', 'LIKE', "%{$search}%")
            ->orderByDesc('tahun_rilis')
            ->get();

        // Hitung rating untuk setiap film
        foreach ($film as $poster) {
            $poster->averageRating = $poster->comments->avg('rating') ?? 0;
        }


        $filmIds = $film->pluck('id_film');

        $filmGenres = Genre_relation::whereIn('id_film', $filmIds)
            ->with('genre')
            ->get()
            ->groupBy('id_film');


        $genre = Genre_relation::select('genre_relations.id_genre', 'genre.title', 'genre.slug')
            ->join('genre', 'genre_relations.id_genre', '=', 'genre.id_genre')
            ->groupBy('genre_relations.id_genre', 'genre.title', 'genre.slug')
            ->get();

        $dataFilm = Film::orderByDesc('tahun_rilis')->get();
        $datafilm = Film::orderByDesc('tahun_rilis')->get();

        $terbaru = Film::orderByDesc('tahun_rilis')->take(9)->get();

        $comments = Comment::with('film')
            ->select('id_film', DB::raw('MAX(rating) as max_rating'))
            ->groupBy('id_film')
            ->get();

        // Pastikan semua koleksi film mendapatkan rating
        foreach ([$film, $datafilm, $dataFilm, $terbaru] as $films) {
            foreach ($films as $f) {
                $f->averageRating = $this->calculateAverageRating($f->id_film);
            }
        }

        return view('anonymous/search-film', compact(
            'film',
            'datafilm',
            'terbaru',
            'comments',
            'genre',
            'dataFilm',
            'filmGenres'
        ));
    }
    public function filterByYear($tahun)
    {
        $genre = Genre_relation::select('genre_relations.id_genre', 'genre.title', 'genre.slug')
            ->join('genre', 'genre_relations.id_genre', '=', 'genre.id_genre')
            ->groupBy('genre_relations.id_genre', 'genre.title', 'genre.slug')
            ->get();

        $dataFilm = Film::orderByDesc('tahun_rilis')->get();

        $films = Film::where('tahun_rilis', $tahun)
            ->leftJoin('comments', 'film.id_film', '=', 'comments.id_film') // Gabungkan dengan tabel komentar
            ->select(
                'film.id_film',
                'film.judul',
                'film.poster',
                'film.tahun_rilis',
                DB::raw('COALESCE(AVG(comments.rating), 0) as averageRating') // Hitung rata-rata rating
            )
            ->groupBy('film.id_film', 'film.judul', 'film.poster', 'film.tahun_rilis')
            ->get();

        // Buat daftar genre untuk setiap film
        $filmGenres = Genre_relation::whereIn('id_film', $films->pluck('id_film'))
            ->with('genre')
            ->get()
            ->groupBy('id_film')
            ->map(fn($genres) => $genres->unique('id_genre'));


        return view('anonymous/tahun-rilis', compact('filmGenres', 'films', 'tahun', 'dataFilm', 'genre'));
    }

    private function calculateAverageRating($filmId)
    {
        $ratings = Comment::where('id_film', $filmId)
            ->pluck('rating');

        if ($ratings->isNotEmpty()) {
            return round($ratings->sum() / $ratings->count(), 1);
        }

        return 0;
    }

    public function store(Request $request)
    {
        //
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}

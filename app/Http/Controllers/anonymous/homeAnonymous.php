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

        $Film = Film::withCount('comments')->orderByDesc('comments_count')->get();

        $terbaruInput = Film::with('comments')->orderByDesc('created_at')->orderByDesc('tahun_rilis')->get();
        // Pastikan setiap koleksi film mendapatkan rating
        foreach ($terbaruInput as $film) {
            $film->averageRating = $this->calculateAverageRating($film->id_film);
        }

        $datafilm = Film::withCount('comments')
        ->orderByDesc('comments_count')
        ->limit(4)
        ->get();

        // Pastikan setiap koleksi film mendapatkan rating
        foreach ($datafilm as $film) {
            $film->averageRating = $this->calculateAverageRating($film->id_film);
        }

        $dataFilm = Film::orderByDesc('tahun_rilis')->get();

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
        $listNavbarUmur = Film::orderBydesc('kategori_umur')->get();

        return view('anonymous/home', compact('listNavbarUmur', 'Film', 'datafilm', 'terbaruInput', 'dataFilm', 'comments', 'genre', 'banner'));
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


        $listNavbarUmur = Film::orderBydesc('kategori_umur')->get();

        return view('anonymous/search-film', compact(
            'listNavbarUmur',
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
            ->leftJoin('comments', function ($join) {
                $join->on('film.id_film', '=', 'comments.id_film')
                    ->join('users', 'comments.id_user', '=', 'users.id')
                    ->where('users.role', 'subcriber'); // Hanya ambil rating dari subscriber
            })
            ->select(
                'film.id_film',
                'film.judul',
                'film.poster',
                'film.tahun_rilis',
                DB::raw('COALESCE(AVG(comments.rating), 0) as averageRating') // Hitung rata-rata rating dari subscriber
            )
            ->groupBy('film.id_film', 'film.judul', 'film.poster', 'film.tahun_rilis')
            ->get();

        // Buat daftar genre untuk setiap film
        $filmGenres = Genre_relation::whereIn('id_film', $films->pluck('id_film'))
            ->with('genre')
            ->get()
            ->groupBy('id_film')
            ->map(fn($genres) => $genres->unique('id_genre'));


        $listNavbarUmur = Film::orderBydesc('kategori_umur')->get();

        return view('anonymous/tahun-rilis', compact('listNavbarUmur', 'filmGenres', 'films', 'tahun', 'dataFilm', 'genre'));
    }

    public function filterUmur($kategori_umur)
    {
        $selectedUmur = Film::where('kategori_umur', $kategori_umur)->value('kategori_umur');

        $dataFilm = Film::orderByDesc('tahun_rilis')->get();

        // Ambil hanya film berdasarkan kategori umur yang dipilih
        $filterUmur = Film::where('kategori_umur', $kategori_umur)
            ->orderByDesc('tahun_rilis')
            ->get();
        // Ambil daftar genre
        $genre = Genre_relation::select('genre_relations.id_genre', 'genre.title', 'genre.slug')
            ->join('genre', 'genre_relations.id_genre', '=', 'genre.id_genre')
            ->groupBy('genre_relations.id_genre', 'genre.title', 'genre.slug')
            ->get();

        // Ambil daftar kategori umur unik untuk navbar
        $listNavbarUmur = Film::select('kategori_umur')->distinct()->orderByDesc('kategori_umur')->get();

        return view('anonymous/kategori_umur', compact('listNavbarUmur', 'genre', 'dataFilm', 'filterUmur', 'selectedUmur'));
    }


    private function calculateAverageRating($filmId)
    {
        $ratings = Comment::where('id_film', $filmId)
            ->whereHas('user', function ($query) {
                $query->where('role', 'subcriber');
            })
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

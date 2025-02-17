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
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // // Ambil data Genre_relation berdasarkan genre tertentu
        // $gl = Genre_relation::whereHas('genre', function ($query) {
        //     $query->whereIn('title', ['Action', 'Romance', 'Fantasi']);
        // })->get();

        $banner = Banner::all();

        $genre = Genre_relation::select('genre_relations.id_genre', 'genre.title')
        ->join('genre', 'genre_relations.id_genre', '=', 'genre.id_genre')
        ->groupBy('genre_relations.id_genre', 'genre.title')
        ->get();
        

        
        $datafilm = Film::orderByDesc('tahun_rilis')->get();
        $terbaru = Film::orderByDesc('tahun_rilis')->take(9)->get();

        $comments = Comment::with('film')
        ->select('id_film', DB::raw('MAX(rating) as max_rating')) // Ambil rating tertinggi
        ->groupBy('id_film')
        ->get();
        
        
    
        return view('anonymous/home', compact('datafilm','terbaru','comments', 'genre','banner'));
    }
    
    public function search(Request $request)
    {
        // Ambil kata kunci pencarian dari request
        $search = request('search'); 
    
        // Ambil film berdasarkan pencarian judul
        $film = Film::where('judul', 'LIKE', "%{$search}%")->get();
    
        // Ambil ID film yang ditemukan
        $filmIds = $film->pluck('id_film');
    
        // Ambil genre berdasarkan ID film yang ditemukan
        $filmGenres = Genre_relation::whereIn('id_film', $filmIds)
            ->with('genre') // Pastikan relasi ke tabel genre sudah ada
            ->get()
            ->groupBy('id_film');
    
        // Ambil semua data banner
        $banner = Banner::all();
    
        // Ambil daftar genre unik yang tersedia
        $genre = Genre_relation::select('genre_relations.id_genre', 'genre.title') // Pastikan field benar
            ->join('genre', 'genre_relations.id_genre', '=', 'genre.id_genre')
            ->groupBy('genre_relations.id_genre', 'genre.title')
            ->get();
    
        // Ambil semua film berdasarkan tahun rilis
        $datafilm = Film::orderByDesc('tahun_rilis')->get();
    
        // Ambil 9 film terbaru berdasarkan tahun rilis
        $terbaru = Film::orderByDesc('tahun_rilis')->take(9)->get();
    
        // Ambil komentar dengan rating tertinggi untuk setiap film
        $comments = Comment::with('film')
            ->select('id_film', DB::raw('MAX(rating) as max_rating')) // Ambil rating tertinggi
            ->groupBy('id_film')
            ->get();
    
        return view('anonymous/search-film', compact(
            'film', 'datafilm', 'terbaru', 'comments', 'genre', 'banner', 'filmGenres'
        ));
    }
    
    
    

    /**
     * Show the form for creating a new resource.
     */
  

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

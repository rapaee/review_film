<?php

namespace App\Http\Controllers\author;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Comment;
use App\Models\Film;
use App\Models\Genre_relation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class homeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $banner = Banner::all();

        $genre = Genre_relation::select('genre_relations.id_genre', 'genre.title')
        ->join('genre', 'genre_relations.id_genre', '=', 'genre.id_genre')
        ->groupBy('genre_relations.id_genre', 'genre.title')
        ->get();
        $Film = Film::all();
        $datafilm = Film::orderByDesc('tahun_rilis')->get();
        $terbaru = Film::orderByDesc('tahun_rilis')->take(9)->get();

        $comments = Comment::with('film')
        ->select('id_film', DB::raw('MAX(rating) as max_rating')) // Ambil rating tertinggi
        ->groupBy('id_film')
        ->get();
        
        return view('author.home',compact('Film','datafilm','terbaru','comments', 'genre','banner'));
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

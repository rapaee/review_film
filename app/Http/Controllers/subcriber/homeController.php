<?php

namespace App\Http\Controllers\subcriber;

use App\Http\Controllers\Controller;
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

        $genre = Genre_relation::select('genre_relations.id_genre', 'genre.title')
        ->join('genre', 'genre_relations.id_genre', '=', 'genre.id_genre')
        ->groupBy('genre_relations.id_genre', 'genre.title')
        ->get();
        
        // Ambil data Genre_relation berdasarkan genre tertentu
        $gl = Genre_relation::whereHas('genre', function ($query) {
            $query->whereIn('title', ['Action', 'Romance', 'Fantasi']);
        })->get();
        
        $datafilm = Film::all();
        $terbaru = Film::orderByDesc('tahun_rilis')->take(9)->get();
        $comments = Comment::with('film')
        ->select('id_film', DB::raw('MAX(rating) as max_rating')) // Ambil rating tertinggi
        ->groupBy('id_film')
        ->get();
    

    
        return view('subcriber/home', compact('datafilm', 'gl','terbaru','comments','genre'));
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

<?php

namespace App\Http\Controllers\subcriber;

use App\Http\Controllers\Controller;
use App\Models\Comment;
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
        
        // Ambil data film berdasarkan ID yang ada di komentar
        $films = Genre_relation::whereIn('id_film', $idFilms)->get();

        
        return view('subcriber/filter-rating', compact('comments','films'));
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

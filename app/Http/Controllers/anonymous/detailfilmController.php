<?php

namespace App\Http\Controllers\anonymous;

use App\Http\Controllers\Controller;
use App\Models\Casting;
use App\Models\Comment;
use App\Models\Film;
use App\Models\Genre;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class detailfilmController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
{
    $user = User::all();
    $comment = Comment::where('id_film', $id)
        ->orderByDesc('created_at')
        ->get();
    $dataFilm = Film::orderByDesc('tahun_rilis')->get();
    $datafilm = Film::findOrFail($id);
    $listgenre = Genre::all();
    $genre = Genre::all();
    $casting = Casting::where('id_film', $id)->get(); // Filter casting berdasarkan id_film
     // Ambil semua data komentar dan rating
     $comments = Comment::all();
     $hasCommented = Auth::check() ? Comment::where('id_user', Auth::user()->id )->where('id_film', $id)->exists() : false;

     // Hitung rata-rata rating
     $averageRating = $comments->avg('rating'); // rating adalah nama kolom rating di tabel comments
    return view('anonymous/detail-film', compact('hasCommented','averageRating','dataFilm','datafilm', 'comment', 'user', 'genre', 'casting','listgenre'));
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

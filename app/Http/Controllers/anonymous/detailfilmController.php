<?php

namespace App\Http\Controllers\anonymous;

use App\Http\Controllers\Controller;
use App\Models\Casting;
use App\Models\Comment;
use App\Models\Film;
use App\Models\Genre;
use App\Models\User;
use Illuminate\Http\Request;

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
    $datafilm = Film::findOrFail($id);
    $listgenre = Genre::all();
    $genre = Genre::all();
    $casting = Casting::where('id_film', $id)->get(); // Filter casting berdasarkan id_film

    return view('anonymous/detail-film', compact('datafilm', 'comment', 'user', 'genre', 'casting','listgenre'));
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

<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Casting;
use App\Models\Comment;
use App\Models\Film;
use App\Models\Genre_relation;
use App\Models\User;
use Illuminate\Http\Request;

class FilmDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $genre = Genre_relation::select('genre_relations.id_genre', 'genre.title')
            ->join('genre', 'genre_relations.id_genre', '=', 'genre.id_genre')
            ->groupBy('genre_relations.id_genre', 'genre.title')
            ->get();
        
        $user = User::all();
        $comment = Comment::where('id_film', $id)
            ->orderByDesc('created_at')
            ->get();
    
       $datafilm = Film::with('castings')->find($id);
    
        // Kirim $id ke view
        return view('admin.film-detail', compact('datafilm', 'comment', 'user', 'genre', 'id'));
    }
    

    /**
     * Show the form for creating a new resource.
     */
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi data
        $request->validate([
            'id_film' => 'required',
            'nama_panggung' => 'required|string|max:255',
            'nama_asli' => 'required|string|max:255',
        ]);
    
        // Menyimpan data ke database
        Casting::create([
            'id_film' => $request->id_film,
            'nama_panggung' => $request->nama_panggung,
            'nama_asli' => $request->nama_asli,
        ]);
    
        // Redirect ke halaman film-detail dengan menambahkan parameter id_film
        return redirect()->route('admin.film-detail', ['id' => $request->id_film])->with('success', 'Casting berhasil ditambahkan!');
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

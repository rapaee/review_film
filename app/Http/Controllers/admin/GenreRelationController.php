<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Film;
use App\Models\Genre;
use App\Models\Genre_relation;
use Illuminate\Http\Request;

class GenreRelationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $gl = \App\Models\Genre_relation::with(['film', 'genre'])
        ->get()
        ->groupBy('film.judul');
        $genre = Genre::all();
        $film = Film::all();
        return view('admin.genre-relasi', compact('film','genre','gl'));
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
        // Validasi input
        $request->validate([
            'id_film' => 'required|integer|exists:film,id_film', // Mengacu pada primary key di tabel film
            'id_genre' => 'required|integer|exists:genre,id_genre', // Mengacu pada primary key di tabel genre
        ]);
    
        // Simpan data ke tabel
        $filmGenre = new Genre_relation();
        $filmGenre->id_film = $request->id_film;
        $filmGenre->id_genre = $request->id_genre;
        $filmGenre->save();
    
        // Redirect dengan pesan sukses
        return redirect()->route('admin.genre-relasi')->with('success', 'Genre berhasil ditambahkan!');
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
    public function update(Request $request, $id)
    {
          // Validasi data yang masuk
          $validated = $request->validate([
            'id_film' => 'required|integer|exists:film,id_film', // Mengacu pada primary key di tabel film
            'id_genre' => 'required|integer|exists:genre,id_genre', // Mengacu pada primary key di tabel genre
        ]);

        // Cari genre berdasarkan ID
        $genre = Genre_relation::findOrFail($id);

        // Update data genre
        $genre->id_film = $validated['id_film'];
        $genre->id_genre = $validated['id_genre'];
        $genre->save(); // Simpan perubahan

        // Redirect ke halaman yang sesuai setelah update berhasil
        return redirect()->route('admin.genre-relasi')->with('success', 'Genre updated successfully!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $genre = Genre_relation::findOrFail($id); // Menangkap exception jika data tidak ditemukan
            $genre->delete();
            return redirect()->route('admin.genre-relasi')->with('success', 'Data buku berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('admin.genre-relasi')->with('error', 'Data buku tidak ditemukan atau terjadi kesalahan.');
        }
    }
}

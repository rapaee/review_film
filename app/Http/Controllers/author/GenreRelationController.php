<?php

namespace App\Http\Controllers\author;

use App\Http\Controllers\Controller;
use App\Models\Film;
use App\Models\Genre;
use App\Models\Genre_relation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GenreRelationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil ID user yang sedang login

        $userId = Auth::id();

        // Ambil film yang hanya dimiliki oleh user yang login
        $film = Film::where('id_users', $userId)->get();

        // Ambil genre berdasarkan film yang dimiliki oleh user
        $gl = Genre_relation::whereHas('film', function ($query) use ($userId) {
            $query->where('id_users', $userId);
        })
            ->with(['film', 'genre'])
            ->get()
            ->groupBy('genre.judul'); // Kelompokkan berdasarkan nama genre
        // Ambil semua genre
        $genre = Genre::all();




        return view('author.genre-relasi', compact('film', 'genre', 'gl'));
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
            'id_genre' => 'required|array', // Harus berupa array
            'id_genre.*' => 'integer|exists:genre,id_genre', // Setiap elemen dalam array harus valid
        ]);

        // Loop untuk menyimpan setiap genre yang dipilih
        foreach ($request->id_genre as $genre_id) {
            $filmGenre = new Genre_relation();
            $filmGenre->id_film = $request->id_film;
            $filmGenre->id_genre = $genre_id;
            $filmGenre->save();
        }

        // Redirect dengan pesan sukses
        return redirect()->route('author.genre-relasi')->with('success', 'Genre berhasil ditambahkan!');
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
    public function edit($id)
    {
        $film = Film::findOrFail($id); // Ambil data film berdasarkan ID
        $filmList = Film::all(); // Ambil semua film untuk dropdown
        $genre = Genre::all(); // Ambil semua genre
        $selectedGenres = $film->genres->pluck('id_genre')->toArray(); // Ambil genre yang sudah dipilih

        return view('author.edit-genre-relasi', compact('film', 'filmList', 'genre', 'selectedGenres'));
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validasi data
        $request->validate([
            'film' => 'required|exists:film,id_film',
            'id_genre' => 'array',
            'id_genre.*' => 'exists:genre,id_genre'
        ]);

        // Cari film berdasarkan ID
        $film = Film::findOrFail($id);

        // Update genre-film di pivot table
        $film->genres()->sync($request->id_genre ?? []);

        return redirect()->route('author.genre-relasi')->with('success', 'Data genre berhasil diperbarui!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            // Cari data berdasarkan ID
            $genreRelation = Genre_relation::findOrFail($id);

            // Hapus semua genre yang terkait dengan film yang sama
            Genre_relation::where('id_film', $genreRelation->id_film)->delete();

            return redirect()->route('author.genre-relasi')->with('success', 'Semua genre terkait berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('author.genre-relasi')->with('error', 'Data tidak ditemukan atau terjadi kesalahan.');
        }
    }
}

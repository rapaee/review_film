<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Film;
use Illuminate\Http\Request;

class filmController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         // Ambil semua data film dari database
    $films = Film::all();

    // Kirim data film ke view
    return view('admin.film', compact('films')); 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.input-film');
    }

    /**
     * Store a newly created resource in storage.
     */
        public function store(Request $request)
        {
            // Validasi data input
            $request->validate([
                'judul' => 'required|string|max:255',
                'pencipta' => 'required|string|max:255',
                'deskripsi' => 'required|string',
                'tahun_rilis' => 'required|integer|min:1900|max:' . date('Y'),
                'durasi' => 'required|string|max:50',
                'rating' => 'required|numeric|min:0|max:10',
                'poster' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                'trailer' => 'required|mimes:mp4,mov,avi,wmv',
            ]);
    
            // Simpan file poster
            $posterPath = $request->file('poster')->store('posters', 'public');
    
            // Simpan file trailer
            $trailerPath = $request->file('trailer')->store('trailers', 'public');
    
            // Simpan data film ke database
            $film = new Film();
            $film->judul = $request->judul;
            $film->pencipta = $request->pencipta;
            $film->deskripsi = $request->deskripsi;
            $film->tahun_rilis = $request->tahun_rilis;
            $film->durasi = $request->durasi;
            $film->rating = $request->rating;
            $film->poster = $posterPath;
            $film->trailer = $trailerPath;
            $film->save();
    
            return redirect()->route('admin.film')->with('success', 'Film berhasil ditambahkan!');
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

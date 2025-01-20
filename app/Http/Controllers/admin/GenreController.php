<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $genre = Genre::all();
        return view('admin.genre', compact('genre'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.input-genre');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:genre,slug',
        ]);

        // Membuat genre baru
        $genre = new Genre();
        $genre->title = $request->input('title');
        $genre->slug = $request->input('slug');
        $genre->save();

        // Redirect dengan pesan sukses
        return redirect()->route('admin.genre')->with('success', 'Genre berhasil ditambahkan!');
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
    public function edit($id_genre)
    {
        $genre = Genre::where('id_genre', $id_genre)->firstOrFail();
        return view('admin.edit-genre', compact('genre')); // Mengirim data barang dan kategori ke view
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id_genre)
    {
        // Validasi data yang masuk
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
        ]);

        // Cari genre berdasarkan ID
        $genre = Genre::findOrFail($id_genre);

        // Update data genre
        $genre->title = $validated['title'];
        $genre->slug = $validated['slug'];
        $genre->save(); // Simpan perubahan

        // Redirect ke halaman yang sesuai setelah update berhasil
        return redirect()->route('admin.genre')->with('success', 'Genre updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_genre)
    {
        try {
            $genre = Genre::findOrFail($id_genre); // Menangkap exception jika data tidak ditemukan
            $genre->delete();
            return redirect()->route('admin.genre')->with('success', 'Data buku berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('admin.genre')->with('error', 'Data buku tidak ditemukan atau terjadi kesalahan.');
        }
    }
}

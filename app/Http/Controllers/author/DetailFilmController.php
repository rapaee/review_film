<?php

namespace App\Http\Controllers\author;

use App\Http\Controllers\Controller;
use App\Models\Casting;
use App\Models\casting_relation;
use App\Models\Comment;
use App\Models\Film;
use App\Models\Genre_relation;
use App\Models\User;
use Illuminate\Http\Request;

class DetailFilmController extends Controller
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
        // $casting = Casting::where('id_castings', $id)->get();
        $listcasting=Casting::all();
        $castingrelation = casting_relation::where('id_film', $id)->get();
        $datafilm = Film::with('castings')->find($id);

        // Kirim $id ke view
        return view('author.detail-film', compact('listcasting','castingrelation', 'datafilm', 'comment', 'user', 'genre', 'id'));
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
        // dd($request->all());
        // Validasi input
        $request->validate([
            'id_film' => 'required|exists:film,id_film',
            'id_casting' => 'required|exists:castings,id_castings',
        ]);

        // Simpan data ke database
        casting_relation::create([
            'id_film' => $request->id_film,
            'id_casting' => $request->id_casting,
        ]);

        return redirect()->route('author.detail-film', ['id' => $request->id_film])
            ->with('success', 'Casting berhasil ditambahkan!');
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
    public function edit(string $id_castings)
    {
        $casting = Casting::findOrFail($id_castings);
        $film = Film::all();
        $castings = Casting::all();
        return view('author.edit-castings-detail-film', compact('film', 'castings', 'casting'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id_castings)
    {
        // Validasi data
        $request->validate([
            'id_film' => 'required',
            'nama_panggung' => 'required|string|max:255',
            'nama_asli' => 'required|string|max:255',
        ], [
            'id_film.required' => 'ID Film harus diisi.',
            'nama_panggung.required' => 'Nama panggung harus diisi.',
            'nama_panggung.string' => 'Nama panggung harus berupa teks.',
            'nama_panggung.max' => 'Nama panggung tidak boleh lebih dari 255 karakter.',
            'nama_asli.required' => 'Nama asli harus diisi.',
            'nama_asli.string' => 'Nama asli harus berupa teks.',
            'nama_asli.max' => 'Nama asli tidak boleh lebih dari 255 karakter.',
        ]);

        // Cari data casting berdasarkan ID
        $casting = Casting::findOrFail($id_castings);

        // Update data
        $casting->update([
            'id_film' => $request->id_film,
            'nama_panggung' => $request->nama_panggung,
            'nama_asli' => $request->nama_asli,
        ]);

        // Redirect ke halaman film-detail dengan menambahkan parameter id_film
        return redirect()->route('author.detail-film', ['id' => $request->id_film])->with('success', 'Casting berhasil diperbarui!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $castingrelation = casting_relation::findOrFail($id); // Menangkap exception jika data tidak ditemukan
            $id_film = $castingrelation->id_film; // Ambil ID film sebelum menghapus
            $castingrelation->delete();
    
            return redirect()->route('author.detail-film', ['id' => $id_film])
                             ->with('success', 'Data berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('author.detail-film', ['id' => $id_film ?? 1]) // Pastikan id_film ada
                             ->with('error', 'Data tidak ditemukan atau terjadi kesalahan.');
        }
    }
}

<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Casting;
use App\Models\Film;
use Illuminate\Http\Request;

class CastingsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $casting = Casting::all();
        $film = Film::all();
        return view('admin.castings',compact('casting','film'));
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
        // Validasi data
        $request->validate([
            'nama_panggung' => 'required|string|max:255',
            'nama_asli' => 'required|string|max:255',
        ]);
    
        // Menyimpan data ke database
        Casting::create([
            'nama_panggung' => $request->nama_panggung,
            'nama_asli' => $request->nama_asli,
        ]);
    
        // Redirect ke halaman film-detail dengan menambahkan parameter id_film
        return redirect()->route('admin.castings')->with('success', 'Casting berhasil ditambahkan!');
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
        return view('admin.edit-castings-film-detail',compact('film','castings','casting'));
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
        return redirect()->route('admin.film-detail', ['id' => $request->id_film])->with('success', 'Casting berhasil diperbarui!');
    }
    

    public function editdetaildashboard(string $id_castings)
    {
        $casting = Casting::findOrFail($id_castings);
        $film = Film::all();
        $castings = Casting::all();
        return view('admin.detail-dashboard.castings',compact('film','castings','casting'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function updatedetaildashboard(Request $request, $id_castings)
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
        return redirect()->route('admin.castings')->with('success', 'Casting berhasil diperbarui!');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_castings)
    {
        $casting = Casting::find($id_castings);

        if (!$casting) {
            return redirect()->back()->with('error', 'Castings tidak ditemukan.');
        }

        $casting->delete();

        return redirect()->back()->with('success', 'Castings berhasil dihapus.');
    }
}

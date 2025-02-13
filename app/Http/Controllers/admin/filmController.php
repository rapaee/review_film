<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Film;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            // Validasi data input
            $request->validate([
                'judul' => 'required|string|max:255',
                'pencipta' => 'required|string|max:255',
                'deskripsi' => 'required|string',
                'tahun_rilis' => 'required|integer|min:1900|max:' . date('Y'),
                'durasi' => 'required|integer|min:1', // Validasi sebagai integer dengan minimal 1 menit
                'kategori_umur' => 'required|string|in:SU,13+,17+,21+',
                'poster' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                'trailer' => 'required|mimes:mp4,mov,avi,wmv',
            ]);
    
            // Konversi durasi dari menit ke format jam:menit
            $durasiMenit = (int)$request->durasi;
            $hours = floor($durasiMenit / 60);
            $minutes = $durasiMenit % 60;
            $durasiFormatted = sprintf('%02d:%02d', $hours, $minutes); // Format sebagai "hh:mm"
    
            // Simpan file poster
            $posterPath = $request->file('poster')->store('posters','public');
    
            // Simpan file trailer
            $trailerPath = $request->file('trailer')->store('trailers','public');
    
            // Simpan data film ke database
            $film = new Film();
            $film->judul = $request->judul;
            $film->pencipta = $request->pencipta;
            $film->deskripsi = $request->deskripsi;
            $film->kategori_umur = $request->kategori_umur;
            $film->tahun_rilis = $request->tahun_rilis;
            $film->durasi = $durasiMenit; // Simpan durasi dalam menit sebagai integer
            $film->poster = $posterPath;
            $film->trailer = $trailerPath;
            $film->id_users = Auth::id(); // Menyimpan ID user saat ini
            $film->save();
    
            return redirect()->route('admin.film')->with('success', 'Film berhasil ditambahkan!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menambahkan film: ' . $e->getMessage());
        }
    }
    
    
    
    

    /**
     * Display the specified resource.
     */
    public function edit($id_film)
    {
        $film = Film::where('id_film', $id_film)->firstOrFail();
        return view('admin.edit-film', compact('film')); // Mengirim data barang dan kategori ke view
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id_film)
{
    // Validasi data yang masuk
    $validated = $request->validate([
        'judul' => 'required|string|max:255',
        'pencipta' => 'required|string|max:255',
        'deskripsi' => 'required|string',
        'tahun_rilis' => 'required|integer|min:1900|max:' . date('Y'),
        'kategori_umur' => 'required|string|in:SU,13+,17+,21+',
        'durasi' => 'required|string|max:50',
        'poster' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        'trailer' => 'nullable|mimes:mp4,mov,avi,wmv',
    ]);

    // Cari film berdasarkan ID
    $film = Film::findOrFail($id_film);

    // Update data film
    $film->judul = $validated['judul'];
    $film->pencipta = $validated['pencipta'];
    $film->deskripsi = $validated['deskripsi'];
    $film->tahun_rilis = $validated['tahun_rilis'];
    $film->durasi = $validated['durasi'];
    $film->kategori_umur = $validated['kategori_umur'];

    // Periksa jika file poster diunggah
    if ($request->hasFile('poster')) {
        $path = $request->file('poster')->store('posters', 'public');
        $film->poster = $path;
    }

    // Periksa jika file trailer diunggah
    if ($request->hasFile('trailer')) {
        $path = $request->file('trailer')->store('trailers', 'public');
        $film->trailer = $path;
    }

    $film->save(); // Simpan perubahan

    // Redirect ke halaman yang sesuai setelah update berhasil
    return redirect()->route('admin.film')->with('success', 'Film updated successfully!');
}


    /**
     * Remove the specified resource from storage.
     */

     public function destroy($id_film)
{
    try {
        $film = Film::findOrFail($id_film);

        // Hapus file trailer dan gambar jika ada di storage/app/public/posters
        if ($film->trailer && Storage::disk('public')->exists($film->trailer)) {
            Storage::disk('public')->delete($film->trailer);
        }
        if ($film->poster && Storage::disk('public')->exists($film->poster)) {
            Storage::disk('public')->delete($film->poster);
        }
        

        // Hapus semua genre yang berelasi dengan film ini
        $film->genres()->delete();

        // Hapus film setelah genre dan file terkait terhapus
        $film->delete();

        return redirect()->route('admin.film')->with('success', 'Data film berhasil dihapus.');
    } catch (\Exception $e) {
        return redirect()->route('admin.film')->with('error', 'Data film tidak ditemukan atau terjadi kesalahan.');
    }
}

    
}

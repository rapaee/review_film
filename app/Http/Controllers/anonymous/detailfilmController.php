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
        $jumlahPengguna = Comment::where('id_film', $id)->distinct('id_user')->count('id_user');

        $dataFilm = Film::orderByDesc('tahun_rilis')->get();
        $datafilm = Film::findOrFail($id);
        $listgenre = Genre::all();
        //untuk navbar filter genre anonymous
        $genre = Genre::all();
        $casting = Casting::where('id_film', $id)->get(); // Filter casting berdasarkan id_film
        $hasCommented = Auth::check() ? Comment::where('id_user', Auth::user()->id)->where('id_film', $id)->exists() : false;

        $films = Film::with(['comments' => function ($query) use ($id) {
            $query->whereHas('user', function ($userQuery) {
                $userQuery->where('role', 'subcriber');
            })->where('id_film', $id);
        }])->where('id_film', $id)->get();


        return view('anonymous/detail-film', compact('jumlahPengguna','films', 'hasCommented', 'dataFilm', 'datafilm', 'comment', 'user', 'genre', 'casting', 'listgenre'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        // Validasi input
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string',
            'id_film' => 'required|exists:film,id_film',
        ]);

        // Cari komentar berdasarkan ID
        $comment = Comment::findOrFail($id);

        // Pastikan hanya pemilik komentar yang bisa mengedit
        if (Auth::id() !== $comment->id_user) {
            return redirect()->back()->with('error', 'Anda tidak memiliki izin untuk mengedit komentar ini.');
        }

        // Update komentar
        $comment->update([
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return redirect()->back()->with('success', 'Komentar berhasil diperbarui.');
    }


    public function destroy(string $id)
    {
        //
    }
}

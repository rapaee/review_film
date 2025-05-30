<?php

namespace App\Http\Controllers\subcriber;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Film;
use App\Models\Genre_relation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class detailFilmController extends Controller
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
    
        $datafilm = Film::findOrFail($id);
    
        // Ensure $comment is an array or collection
        return view('subcriber/detail-film', compact('datafilm', 'comment', 'user','genre'));
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
        $allowedRoles = ['admin', 'author', 'subcriber'];
    
        if (!in_array(Auth::user()->role, $allowedRoles)) {
            return redirect()->back()->with('error', 'Anda tidak memiliki izin untuk berkomentar.');
        }
    
        $request->validate([
            'comment' => 'required|string',
            'rating' => 'integer|min:1|max:5',
            'id_film' => 'required|exists:film,id_film',
        ]);
    
        Comment::create([
            'comment' => $request->comment,
            'rating' => $request->rating,
            'id_user' => Auth::id(),
            'id_film' => $request->id_film,
        ]);
    
        return redirect()->route('anonymous.detail-film', $request->id_film)->with('success', 'Komentar berhasil ditambahkan!');
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
    public function destroy($id_comments)
    {
        $comment = Comment::findOrFail($id_comments);

        // Pastikan hanya pemilik komentar yang bisa menghapus
        if ($comment->id_user !== Auth::id()) {
            return redirect()->back()->with('error', 'Anda tidak memiliki izin untuk menghapus komentar ini.');
        }

        $comment->delete();

        return redirect()->back()->with('success', 'Komentar berhasil dihapus.');
    }
    public function hapuskomenadmin($id_comments)
    {
        try {
            $genre = Comment::findOrFail($id_comments); // Menangkap exception jika data tidak ditemukan
            $genre->delete();
            return redirect()->back()->with('success', 'Komentar berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Komentar tidak ditemukan atau terjadi kesalahan.');
        }
    }
}

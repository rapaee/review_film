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
        $dataFilm = Film::orderByDesc('tahun_rilis')->get();
        $datafilm = Film::findOrFail($id);
        $listgenre = Genre::all();
        $genre = Genre::all();
        $casting = Casting::where('id_film', $id)->get(); // Filter casting berdasarkan id_film
        $hasCommented = Auth::check() ? Comment::where('id_user', Auth::user()->id)->where('id_film', $id)->exists() : false;
    
        $films = Film::with(['comments' => function ($query) use ($id) {
            $query->whereHas('user', function ($userQuery) {
                $userQuery->where('role', 'subcriber');
            })->where('id_film', $id);
        }])->where('id_film', $id)->get();
        
    
        return view('anonymous/detail-film', compact('films', 'hasCommented', 'dataFilm', 'datafilm', 'comment', 'user', 'genre', 'casting', 'listgenre'));
    }
    

    // private function calculateAverageRating($filmId)
    // {
    //     $ratings = Comment::where('id_film', $filmId)
    //         ->pluck('rating');
    
    //     if ($ratings->isNotEmpty()) {
    //         return round($ratings->sum() / $ratings->count(), 1);
    //     }
    
    //     return 0;
    // }

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
        //
    }

    public function destroy(string $id)
    {
        //
    }
}

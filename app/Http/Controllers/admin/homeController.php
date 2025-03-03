<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Casting;
use App\Models\Comment;
use App\Models\Film;
use App\Models\User;
use Illuminate\Http\Request;

class homeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userCount = User::all()->count();
        $ratings = Comment::select('rating')->get();
        $komen = Comment::all();
        $listkomen = Comment::all()->count();
        $castingsCount = Casting::all()->count();
        $listfilm = Film::all()->count();


        return view('admin.home', compact('userCount','castingsCount','ratings','komen','listfilm','listkomen'));
        
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
        //
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
        $comment = Comment::find($id_comments);
        
        if (!$comment) {
            return redirect()->back()->with('error', 'Komentar tidak ditemukan.');
        }
        
        $comment->delete();
        
        return redirect()->back()->with('success', 'Komentar berhasil dihapus.');
    }
}

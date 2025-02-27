<?php

namespace App\Http\Controllers\author;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Comment;
use App\Models\Film;
use App\Models\Genre_relation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class homeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil id_users yang sedang login
        $userId = Auth::id(); 
    
        // Ambil id_film yang dimiliki oleh user
        $films = Film::where('id_users', $userId)->pluck('id_film');
    
        // Ambil komentar berdasarkan id_film
        $komen = Comment::whereIn('id_film', $films)->get();
    
        // Ambil rating dalam bentuk objek collection
        $ratings = Comment::whereIn('id_film', $films)->get(['rating']);
    
        return view('author.home', compact('komen', 'ratings'));
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
    public function destroy(string $id)
    {
        //
    }
}

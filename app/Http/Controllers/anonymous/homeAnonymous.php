<?php

namespace App\Http\Controllers\anonymous;

use App\Http\Controllers\Controller;
use App\Models\Film;
use App\Models\Genre_relation;
use Illuminate\Http\Request;

class homeAnonymous extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil data Genre_relation berdasarkan genre tertentu
        $gl = Genre_relation::whereHas('genre', function ($query) {
            $query->whereIn('title', ['Action', 'Romance', 'Fantasi']);
        })->get();
        
        $datafilm = Film::all();
        $terbaru = Film::orderByDesc('tahun_rilis')->take(9)->get();
    
        return view('anonymous/home', compact('datafilm', 'gl','terbaru'));
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

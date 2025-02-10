<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Casting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $banner = Banner::all();
        return view('admin.banner',compact('banner'));
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
        $request->validate([
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        // Simpan gambar ke storage
        if ($request->hasFile('gambar')) {
            try {
                $path = $request->file('gambar')->store('banners', 'public');
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'Gagal menyimpan gambar: ' . $e->getMessage());
            }
        } else {
            return redirect()->back()->with('error', 'Tidak ada gambar yang diunggah.');
        }
    
        // Simpan ke database
        try {
            Banner::create([
                'gambar' => $path,
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menyimpan ke database: ' . $e->getMessage());
        }
    
        return redirect()->back()->with('success', 'Banner berhasil ditambahkan!');
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
    
     public function update(Request $request, $id)
     {
         $request->validate([
             'gambar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
         ]);
     
         $banner = Banner::findOrFail($id);
     
         // Path gambar lama
         $oldImage = $banner->gambar;
     
         // Simpan gambar baru dengan nama unik
         if ($request->hasFile('gambar')) {
             try {
                 // Hapus gambar lama jika ada
                 if ($oldImage && Storage::disk('public')->exists($oldImage)) {
                     Storage::disk('public')->delete($oldImage);
                 }
                 
                 // Simpan gambar baru ke folder yang sama
                 $gambarPath = $request->file('gambar')->store('banners', 'public');
                 
                 // Update data banner dengan path baru
                 $banner->update([
                     'gambar' => $gambarPath,
                 ]);
             } catch (\Exception $e) {
                 return redirect()->back()->with('error', 'Gagal memperbarui gambar: ' . $e->getMessage());
             }
         }
     
         return redirect()->back()->with('success', 'Banner berhasil diperbarui!');
     }
     
    

    /**
     * Remove the specified resource from storage.
     */
     // Hapus file trailer dan gambar jika ada di storage/app/public/posters
        public function destroy($id)
        {
            $banner = Banner::findOrFail($id);
        
            // Hapus file gambar dari storage jika ada
            if ($banner->gambar && Storage::disk('public')->exists($banner->gambar)) {
                Storage::disk('public')->delete($banner->gambar);
            }
        
            $banner->delete();
        
            return redirect()->route('admin.banner')->with('success', 'Banner berhasil dihapus.');
        }
        
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Film;
use App\Models\Genre_relation;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function addProfilePicture(Request $request)
    {
        $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $user = User::find(Auth::id());

        // Simpan foto baru
        $path = $request->file('photo')->store('profile_pictures', 'public');
        
        // Tambahkan foto profil user
        $user->photo = $path;
        $user->save();


        return back()->with('success', 'Foto profil berhasil ditambahkan!');
    }

    public function edit(Request $request): View
    {   
        $genre = Genre_relation::select('genre_relations.id_genre', 'genre.title')
            ->join('genre', 'genre_relations.id_genre', '=', 'genre.id_genre')
            ->groupBy('genre_relations.id_genre', 'genre.title')
            ->get();
        
        $datafilm = Film::orderByDesc('tahun_rilis')->get();
        $dataFilm = Film::orderByDesc('tahun_rilis')->get();
        $user = $request->user();
        
        return view('profile.edit', compact('genre', 'datafilm', 'dataFilm', 'user'));
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
        $data = $request->validated();
    
        try {
            if ($request->hasFile('photo')) {
                if ($user->photo) {
                    Storage::disk('public')->delete('photos/' . $user->id_users . '/' . $user->photo);
                }
    
                $fileName = Str::uuid() . '.' . $request->file('photo')->getClientOriginalExtension();
                $path = $request->file('photo')->storeAs('photos/' . $user->id_users, $fileName, 'public');
                $data['photo'] = $fileName;
            }
    
            $user->update($data);
        } catch (\Exception $e) {
            Log::error('Error updating profile: ' . $e->getMessage());
            return Redirect::route('profile.edit')->with('error', 'Failed to update profile.');
        }
    
        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }
    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}

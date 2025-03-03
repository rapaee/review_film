<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Detail Genre Relation</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="">
    @extends('navbar-admin.navbar')

    @section('navbar-admin')
   <div class="">
    <h1 class="flex justify-center font-bold mb-4 mt-2 text-2xl">FORM EDIT GENRE RELASI</h1>
    <form action="  {{ route('author.edit-genre-relasi.update', $film->id_film) }}" method="POST" class="w-full bg-white p-6 rounded-lg shadow-md">
               
  
        @csrf
        @method('PUT')
        
        <div class="mb-4">
            <label for="film" class="block text-gray-700 font-medium mb-2">Judul Film</label>
            <select class="w-full border-gray-500 rounded-lg shadow-sm focus:ring focus:ring-blue-200 p-2" id="film" name="film">
                @foreach($filmList as $f)
                <option value="{{ $f->id_film }}" {{ $f->id_film == $film->id_film ? 'selected' : '' }}>{{ $f->judul }}</option>
            @endforeach
            
            </select>
        </div>
        
        <div class="mb-4">
            <label class="block text-gray-700 font-medium mb-2">Genre</label>
            <div class="flex flex-wrap gap-3">
                @foreach($genre as $genreItem)
                <div class="flex items-center mb-2">
                    <input type="checkbox" id="genre_{{ $genreItem->id_genre }}" name="id_genre[]" value="{{ $genreItem->id_genre }}" 
                        class="mr-2 border-gray-300 rounded focus:ring-indigo-500"
                        {{ in_array($genreItem->id_genre, $selectedGenres) ? 'checked' : '' }}>
                    <label for="genre_{{ $genreItem->id_genre }}" class="text-gray-700">{{ $genreItem->title }}</label>
                </div>
            @endforeach
            
            </div>
        </div>
        
        <div class="gap-5 flex justify-end">
           <a href="{{ route('author.genre-relasi') }}">
            <button class="w-20 bg-red-600 text-white p-1 h-10 rounded-lg hover:bg-red-700 transition duration-200">
                Batal
            </button>
           </a>
            <button type="submit" class="w-20 bg-green-600 text-white p-1 h-10 rounded-lg hover:bg-green-700 transition duration-200">
                Submit
            </button>
        </div>
    </form>
   </div>
    
    
    @endsection
    
</body>
</html>
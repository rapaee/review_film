<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Form Tambah Film</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    @extends('navbar-admin.navbar')
    @section('navbar-admin')

<form class="max-w-full mx-auto p-5" method="POST" action="{{ route('admin.input-film.store') }}" enctype="multipart/form-data">
    @csrf
    <h1 class="text-2xl font-bold text-center">FORM TAMBAH FILM</h1>
    <div class="mb-3">
      <label for="judul" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Judul</label>
      <input type="text" id="judul" name="judul" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-100 dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" value="{{ old('judul') }}" required />
      @error('judul')
      <span class="text-red-700">{{ $message }}</span>
     @enderror
    </div>
    <div class="mb-3">
        <label for="pencipta" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Pencipta</label>
        <input type="text" id="pencipta" name="pencipta" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-100 dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" value="{{ old('pencipta') }}" required />
        @error('pencipta')
        <span class="text-red-700">{{ $message }}</span>
       @enderror  
    </div>
    <div class="mb-3">
        <label for="deskripsi" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Deskripsi</label>
        <textarea id="deskripsi" name="deskripsi" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-100 dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" value="{{ old('deskripsi') }}" required></textarea>
        @error('deskripsi')
        <span class="text-red-700">{{ $message }}</span>
       @enderror
    </div>
    <div class="mb-3">
        <label for="tahun_rilis" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Tahun Rilis</label>
        <input type="number" id="tahun_rilis" name="tahun_rilis" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-100 dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" value="{{ old('tahun_rilis') }}" required />
        @error('tahun_rilis')
        <span class="text-red-700">{{ $message }}</span>
       @enderror
    </div>
    <div class="mb-3">
      <label for="durasi" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Durasi</label>
      <input type="text" id="durasi" name="durasi" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-100 dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" value="{{ old('durasi') }}" required />
      @error('durasi')
      <span class="text-red-700">{{ $message }}</span>
     @enderror
    </div>
    <div class="mb-3">
        <label for="rating" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Rating</label>
        <input type="number" step="0.1" id="rating" name="rating" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-100 dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" value="{{ old('rating') }}" required />
        @error('rating')
        <span class="text-red-700">{{ $message }}</span>
       @enderror
    </div>
    <div class="mb-3">
        <label for="poster" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Poster</label>
        <input type="file" id="poster" name="poster" accept="image/*" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-100 dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" value="{{ old('poster') }}" required />
        @error('poster')
        <span class="text-red-700">{{ $message }}</span>
       @enderror
    </div>
    <div class="mb-3">
        <label for="trailer" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Trailer</label>
        <input type="file" id="trailer" name="trailer" accept="video/*" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-100 dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light " value="{{ old('trailer') }}" required />
        @error('trailer')
        <span class="text-red-700">{{ $message }}</span>
       @enderror
    </div>
    <div class="flex justify-end gap-4">
        <a href="#" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-blue-800">Kembali</a>
        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-blue-800">Submit</button>
    </div>
</form>

    @endsection
</body>
</html>

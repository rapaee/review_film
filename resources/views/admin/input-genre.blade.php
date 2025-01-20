<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Form Tambah Genre</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    @extends('navbar-admin.navbar')
    @section('navbar-admin')
       

<form action="{{ route('admin.input-genre.store') }}" method="POST" class="max-w-full mx-auto p-5">
    @csrf
    <h1 class="text-2xl font-bold text-center">FORM TAMBAH GENRE</h1>
    <div class="mb-3">
      <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Judul</label>
      <input type="text" name="title" id="title" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-100 dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" value="{{ old('title') }}"  required />
        @error('title')
            <span class="text-red-700">{{ $message }}</span>
        @enderror
    </div>
    <div class="mb-3">
        <label for="slug" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Slug</label>
        <input type="text" name="slug" id="slug" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-100 dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" value="{{ old('slug') }}"  required />
        @error('slug')
            <span class="text-red-700">{{ $message }}</span>
        @enderror
    </div>
    <div class="flex justify-end gap-4">
        <a href="{{ route('admin.genre') }}" class=" text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-blue-800">Kembali</a>
        <button type="submit" class=" text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-blue-800">Submit</button>
    </div>
  </form>
  

    @endsection
</body>
</html>
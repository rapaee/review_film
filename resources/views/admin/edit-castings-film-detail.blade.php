<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Castings Film Detail</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="">
    @extends('navbar-admin.navbar')

    @section('navbar-admin')
  
    <div class="">
    <h1 class="flex justify-center font-bold mb-4 mt-2 text-2xl">FORM EDIT CASTINGS</h1>
    <form action="   {{ route('admin.edit-castings-film-detail.update', $casting->id_castings) }} " method="POST" class="w-full bg-white p-6 rounded-lg shadow-md">
               
  
        @csrf
        @method('PUT')
        
        <div class="mb-4 ">
            <label for="id_film" class="block text-sm font-medium text-gray-700 text-left">ID Film</label>
            <input type="text" id="id_film" name="id_film" class="mt-1 p-2 w-full border border-gray-300 rounded-md" value="{{ old('id_film',$casting->film->id_film) }}" readonly>
        </div>

        <div class="mb-4">
            <label for="nama_panggung" class="block text-sm font-medium text-gray-700 text-left">Nama Panggung</label>
            <input type="text" id="nama_panggung" name="nama_panggung" class="mt-1 p-2 w-full border border-gray-300 rounded-md" value="{{ old('nama_panggung', $casting->nama_panggung) }}" required>
        </div>

        <div class="mb-4">
            <label for="nama_asli" class="block text-sm font-medium text-gray-700 text-left">Nama Asli</label>
            <input type="text" id="nama_asli" name="nama_asli" class="mt-1 p-2 w-full border border-gray-300 rounded-md" value="{{ old('nama_asli', $casting->nama_asli) }}" required>
        </div>

        
        <div class="gap-3 flex justify-end">
           <a href="{{ route('admin.film-detail', ['id' => $casting->film->id_film]) }}">
            <button class="w-20 bg-red-600 text-white p-1 h-8 rounded-md hover:bg-red-700 transition duration-200">
                Batal
            </button>
           </a>
            <button type="submit" class="w-20 bg-green-600 text-white p-1 h-8 rounded-md hover:bg-green-700 transition duration-200">
                Submit
            </button>
        </div>
    </form>
   </div>
    
    
    @endsection
    
</body>
</html>
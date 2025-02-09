</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Genre Relasi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <style>
        ::-webkit-scrollbar {
                display: none;
            }

            /* Untuk Firefox */
            html {
                scrollbar-width: none;
            }
    </style>
</head>
<body>
    @extends('navbar-admin.navbar')
    @section('navbar-admin')
       
    <h1 class="flex justify-center font-bold mb-4 mt-2 text-2xl">TABLE GENRE RELASI</h1>
<div class="flex justify-between">
    <form class="flex-grow me-4 ml-2 ">   
        <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
        <div class="relative">
            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                </svg>
            </div>
            <input type="search" id="default-search" class="block w-3/12 p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 " placeholder="Seacrh" />
           
        </div>
    </form>
    <button id="openModal" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm h-12 w-12 flex justify-center items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 mr-2">
        <img src="https://cdn-icons-png.flaticon.com/128/992/992651.png" alt="" class="w-8 h-8 filter invert">
    </button>
</div>



<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm rtl:text-right text-gray-500 dark:text-black text-center">
        <thead class="text-xs uppercase dark:bg-blue-200 dark:text-black">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Judul
                </th>
                <th scope="col" class="px-6 py-3">
                    Genre
                </th>
                <th scope="col" class="px-6 py-3">
                    <span class="sr-only">Edit</span>
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($gl as $judul => $items)
            <tr class="border-b dark:border-gray-400">
                <td class="px-6 py-3">{{ $judul }}</td>
                <td class="px-6 py-3">
                    {{ $items->pluck('genre.title')->implode(', ') }}
                </td>
                <td class="px-2 py-4 flex justify-center items-center gap-3">
                    @if ($items->isNotEmpty())
                        <form id="delete-form-{{ $items->first()->id }}" action="{{ route('admin.genre-relasi.delete', $items->first()->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="text-white bg-red-600 flex justify-center hover:bg-red-700 mt-3 py-1 h-8 rounded w-14 delete-btn" data-id="{{ $items->first()->id }}">
                                <img src="https://cdn-icons-png.flaticon.com/128/542/542724.png" alt="" class="w-5 h-5 filter invert">
                            </button>
                        </form>
                        <a href="{{ route('admin.edit-genre-relasi', ['id' => $items->first()->film->id_film]) }}">
                            <button class="text-white bg-green-600 hover:bg-green-700 py-1 w-14 h-8 rounded px-4 flex justify-center">
                                <img src="https://cdn-icons-png.flaticon.com/128/3597/3597088.png" alt="" class="w-5 h-5 filter invert">
                            </button>
                        </a>
                    @endif
                </td>
            </tr>
        @endforeach
        
        </tbody>
        
    </table>
    
</div>
<script>
     @if ($errors->any())

document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('openModal').click();
});
@endif

// Notifikasi sukses atau error dari session
@if(session('success'))
Swal.fire({
    icon: 'success',
    title: 'Sukses!',
    text: "{{ session('success') }}",
    timer: 1000,
    showConfirmButton: false
});
@elseif(session('error'))
Swal.fire({
    icon: 'error',
    title: 'Gagal!',
    text: "{{ session('error') }}",
    timer: 1000,
    showConfirmButton: false
});
@endif
document.getElementById('openModal').addEventListener('click', function () {
    Swal.fire({
        title: 'FORM TAMBAH GENRE RELASI',
        html: `
          <form action="{{ route('admin.genre-relasi.store') }}" method="POST" id="genreRelasiForm" class="text-left">
                @csrf
                <div class="mb-4">
                    <label for="id_film" class="block text-gray-700 font-medium mb-2">Judul Film</label>
                    <select class="w-full border-gray-500 rounded-lg shadow-sm focus:ring focus:ring-blue-200 p-2" id="id_film" name="id_film">
                        <option value="" selected disabled>Pilih Judul Film</option>
                        @foreach($film as $f)
                        <option value="{{ $f->id_film }}">{{ $f->judul }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-2">Genre</label>
                    <div class="flex flex-wrap gap-3">
                        @foreach($genre as $genreItem)
                        <div class="flex items-center mb-2">
                            <input type="checkbox" id="genre_{{ $genreItem->id_genre }}" name="id_genre[]" value="{{ $genreItem->id_genre }}" 
                                class="mr-2 border-gray-300 rounded focus:ring-indigo-500">
                            <label for="genre_{{ $genreItem->id_genre }}" class="text-gray-700">{{ $genreItem->title }}</label>
                        </div>
                        @endforeach
                    </div>
                </div>
            </form>

        `,
        showCancelButton: true,
        confirmButtonText: 'Submit',
        cancelButtonText: 'Batal',
        cancelButtonColor: '#ff0000',  // Merah untuk tombol Batal
        confirmButtonColor: '#008000', // Hijau untuk tombol Submit
        preConfirm: () => {
            const form = document.getElementById('genreRelasiForm');
            form.submit();
        }
    });
});

    
    document.addEventListener('DOMContentLoaded', function () {
        const searchInput = document.getElementById('default-search');
        const tableRows = document.querySelectorAll('tbody tr');

        searchInput.addEventListener('input', function () {
            const searchQuery = searchInput.value.toLowerCase();
            tableRows.forEach(row => {
                const cells = Array.from(row.querySelectorAll('td'));
                const rowText = cells.map(cell => cell.textContent.toLowerCase()).join(' ');
                
                if (rowText.includes(searchQuery)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    });
    //alert button delete
    document.addEventListener("DOMContentLoaded", function() {
    document.querySelectorAll('.delete-btn').forEach(button => {
        button.addEventListener('click', function() {
            let userId = this.getAttribute('data-id');
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data ini akan dihapus secara permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + userId).submit();
                }
            });
        });
    });
});
</script>
    @endsection
</body>
</html>
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

</head>
<body>
    @extends('navbar-admin.navbar')
    @section('navbar-admin')
       
    <h1 class="flex justify-center font-bold mb-4 mt-2 text-2xl">TABLE GENRE RELASI</h1>
<div class="flex justify-between mb-3">
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
    <button id="openModal" class="text-blue-700 hover:text-white border focus:ring-blue-300 font-medium rounded-lg text-sm w-24 h-12 text-center me-2 mb-2 dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:hover:bg-blue-500">
        Tambah
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
                    <td class="px-2 py-4 flex justify-end items-center gap-3">
                        <form action="{{ route('admin.genre-relasi.delete', $items->first()->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-white bg-red-600 hover:bg-red-700 p-2 h-8 mt-3 rounded w-16">
                               <p class="-mt-0.5">Delete</p>
                            </button>
                        </form>
                        <button 
                        class="text-white bg-green-600 hover:bg-green-700 py-1 rounded h-8 w-16" 
                        onclick="showEditPopup('{{ route('admin.genre-relasi.update', $items->first()->id) }}', '{{ $items->first()->id_film }}', '{{ $items->first()->id_genre }}')">
                        Edit
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
        
    </table>
    
</div>
<script>

function showEditPopup(updateUrl, id_film, id_genre) {
    Swal.fire({
        title: 'Edit Genre',
        html: `
            <form id="editGenreForm" action="${updateUrl}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3 text-left">
                    <label for="id_film" class="block text-sm font-medium text-gray-700">Judul Film:</label>
                    <select id="id_filmz" name="id_film" tabindex="4" 
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option value="">Pilih Film</option>
                        @foreach($film as $filmItem)
                            <option value="{{ $filmItem->id_film }}" 
                                ${id_film == "{{ $filmItem->id_film }}" ? 'selected' : ''}>
                                {{ $filmItem->judul }}
                            </option>
                        @endforeach
                    </select>
                    @error('id_film')
                        <span class="text-red-700">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3 text-left">
                    <label for="id_genre" class="block text-sm font-medium text-gray-700">Genre:</label>
                    <select id="id_genre" name="id_genre" tabindex="4" 
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option value="">Pilih Genre</option>
                        @foreach($genre as $genreItem)
                            <option value="{{ $genreItem->id_genre }}" 
                                ${id_genre == "{{ $genreItem->id_genre }}" ? 'selected' : ''}>
                                {{ $genreItem->title }}
                            </option>
                        @endforeach
                    </select>
                    @error('id_genre')
                        <span class="text-red-700">{{ $message }}</span>
                    @enderror
                </div>
            </form>
        `,
        showCancelButton: true,
        confirmButtonText: 'Submit',
        cancelButtonText: 'Batal',
        cancelButtonColor: '#ff0000',
        confirmButtonColor: '#008000',
        preConfirm: () => {
            document.getElementById('editGenreForm').submit();
        }
    });
}
    document.getElementById('openModal').addEventListener('click', function () {
        Swal.fire({
            title: 'Tambah Genre Relasi',
            html: `
                <form id="addFilmForm" action="{{ route('admin.genre-relasi.store') }}" method="POST">
                    @csrf
                    <div class="mb-3 text-left">
                        <label for="Film" class="block text-sm font-medium text-gray-700">Judul:</label>
                        <select id="id_film" name="id_film" tabindex="4" class="select2 mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <option value="">Pilih Film</option>
                            @foreach($film as $item)
                                <option value="{{ $item->id_film }}" {{ old('id_film') == $item->id_film ? 'selected' : '' }}>{{ $item->judul }}</option>
                            @endforeach
                        </select>
                        @error('id_film')
                            <span class="text-red-700">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3 text-left">
                        <label for="Genre" class="block text-sm font-medium text-gray-700">Judul:</label>
                        <select id="id_genre" name="id_genre" tabindex="4" class="select2 mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <option value="">Pilih Genre</option>
                            @foreach($genre as $item)
                                <option value="{{ $item->id_genre }}" {{ old('id_genre') == $item->id_genre ? 'selected' : '' }}>{{ $item->title }}</option>
                            @endforeach
                        </select>
                        @error('id_genre')
                            <span class="text-red-700">{{ $message }}</span>
                        @enderror
                    </div>
                </form>
            `,
            showCancelButton: true,
            confirmButtonText: 'Submit',
            cancelButtonText: 'Batal',
            cancelButtonColor: '#ff0000',  // Merah untuk tombol Batal
            confirmButtonColor: '#008000', // Hijau untuk tombol Submit
            preConfirm: () => {
                document.getElementById('addFilmForm').submit();
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
    
</script>
    @endsection
</body>
</html>
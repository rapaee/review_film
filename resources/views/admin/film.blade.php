</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Film</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</head>
<body>
    @extends('navbar-admin.navbar')
    @section('navbar-admin')
       
    <h1 class="flex justify-center font-bold mb-4 mt-2 text-2xl">TABLE FILM</h1>
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
    <div class="flex gap-2">
        <button id="openModal" class="text-blue-700 hover:text-white border focus:ring-blue-300 font-medium rounded-lg text-sm w-24 h-12 text-center me-2 mb-2 dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:hover:bg-blue-500">
            Tambah
          </button>
         
    </div>
</div>



<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm rtl:text-right text-gray-500 dark:text-black text-center">
        <thead class="text-xs uppercase dark:bg-blue-200 dark:text-black text-center">
            <tr>
                <th scope="col" class="px-6 py-3 text-center">
                    Judul
                </th>
                <th scope="col" class="px-6 py-3 text-center">
                    Pencipta
                </th>
                <th scope="col" class="px-6 py-3 text-center">
                    Poster
                </th>
                <th scope="col" class="px-6 py-3 text-center">
                    <span class="sr-only">Edit</span>
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($films as $film)
                <tr class="border-b dark:border-gray-400">
                    <td class="px-6 py-3 text-center">{{ $film->judul }}</td>
                    <td class="px-6 py-3 text-center">{{ $film->pencipta }}</td>
                    <td class="px-6 py-3 text-center">
                        <img src="{{ asset('storage/' . $film->poster) }}" alt="Poster" class="w-10 h-16 mx-auto">
                    </td>
                    <td class="flex mt-3 justify-center items-center gap-3">
                        <form action="{{ route('admin.film.delete', $film->id_film) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="mt-4 text-white bg-red-600 hover:bg-red-700 rounded w-16 h-8 flex items-center justify-center">
                                <p class="text-sm">Delete</p>
                            </button>
                        </form>
                    
                        <button 
                        class="text-white bg-green-600 hover:bg-green-700 rounded w-16 h-8 flex items-center justify-center"
                        onclick="showEditFilmPopup('{{ route('admin.edit-film.update', $film->id_film) }}', '{{ $film->judul }}', '{{ $film->pencipta }}', '{{ $film->deskripsi }}', '{{ $film->tahun_rilis }}', '{{ $film->durasi }}', '{{ $film->poster }}', '{{ $film->trailer }}','{{ $film->kategori_umur }}')">
                        <p class="text-sm">Edit</p>
                        </button>
                    
                        <a class="text-sm" href="{{ route('admin.film-detail', ['id' => $film->id_film]) }}">
                        <button 
                            class="text-white bg-yellow-600 hover:bg-yellow-700 rounded w-16 h-8 flex items-center justify-center">
                                Detail
                            </button>
                        </a>
                    </td>
                    
                </tr>
            @endforeach
        </tbody>
    </table>
    
    
</div>
<script>
function showEditFilmPopup(updateUrl, judul, pencipta, deskripsi, tahun_rilis, durasi, poster, trailer, kategori_umur) {
    Swal.fire({
        title: 'Edit Film',
        html: `
            <form id="editFilmForm" action="${updateUrl}" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="_method" value="PUT">
                <div class="mb-3 text-left">
                    <label for="judul" class="block mb-2 text-sm font-medium text-gray-900">Judul</label>
                    <input type="text" name="judul" id="judul" value="${judul}" 
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                </div>
                <div class="mb-3 text-left">
                    <label for="pencipta" class="block mb-2 text-sm font-medium text-gray-900">Pencipta</label>
                    <input type="text" name="pencipta" id="pencipta" value="${pencipta}" 
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                </div>
                <div class="mb-3 text-left">
                    <label for="deskripsi" class="block mb-2 text-sm font-medium text-gray-900">Deskripsi</label>
                    <textarea name="deskripsi" id="deskripsi" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>${deskripsi}</textarea>
                </div>
                <div class="mb-3 text-left">
                    <label for="tahun_rilis" class="block mb-2 text-sm font-medium text-gray-900">Tahun Rilis</label>
                    <input type="number" name="tahun_rilis" id="tahun_rilis" value="${tahun_rilis}" 
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                </div>
                <div class="mb-3 text-left">
                    <label for="kategori_umur" class="block mb-2 text-sm font-medium text-gray-900">Kategori Umur</label>
                    <select name="kategori_umur" id="kategori_umur" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                        <option value="SU" ${kategori_umur === 'SU' ? 'selected' : ''}>Semua Umur</option>
                        <option value="13+" ${kategori_umur === '13+' ? 'selected' : ''}>13+</option>
                        <option value="17+" ${kategori_umur === '17+' ? 'selected' : ''}>17+</option>
                        <option value="21+" ${kategori_umur === '21+' ? 'selected' : ''}>21+</option>
                    </select>
                </div>
                <div class="mb-3 text-left">
                    <label for="durasi" class="block mb-2 text-sm font-medium text-gray-900">Durasi</label>
                    <input type="text" name="durasi" id="durasi" value="${durasi}" 
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                </div>
                <div class="mb-3 text-left">
                    <label for="poster" class="block mb-2 text-sm font-medium text-gray-900">Poster</label>
                    <input type="file" name="poster" id="poster" accept="image/*" 
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                </div>
                <div class="mb-3 text-left">
                    <label for="trailer" class="block mb-2 text-sm font-medium text-gray-900">Trailer</label>
                    <input type="file" name="trailer" id="trailer" accept="video/*" 
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                </div>
            </form>
        `,
        showCancelButton: true,
        confirmButtonText: 'Submit',
        cancelButtonText: 'Batal',
        cancelButtonColor: '#ff0000',  // Merah untuk tombol Batal
        confirmButtonColor: '#008000', // Hijau untuk tombol Submit
        preConfirm: () => {
            // Submit form after confirmation
            document.getElementById('editFilmForm').submit();
        }
    });
}


document.getElementById('openModal').addEventListener('click', function () {
    Swal.fire({
        title: 'Tambah Film',
        html: `
            <form id="addFilmForm" action="{{ route('admin.input-film.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id_users" value="{{ Auth::id() }}">

                <div class="grid grid-cols-2 gap-4">
                    <div class="mb-3 text-left">
                        <label for="judul" class="block mb-2 text-sm font-medium text-gray-900">Judul</label>
                        <input type="text" name="judul" id="judul" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg w-full p-2.5" required />
                    </div>
                    <div class="mb-3 text-left">
                        <label for="pencipta" class="block mb-2 text-sm font-medium text-gray-900">Pencipta</label>
                        <input type="text" name="pencipta" id="pencipta" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg w-full p-2.5" required />
                    </div>
                    <div class="mb-3 text-left col-span-2">
                        <label for="deskripsi" class="block mb-2 text-sm font-medium text-gray-900">Deskripsi</label>
                        <textarea name="deskripsi" id="deskripsi" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg w-full p-2.5" required></textarea>
                    </div>
                    <div class="mb-3 text-left">
                        <label for="tahun_rilis" class="block mb-2 text-sm font-medium text-gray-900">Tahun Rilis</label>
                        <input type="number" name="tahun_rilis" id="tahun_rilis" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg w-full p-2.5" required />
                    </div>
                    <div class="mb-3 text-left">
                        <label for="durasi" class="block mb-2 text-sm font-medium text-gray-900">Durasi</label>
                        <input type="text" name="durasi" id="durasi" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg w-full p-2.5" required />
                    </div>
                     <div class="mb-3 text-left">
                        <label for="kategori_umur" class="block mb-2 text-sm font-medium text-gray-900">Kategori Umur</label>
                         <select name="kategori_umur" id="kategori_umur" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                            <option value="SU">Semua Umur</option>
                            <option value="13+">13+</option>
                            <option value="17+">17+</option>
                            <option value="21+">21+</option>
                         </select>
                    </div>
                    <div class="mb-3 text-left">
                        <label for="poster" class="block mb-2 text-sm font-medium text-gray-900">Poster</label>
                        <input type="file" name="poster" id="poster" accept="image/*" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg w-full p-2.5" required />
                    </div>
                    <div class="mb-3 text-left">
                        <label for="trailer" class="block mb-2 text-sm font-medium text-gray-900">Trailer</label>
                        <input type="file" name="trailer" id="trailer" accept="video/*" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg w-full p-2.5" required />
                    </div>
                </div>
            </form>
        `,
        showCancelButton: true,
        confirmButtonText: 'Submit',
        cancelButtonText: 'Batal',
        cancelButtonColor: '#ff0000',
        confirmButtonColor: '#008000',
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
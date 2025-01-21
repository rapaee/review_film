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
    <a href="{{ route('admin.input-film') }}">
    <button type="button" class="text-blue-700 hover:text-white border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:hover:bg-blue-500 dark:focus:ring-blue-800">
      Tambah
    </button>
    </a>
</div>



<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm rtl:text-right text-gray-500 dark:text-black text-center">
        <thead class="text-xs uppercase dark:bg-blue-200 dark:text-black">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Judul
                </th>
                <th scope="col" class="px-6 py-3">
                    Pencipta
                </th>
                <th scope="col" class="px-6 py-3">
                    Deskripsi
                </th>
                <th scope="col" class="px-6 py-3">
                    Tahun Rilis
                </th>
                <th scope="col" class="px-6 py-3">
                    Durasi
                </th>
                <th scope="col" class="px-6 py-3">
                    Rating
                </th>
                <th scope="col" class="px-6 py-3">
                    Poster
                </th>
                <th scope="col" class="px-6 py-3">
                    Trailer
                </th>
                <th scope="col" class="px-6 py-3">
                    <span class="sr-only">Edit</span>
                </th>
            </tr>
        </thead>
        <tbody>
            <tbody>
                @foreach ($films as $film)
                    <tr>
                        <td class="px-6 py-3">{{ $film->judul }}</td>
                        <td class="px-6 py-3">{{ $film->pencipta }}</td>
                        <td class="px-6 py-3">{{ $film->deskripsi }}</td>
                        <td class="px-6 py-3">{{ $film->tahun_rilis }}</td>
                        <td class="px-6 py-3">
                            @php
                                $hours = floor($film->durasi / 60);
                                $minutes = $film->durasi % 60;
                            @endphp
                            @if ($minutes == 0)
                                {{ $hours }} jam
                            @else
                                {{ $hours }} jam {{ $minutes }} menit
                            @endif
                        </td>
                        
                        <td class="px-6 py-3">{{ $film->rating }}</td>
                        <td class="px-6 py-3 flex justify-center">
                            <img src="{{ asset('storage/' . $film->poster) }}" alt="Poster" class="w-10 h-16">
                        </td>
                        <td class="px-6 py-3">
                            <a href="{{ asset('storage/' . $film->trailer) }}" target="_blank">Lihat Trailer</a>
                        </td>
                        {{-- <td class="px-6 py-3">
                            <video width="320" height="240" controls>
                                <source src="{{ asset('storage/' . $film->trailer) }}" type="video/mp4">
                                Browser Anda tidak mendukung elemen video.
                            </video>
                        </td> --}}
                        {{-- <td class="px-6 py-3">
                            <a href="{{ route('admin.film.edit', $film->id_film) }}" class="text-blue-500">Edit</a>
                        </td> --}}
                        <td class="px-2 py-4 flex justify-end gap-3">
                            <form action="{{ route('admin.film.delete', $film->id_film) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-white bg-red-600 hover:bg-red-700 p-2 h-8 rounded w-16">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                                <a href="{{ route('admin.edit-film', $film->id_film) }}" class="text-white bg-green-600 hover:bg-green-700 p-2 rounded h-8 w-16">
                                    <i class="fa-solid fa-pencil"></i>
                                </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            
        </tbody>
    </table>
    
</div>
<script>
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
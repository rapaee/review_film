<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<style>
    ::-webkit-scrollbar {
        display: none;
    }

    /* Untuk Firefox */
    html {
        scrollbar-width: none;
    }
</style>

<body>
    @extends('navbar-admin.navbar')
    @section('navbar-admin')
        <h1 class="flex justify-center font-bold mb-4 mt-2 text-2xl uppercase">Selamat Datang {{ Auth::user()->name }} Di Paee Films</h1>
        <form class="flex-grow me-4 ml-2 mb-4">
            <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
            <div class="relative">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                    </svg>
                </div>
                <input type="search" id="default-search"
                    class="block w-3/12 p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 "
                    placeholder="Judul Film" />

            </div>
        </form>


        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm rtl:text-right text-gray-500 dark:text-black text-center">
                <thead class="text-xs uppercase dark:bg-blue-200 dark:text-black text-center">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-center">
                            Judul
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            Nama
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            Comment
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            Rating
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            <span class="sr-only">Edit</span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($komen as $item)
                        <tr class="border-b dark:border-gray-400">
                            <td class="px-6 py-3 text-center">{{ $item->film->judul }}</td>
                            <td class="px-6 py-3 text-center">{{ $item->user->name }}</td>
                            <td class="px-6 py-3 text-center">{{ $item->comment }}</td>
                            <td class="px-6 py-3 text-center">
                                
                                    @foreach($ratings as $komen)
                                    <p class="text-yellow-400">
                                        @for ($i = 1; $i <= 5; $i++)
                                            @if ($i <= $komen->rating)
                                                <i class="fas fa-star text-warning"></i>  {{-- Bintang kuning --}}
                                            @else
                                                <i class="far fa-star text-secondary"></i> {{-- Bintang kosong --}}
                                            @endif
                                        @endfor
                                    </p>
                                @endforeach
                                

                               
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>


        </div>
    @endsection
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('default-search');
            const tableRows = document.querySelectorAll('tbody tr');

            searchInput.addEventListener('input', function() {
                const searchQuery = searchInput.value.toLowerCase()
            .trim(); // Trim untuk hapus spasi awal/akhir
                tableRows.forEach(row => {
                    const rowText = Array.from(row.querySelectorAll('td'))
                        .map(cell => cell.textContent.trim()
                    .toLowerCase()) // Pastikan trim() digunakan
                        .join(' ');

                    row.style.display = rowText.includes(searchQuery) ? '' : 'none';
                });
            });
        });
    </script>

</body>

</html>

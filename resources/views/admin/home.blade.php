<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body>
    @extends('navbar-admin.navbar')
    @section('navbar-admin')
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 p-4 gap-4">
            <a href="{{ route('admin.user') }}">
                <div
                    class="bg-red-700 dark:bg-gray-800 shadow-lg rounded-md flex items-center justify-between p-3 border-b-4 border-gray-900 dark:border-gray-600 text-white font-medium group">
                    <div
                        class="flex justify-center items-center w-14 h-14 bg-white rounded-full transition-all duration-300 transform group-hover:rotate-12">
                        <img src="https://cdn-icons-png.flaticon.com/128/1077/1077114.png" alt="" class="w-8 h-8">
                    </div>
                    <div class="text-right">
                        <p class="text-2xl">USER</p>
                        <p>{{ $userCount }}</p>
                    </div>
                </div>
            </a>
            <a href="{{ route('admin.film') }}">
                <div
                    class="bg-red-700 dark:bg-gray-800 shadow-lg rounded-md flex items-center justify-between p-3 border-b-4 border-gray-900 dark:border-gray-600 text-white font-medium group">
                    <div
                        class="flex justify-center items-center w-14 h-14 bg-white rounded-full transition-all duration-300 transform group-hover:rotate-12">
                        <img src="https://cdn-icons-png.flaticon.com/128/1101/1101793.png" alt="" class="w-8 h-8">
                    </div>
                    <div class="text-right">
                        <p class="text-2xl">FILM</p>
                        <p>{{ $listfilm }}</p>
                    </div>
                </div>
            </a>
            <a href="{{ route('admin.castings') }}">
                <div
                    class="bg-red-700 dark:bg-gray-800 shadow-lg rounded-md flex items-center justify-between p-3 border-b-4 border-gray-900 dark:border-gray-600 text-white font-medium group">
                    <div
                        class="flex justify-center items-center w-14 h-14 bg-white rounded-full transition-all duration-300 transform group-hover:rotate-12">
                        <img src="https://cdn-icons-png.flaticon.com/128/2893/2893811.png" alt="" class="w-8 h-8">
                    </div>
                    <div class="text-right">
                        <p class="text-2xl">CASTINGS</p>
                        <p>{{ $castingsCount }}</p>
                    </div>
                </div>
            </a>

            <div
                class="bg-red-700 dark:bg-gray-800 shadow-lg rounded-md flex items-center justify-between p-3 border-b-4 border-gray-900 dark:border-gray-600 text-white font-medium group">
                <div
                    class="flex justify-center items-center w-14 h-14 bg-white rounded-full transition-all duration-300 transform group-hover:rotate-12">
                    <div
                        class="flex justify-center items-center w-14 h-14 bg-white rounded-full transition-all duration-300 transform group-hover:rotate-12">
                        <img src="  https://cdn-icons-png.flaticon.com/128/9513/9513804.png" alt="" class="w-8 h-8">
                    </div>

                </div>
                <div class="text-right">
                    <p class="text-2xl">KOMENTAR</p>
                    <p>{{ $listkomen }}</p>
                </div>
            </div>
        </div>

        <div class="flex justify-between items-center px-4 relative mb-5">
            <form class="flex-grow">
                <label for="search" class="sr-only">Search</label>
                <div class="relative w-1/3">
                    <input type="search" id="search"
                        class="block w-full p-4 pl-10 text-sm border rounded-lg bg-gray-50 focus:ring-blue-500"
                        placeholder="Search">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3">
                        <svg class="w-4 h-4 text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                            fill="none">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                        </svg>
                    </div>
                </div>
            </form>

            <div class="relative">
                <button id="dropdownButton"
                    class="bg-green-600 hover:bg-green-700 text-white w-12 h-12 rounded-lg flex justify-center items-center">
                    <img src="https://cdn-icons-png.flaticon.com/128/9373/9373611.png" alt=""
                        class="w-8 h-8 filter invert">
                </button>

                <div id="dropdownMenu" class="hidden absolute bg-green-700 shadow-md rounded-lg mt-2 w-44 -ml-28 z-10">
                    <ul class="py-2 text-sm text-white">
                        <li class="block px-4 py-2 hover:bg-green-600 rounded-lg cursor-pointer">Semua</li>
                        @foreach ($komen->unique('film.judul') as $item)
                            <li class="block px-4 py-2 hover:bg-green-600 rounded-lg cursor-pointer">{{ $item->film->judul }}</li>
                        @endforeach

                    </ul>
                </div>
            </div>
        </div>


        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm rtl:text-right text-gray-500 dark:text-black text-center">
                <thead class="text-xs uppercase dark:bg-blue-200 dark:text-black text-center">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-center border-r dark:border-gray-400">
                            Judul
                        </th>
                        <th scope="col" class="px-6 py-3 text-center border-r dark:border-gray-400">
                            Nama
                        </th>
                        <th scope="col" class="px-6 py-3 text-center border-r dark:border-gray-400">
                            Comment
                        </th>
                        <th scope="col" class="px-6 py-3 text-center border-r dark:border-gray-400">
                            Rating
                        </th>
                        <th scope="col" class="px-6 py-3 border-r dark:border-gray-400"><span class="sr-only">Edit</span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($komen as $item)
                        <tr class="border-b dark:border-gray-400">
                            <td class="px-6 py-3 text-center border-r dark:border-gray-400">{{ $item->film->judul }}</td>
                            <td class="px-6 py-3 text-center border-r dark:border-gray-400">{{ $item->user->name }}</td>
                            <td class="px-6 py-3 text-center border-r dark:border-gray-400">{{ $item->comment }}</td>
                            <td class="px-6 py-3 text-center border-r dark:border-gray-400">

                                @php $ratings = $ratings->first(); @endphp
                                @if ($ratings)
                                    <p class="text-yellow-400">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <i class="{{ $i <= $ratings->rating ? 'fas fa-star' : 'far fa-star' }}"></i>
                                        @endfor
                                    </p>
                                @endif


                            </td>
                            <td class="px-2 py-4 flex justify-center items-center gap-3 border-r dark:border-gray-400">
                                <form id="delete-form-{{ $item->id_comments }}"
                                    action="{{ route('admin.hapus-komen', $item->id_comments) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button"
                                        class="text-white bg-red-600 flex justify-center hover:bg-red-700 py-1 h-8 rounded w-14 delete-btn"
                                        data-id="{{ $item->id_comments }}">
                                        <img src="https://cdn-icons-png.flaticon.com/128/542/542724.png" alt=""
                                            class="w-5 h-5 filter invert">
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>


        </div>
    @endsection
    <script>
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

        // Notifikasi sukses atau error dari session
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Sukses!',
                text: "{{ session('success') }}",
                timer: 1000,
                showConfirmButton: false
            });
        @elseif (session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: "{{ session('error') }}",
                timer: 1000,
                showConfirmButton: false
            });
        @endif


        //seacrh
        document.addEventListener("DOMContentLoaded", function() {
            const searchInput = document.getElementById("search");
            const tableRows = document.querySelectorAll("tbody tr");

            searchInput.addEventListener("input", function() {
                const searchQuery = searchInput.value.toLowerCase().trim();
                tableRows.forEach(row => {
                    const rowText = Array.from(row.querySelectorAll("td")).map(cell => cell
                        .textContent.trim().toLowerCase()).join(" ");
                    row.style.display = rowText.includes(searchQuery) ? "" : "none";
                });
            });
            //dropdown
            const dropdownButton = document.getElementById("dropdownButton");
            const dropdownMenu = document.getElementById("dropdownMenu");

            dropdownButton.addEventListener("click", function() {
                dropdownMenu.classList.toggle("hidden");
            });

            document.addEventListener("click", function(event) {
                if (!dropdownButton.contains(event.target) && !dropdownMenu.contains(event.target)) {
                    dropdownMenu.classList.add("hidden");
                }
            });
        });
        //filter dropdown table
        document.addEventListener("DOMContentLoaded", function() {
            const dropdownItems = document.querySelectorAll("#dropdownMenu li");
            const tableRows = document.querySelectorAll("table tbody tr");

            dropdownItems.forEach(item => {
                item.addEventListener("click", function() {
                    const selectedTitle = this.textContent.trim();

                    tableRows.forEach(row => {
                        const titleCell = row.querySelector("td:first-child");
                        if (titleCell) {
                            const rowTitle = titleCell.textContent.trim();
                            if (selectedTitle === "Semua" || rowTitle === selectedTitle) {
                                row.style.display = "table-row";
                            } else {
                                row.style.display = "none";
                            }
                        }
                    });
                });
            });
        });
    </script>
</body>

</html>

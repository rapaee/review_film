<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
    <script src="https://cdn.tailwindcss.com"></script>
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
                    <svg width="30" height="30" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                        class="stroke-current text-blue-800 dark:text-gray-800 transform transition-transform duration-500 ease-in-out">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                    </svg>
                </div>
                <div class="text-right">
                    <p class="text-2xl">$11,257</p>
                    <p>Sales</p>
                </div>
            </div>
            <div
                class="bg-red-700 dark:bg-gray-800 shadow-lg rounded-md flex items-center justify-between p-3 border-b-4 border-gray-900 dark:border-gray-600 text-white font-medium group">
                <div
                    class="flex justify-center items-center w-14 h-14 bg-white rounded-full transition-all duration-300 transform group-hover:rotate-12">
                    <svg width="30" height="30" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                        class="stroke-current text-blue-800 dark:text-gray-800 transform transition-transform duration-500 ease-in-out">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                        </path>
                    </svg>
                </div>
                <div class="text-right">
                    <p class="text-2xl">$75,257</p>
                    <p>Balances</p>
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
                <button id="dropdownButton" class="bg-blue-700 text-white px-5 py-2.5 rounded-lg flex items-center">
                    Filter <svg class="w-2.5 h-2.5 ml-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 10 6"
                        fill="none">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 4 4 4-4" />
                    </svg>
                </button>

                <div id="dropdownMenu" class="hidden absolute bg-white shadow-md rounded-lg mt-2 w-44 left-0 z-10">
                    <ul class="py-2 text-sm text-gray-700">
                        <li class="block px-4 py-2 hover:bg-gray-100 cursor-pointer">Semua</li>
                        @foreach ($komen->unique('film.judul') as $item)
                            <li class="block px-4 py-2 hover:bg-gray-100 cursor-pointer">{{ $item->film->judul }}</li>
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
                        </tr>
                    @endforeach
                </tbody>
            </table>


        </div>
    @endsection
    <script>
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

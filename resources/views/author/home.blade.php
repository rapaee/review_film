<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        ::-webkit-scrollbar {
            display: none;
        }

        html {
            scrollbar-width: none;
        }
    </style>
</head>

<body>
    @extends('navbar-admin.navbar')
    @section('navbar-admin')
        <h1 class="text-2xl font-bold uppercase text-center my-4">
            Selamat Datang {{ Auth::user()->name }} di Paee Films
        </h1>

        <div class="flex justify-between items-center px-4 relative">
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

        <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-4">
            <table class="w-full text-sm text-gray-500 text-center">
                <thead class="bg-blue-200 text-black">
                    <tr>
                        <th class="px-6 py-3 border-r">Judul</th>
                        <th class="px-6 py-3 border-r">Nama</th>
                        <th class="px-6 py-3 border-r">Comment</th>
                        <th class="px-6 py-3 border-r">Rating</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($komen as $item)
                        <tr class="border-b">
                            <td class="px-6 py-3 border-r">{{ $item->film->judul }}</td>
                            <td class="px-6 py-3 border-r">{{ $item->user->name }}</td>
                            <td class="px-6 py-3 border-r">{{ $item->comment }}</td>
                            <td class="px-6 py-3 border-r">
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

<nav class="bg-white border-gray-200 dark:bg-[#17153B] w-full fixed z-50 top-0">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
        <!-- Logo -->
        <a href="{{ route('anonymous.home') }}" class="flex items-center space-x-3 rtl:space-x-reverse">
            <img src="https://cdn-icons-png.flaticon.com/128/1146/1146203.png" 
                 alt="" class="w-8 h-8 filter invert md:block">
            <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white hidden md:block">
                Paee Films
            </span>
        </a>

        <!-- Search & Buttons -->
        <div class="flex md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse gap-4">
            <form class="max-w-md mx-auto">
                
                <div class="relative">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-2 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                        </svg>
                    </div>
                    <input type="search" id="default-search" 
                           class="block w-full p-3 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" 
                           placeholder="Cari judul film ..." 
                           required>
                </div>
            </form>

            <a href="{{ route('login') }}">
                <button type="button" 
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-3 dark:bg-blue-600 dark:hover:bg-blue-700">
                    Login
                </button>
            </a>
        </div>
    </div>
    
    <div id="navbar" class="bg-[#1d1353] flex flex-wrap justify-center md:justify-normal">
        <!-- Dropdown 1 -->
        <div class="relative ml-0 md:ml-32">
            <button id="dropdownDelayButton" class="text-white0 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 inline-flex items-center dark:hover:bg-[#413778] text-white gap-2">
                <img src="https://cdn-icons-png.flaticon.com/128/974/974476.png" alt="" class="w-5 h-5 filter invert">
                <span>Genre</span>
                <img src="https://cdn-icons-png.flaticon.com/128/2722/2722987.png" alt="" class="w-3 h-3 filter invert">
            </button>
    
            <!-- Dropdown menu -->
            <div id="dropdownDelay" class="absolute w-64 bg-white divide-y divide-gray-100 rounded-lg shadow-lg hidden z-40 dark:bg-[#413778]">
                <ul class="grid grid-cols-2 gap-2 p-2 text-sm text-gray-700 dark:text-gray-200">
                    @foreach ($genre as $g)
                    <li>
                        <a href="{{ route('anonymous.film-genre', ['id' => $g->id_genre]) }}" 
                           class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-[#2E236C]">
                           {{ $g->title }}
                        </a>
                    </li>
                @endforeach
                </ul>
            </div>
        </div>
    
        <!-- Dropdown 2 -->
        <div class="relative">
            <button id="dropdownDelayButton2" class="text-white0 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 inline-flex items-center dark:hover:bg-[#413778] text-white gap-2">
                <img src="https://cdn-icons-png.flaticon.com/128/535/535234.png" alt="" class="w-5 h-5 filter invert">
                <span>Paee</span>
                <img src="https://cdn-icons-png.flaticon.com/128/2722/2722987.png" alt="" class="w-3 h-3 filter invert">
            </button>
    
            <!-- Dropdown menu -->
            <div id="dropdownDelay2" class="absolute md:-ml-0 w-48 bg-white divide-y divide-gray-100 rounded-lg shadow-lg hidden z-40 dark:bg-[#413778]">
                <ul class="flex gap-2 p-2 text-sm text-gray-700 dark:text-gray-200">
                    <li><a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-[#2E236C]">Terbaru</a></li>
                    <li><a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-[#2E236C]">Popular</a></li>
                </ul>
            </div>
        </div>
    
        <!-- Dropdown 3 -->
        <div class="relative">
            <button id="dropdownDelayButton3" class="text-white0 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 inline-flex items-center dark:hover:bg-[#413778] text-white gap-2">
                <img src="https://cdn-icons-png.flaticon.com/128/2370/2370264.png" alt="" class="w-5 h-5 filter invert">
                <span>Tahun</span>
                <img src="https://cdn-icons-png.flaticon.com/128/2722/2722987.png" alt="" class="w-3 h-3 filter invert">
            </button>
    
            <!-- Dropdown menu -->
            <div id="dropdownDelay3" class="absolute -ml-[75px] md:-ml-0 w-48 bg-white divide-y divide-gray-100 rounded-lg shadow-lg hidden z-40 dark:bg-[#413778]">
                <ul class="flex gap-2 p-2 text-sm text-gray-700 dark:text-gray-200">
                    <li><a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-[#2E236C]">Terbaru</a></li>
                    <li><a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-[#2E236C]">Popular</a></li>
                </ul>
            </div>
        </div>
    </div>
    
    
</nav>

<script>
document.addEventListener('DOMContentLoaded', () => {
    // Fungsi untuk menangani dropdown
    const handleDropdown = (dropdownButtonId, dropdownMenuId) => {
        const dropdownButton = document.getElementById(dropdownButtonId);
        const dropdownMenu = document.getElementById(dropdownMenuId);

        dropdownButton.addEventListener('mouseenter', () => {
            dropdownMenu.classList.remove('hidden');
        });

        dropdownButton.addEventListener('mouseleave', () => {
            setTimeout(() => {
                if (!dropdownMenu.matches(':hover')) {
                    dropdownMenu.classList.add('hidden');
                }
            }, 0.5); // Ganti angka ini untuk mengatur delay
        });

        dropdownMenu.addEventListener('mouseleave', () => {
            dropdownMenu.classList.add('hidden');
        });

        dropdownMenu.addEventListener('mouseenter', () => {
            dropdownMenu.classList.remove('hidden');
        });
    };

    // Panggil fungsi handleDropdown untuk masing-masing ID dropdown
    handleDropdown('dropdownDelayButton', 'dropdownDelay');
    handleDropdown('dropdownDelayButton2', 'dropdownDelay2');
    handleDropdown('dropdownDelayButton3', 'dropdownDelay3');
});

</script>

     <div class="">
      @yield('navbar-guest')
  </div>
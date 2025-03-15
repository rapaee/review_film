<style>
    #dropdown-user {
        position: absolute;
        top: 100%;
        right: 0;
        min-width: 200px;
        z-index: 50;
    }
</style>
<nav class="bg-[#17153B] border-gray-200 w-full fixed z-50 top-0">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
        <!-- Logo -->
        <a href="{{ route('anonymous.home') }}" class="flex items-center space-x-3 rtl:space-x-reverse">
            <img src="https://cdn-icons-png.flaticon.com/128/1146/1146203.png" alt=""
                class="w-8 h-8 filter invert md:block">
            <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white hidden md:block">
                Paee Films
            </span>
        </a>

        <!-- Search & Buttons -->
        <div class="flex md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse gap-4">
            <form class="max-w-md mx-auto" action="{{ route('search') }}" method="GET">
                <div class="relative">
                    <input type="search" id="default-search" name="search" value="{{ request('search') }}"
                        class="block w-[230px] md:w-[400px] p-3 ps-2 md:ps-5 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white focus:outline-none"
                        placeholder="Cari judul film" autocomplete="off" required>
                    <button type="submit"
                        class="absolute inset-y-0 end-0 flex items-center justify-center bg-blue-600 hover:bg-blue-700 rounded-r-md text-white dark:text-gray-400 p-3 md:p-5">
                        <svg class="w-4 h-4 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                        </svg>
                    </button>


                </div>
            </form>



            @guest
                <a href="{{ route('login') }}">
                    <button type="button"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-3 dark:bg-blue-600 dark:hover:bg-blue-700">
                        Login
                    </button>
                </a>
            @endguest

            @auth
                <div class="flex items-center ms-3">
                    <div>
                        <button type="button"
                            class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600 
                        {{ request()->routeIs('profile.edit') ? '-mt-5' : '' }}"
                            aria-expanded="false" data-dropdown-toggle="dropdown-user">
                            <span class="sr-only">Open user menu</span>
                            <img class="w-9 h-9 rounded-full object-cover"
                                src="{{ Auth::user()->photo ? asset('storage/photos/' . Auth::user()->photo) : 'https://cdn-icons-png.flaticon.com/128/149/149071.png' }}"
                                alt="user photo">
                        </button>

                    </div>
                    <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded shadow dark:bg-gray-700 dark:divide-gray-600"
                        id="dropdown-user">
                        <div class="px-4 py-3" role="none">
                            <p class="text-sm text-gray-900 dark:text-white" role="none">
                                {{ Auth::user()->name }}
                            </p>
                            <p class="text-sm font-medium text-gray-900 truncate dark:text-gray-300" role="none">
                                {{ Auth::user()->email }}
                            </p>
                        </div>
                        <ul class="py-1" role="none">
                            @if (Auth::user()->role === 'admin')
                                <a href="{{ route('admin.home') }}">
                                    <li
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white">
                                        Admin</li>
                                </a>
                            @endif
                            @if (Auth::user()->role === 'author')
                                <a href="{{ route('author.home') }}">
                                    <li
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white">
                                        Film</li>
                                </a>
                            @endif

                            <a href="{{ route('profile.edit') }}">
                                <li
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white">
                                    Profile</li>
                            </a>
                            <li class="cursor-pointer">
                                <form id="logout-form" method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="button"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white"
                                        onclick="confirmLogout()">
                                        Log out
                                    </button>
                                </form>
                            </li>

                            <!-- Tambahkan SweetAlert -->
                            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                            <script>
                                function confirmLogout() {
                                    Swal.fire({
                                        title: "Apakah Anda yakin ingin logout?",
                                        text: "Anda harus login kembali untuk mengakses sistem!",
                                        icon: "warning",
                                        showCancelButton: true,
                                        confirmButtonColor: "#d33",
                                        cancelButtonColor: "#3085d6",
                                        confirmButtonText: "Ya, Logout!",
                                        cancelButtonText: "Batal"
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            document.getElementById("logout-form").submit();
                                        }
                                    });
                                }
                            </script>

                        </ul>
                    </div>
                </div>
            @endauth

        </div>
    </div>

    @if (Route::currentRouteName() !== 'profile.edit')
        <div id="navbar" class="bg-[#1d1353] flex flex-wrap justify-center md:justify-normal">
            <!-- Dropdown 1 -->
            <div class="relative ml-0 md:ml-32">
                <button id="dropdownDelayButton"
                    class="text-white0 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 inline-flex items-center dark:hover:bg-[#413778] text-white gap-2">
                    <img src="https://cdn-icons-png.flaticon.com/128/974/974476.png" alt=""
                        class="w-5 h-5 filter invert">
                    <span>Genre</span>
                    <img src="https://cdn-icons-png.flaticon.com/128/2722/2722987.png" alt=""
                        class="w-3 h-3 filter invert">
                </button>

                <!-- Dropdown menu -->
                <div id="dropdownDelay"
                    class="absolute w-64 bg-white divide-y divide-gray-100 rounded-lg shadow-lg hidden z-40 dark:bg-[#413778]">
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

            <!-- Dropdown 3 -->
            <div class="relative">
                <button id="dropdownDelayButton3"
                    class="text-white0 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 inline-flex items-center dark:hover:bg-[#413778] text-white gap-2">
                    <img src="https://cdn-icons-png.flaticon.com/128/2370/2370264.png" alt=""
                        class="w-5 h-5 filter invert">
                    <span>Tahun</span>
                    <img src="https://cdn-icons-png.flaticon.com/128/2722/2722987.png" alt=""
                        class="w-3 h-3 filter invert">
                </button>

                <!-- Dropdown menu -->
                <div id="dropdownDelay3"
                    class="absolute -ml-[75px] md:-ml-0 w-48 bg-white divide-y divide-gray-100 rounded-lg shadow-lg hidden z-40 dark:bg-[#413778]">
                    <ul class="grid grid-cols-2 gap-2 p-2 text-sm text-gray-700 dark:text-gray-200">
                        @foreach ($dataFilm->unique('tahun_rilis') as $d)
                            <li>
                                <a href="{{ route('anonymous.tahun-rilis', $d->tahun_rilis) }}"
                                    class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-[#2E236C]">
                                    {{ $d->tahun_rilis }}
                                </a>
                            </li>
                        @endforeach

                    </ul>
                </div>
            </div>
        </div>
    @endif



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
        handleDropdown('dropdownDelayButton3', 'dropdownDelay3');
    });

    //open profile
    document.addEventListener('DOMContentLoaded', function() {
        const button = document.querySelector('[data-dropdown-toggle="dropdown-user"]');
        const dropdown = document.getElementById('dropdown-user');

        button.addEventListener('click', function() {
            dropdown.classList.toggle('hidden');
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', function(event) {
            if (!button.contains(event.target) && !dropdown.contains(event.target)) {
                dropdown.classList.add('hidden');
            }
        });
    });
</script>

<div class="">
    @yield('navbar-guest')
</div>

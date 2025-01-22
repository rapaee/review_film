<nav class="bg-white border-gray-200 dark:bg-[#17153B] w-full fixed z-50">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
        <!-- Logo and Text -->
        <a href="https://flowbite.com/" class="flex items-center space-x-3 rtl:space-x-reverse">
            <img src="https://cdn-icons-png.flaticon.com/128/1146/1146203.png" 
                 alt="" 
                 class="w-8 h-8 filter invert hidden md:block"> <!-- Hidden on small screens -->
            <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white hidden md:block">
                Review Film
            </span> <!-- Hidden on small screens -->
        </a>
        
        <div class="flex md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse gap-4">
            <!-- Search Form -->
            <form class="max-w-md mx-auto">
                <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">
                    Search
                </label>
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
  
            <!-- Buttons -->
            <a href="{{ route('login') }}">
            <button type="button" 
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-3 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Login
            </button>
            </a>

            <button data-collapse-toggle="navbar-cta" type="button" 
                    class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" 
                    aria-controls="navbar-cta" 
                    aria-expanded="false">
                <span class="sr-only">Open main menu</span>
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
                </svg>
            </button>
        </div>
        
        <!-- Navbar Links -->
        <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-cta">
            <ul class="flex flex-col font-medium p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-[#17153B] dark:border-gray-700">
                <li>
                    <a href="{{ route('anonymous.home') }}" class="block py-2 px-3 md:p-0 text-white bg-blue-700 rounded md:bg-transparent {{ Route::currentRouteName() == 'anonymous.home' ? 'md:text-blue-700, md:dark:text-blue-500' : '' }}" aria-current="page">Home</a>
                </li>
                <li>
                    <a href="" class="block py-2 px-3 md:p-0 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:dark:hover:text-blue-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700 {{ Route::currentRouteName() == 'subcriber.film' ? 'md:text-blue-700, md:dark:text-blue-500' : '' }}">Film</a>
                </li>
                <li>
                    <a href="#" class="block py-2 px-3 md:p-0 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:dark:hover:text-blue-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Bookmark</a>
                </li>
            </ul>
        </div>
    </div>
    
  </nav>
 


  
    
    <script>
      document.addEventListener('DOMContentLoaded', () => {
      const toggleButton = document.querySelector('[data-collapse-toggle="navbar-cta"]');
      const navbar = document.getElementById('navbar-cta');
  
      if (toggleButton && navbar) {
          toggleButton.addEventListener('click', () => {
              navbar.classList.toggle('hidden');
          });
      }
  });
  
    </script>
     <div class="">
      @yield('navbar-guest')
  </div>

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
<nav class="fixed top-0 z-50 w-full bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">
  <div class="px-3 py-3 lg:px-5 lg:pl-3">
    <div class="flex items-center justify-between">
      <div class="flex items-center justify-start rtl:justify-end">
        <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar" type="button" class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
            <span class="sr-only">Open sidebar</span>
            <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
               <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
            </svg>
         </button>
        <a href="#" class="flex ms-2 md:me-24">
          <span class="self-center text-xl font-semibold sm:text-2xl whitespace-nowrap dark:text-white">Admin RF</span>
        </a>
      </div>
      <div class="flex items-center">
        <div class="relative flex items-center ms-3">
          <div>
            <button type="button" class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600" 
                    aria-expanded="false" data-dropdown-toggle="dropdown-user">
              <span class="sr-only">Open user menu</span>
              <img class="w-8 h-8 rounded-full" src="https://flowbite.com/docs/images/people/profile-picture-5.jpg" alt="user photo">
            </button>
          </div>
          <div class="absolute right-0 mt-80 z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded shadow 
                      dark:bg-gray-700 dark:divide-gray-600" id="dropdown-user">
            <div class="px-4 py-3" role="none">
              <p class="text-sm text-gray-900 dark:text-white" role="none">{{ Auth::user()->name }}</p>
              <p class="text-sm font-medium text-gray-900 truncate dark:text-gray-300" role="none">{{ Auth::user()->email }}</p>
            </div>
            <ul class="py-1" role="none">
              <li>
                <a href="{{ route('anonymous.home') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem">Dashboard</a>
              </li>
              <li>
                <form method="POST" action="{{ route('logout') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white cursor-pointer" onclick="this.closest('form').submit();">
                  @csrf
                  
                  <span>Log out</span>
              </form>
              </li>
            </ul>
          </div>
        </div>
        
        </div>
    </div>
  </div>
</nav>

<aside id="logo-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700" aria-label="Sidebar">
   <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">
      <ul class="space-y-2 font-medium">
         <li>
          <a href="{{ route('admin.home') }}" class="flex items-center w-56 p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group  {{ request()->routeIs('admin.home') ? 'bg-gray-700 text-white' : '' }}">
            <div class="flex items-center">
                <img src="https://cdn-icons-png.flaticon.com/128/617/617333.png" alt="Icon" class="w-5 h-5 filter invert">
                <span class="ms-3 text-white">Dashboard</span>
            </div>                
         </a>
         </li>
         <li>
          <a href="{{ route('admin.user') }}" class="flex items-center w-56 p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group  {{ request()->routeIs('admin.user') ? 'bg-gray-700 text-white' : '' }}">
            <div class="flex items-center">
                <img src="https://cdn-icons-png.flaticon.com/128/1077/1077114.png" alt="" class="w-5 h-5 filter invert">
                <span class="ms-3 text-white">User</span>
            </div>                
         </a>
         </li>
         <li>
          <a href="{{ route('admin.film') }}" class="flex items-center w-56 p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group  {{ request()->routeIs('admin.film') ? 'bg-gray-700 text-white' : '' }}">
            <div class="flex items-center">
                <img src="https://cdn-icons-png.flaticon.com/128/1101/1101793.png" alt="Icon" class="w-5 h-5 filter invert">
                <span class="ms-3 text-white">Film</span>
            </div>                
         </a>
         </li>
         <li>
          <a href="{{ route('admin.genre') }}" class="flex items-center w-56 p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group  {{ request()->routeIs('admin.genre') ? 'bg-gray-700 text-white' : '' }}">
            <div class="flex items-center">
                <img src="https://cdn-icons-png.flaticon.com/128/11017/11017465.png" alt="Icon" class="w-5 h-5 filter invert">
                <span class="ms-3 text-white">Genre</span>
            </div>                
         </a>
         </li>
         <li>
          <a href="{{ route('admin.genre-relasi') }}" class="flex items-center w-56 p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group  {{ request()->routeIs('admin.genre-relasi') ? 'bg-gray-700 text-white' : '' }}">
            <div class="flex items-center">
                <img src="https://cdn-icons-png.flaticon.com/128/11017/11017465.png" alt="Icon" class="w-5 h-5 filter invert">
                <span class="ms-3 text-white">Genre Relasi</span>
            </div>                
         </a>
         </li>
         <li>
          <a href="{{ route('admin.castings') }}" class="flex items-center w-56 p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group  {{ request()->routeIs('admin.castings') ? 'bg-gray-700 text-white' : '' }}">
            <div class="flex items-center">
              <img src="https://cdn-icons-png.flaticon.com/128/2893/2893811.png" alt="" class="w-5 h-5 filter invert">
                <span class="ms-3 text-white">Castings</span>
            </div>                
         </a>
         </li>
         <li>
          <a href="{{ route('admin.banner') }}" class="flex items-center w-56 p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group  {{ request()->routeIs('admin.banner') ? 'bg-gray-700 text-white' : '' }}">
            <div class="flex items-center">
              <img src="  https://cdn-icons-png.flaticon.com/128/7320/7320184.png" alt="" class="w-5 h-5 filter invert">
                <span class="ms-3 text-white">Banner</span>
            </div>                
         </a>
         </li>
      </ul>
   </div>
</aside>
<script>
  document.addEventListener('DOMContentLoaded', () => {
  const dropdownButton = document.querySelector('[data-dropdown-toggle="dropdown-user"]');
  const dropdownMenu = document.getElementById('dropdown-user');

  if (dropdownButton && dropdownMenu) {
    dropdownButton.addEventListener('click', () => {
      const isHidden = dropdownMenu.classList.contains('hidden');
      if (isHidden) {
        dropdownMenu.classList.remove('hidden'); // Tampilkan menu
      } else {
        dropdownMenu.classList.add('hidden'); // Sembunyikan menu
      }
    });

    // Tambahkan event untuk menutup dropdown saat klik di luar
    document.addEventListener('click', (event) => {
      if (!dropdownButton.contains(event.target) && !dropdownMenu.contains(event.target)) {
        dropdownMenu.classList.add('hidden');
      }
    });
  }
});

</script>
<div class="ml-64 mt-20">
  @yield('navbar-admin')
</div>

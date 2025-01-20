<style>
   #dropdown-user {
 position: absolute;
 top: 100%;
 right: 0;
 min-width: 200px;
 z-index: 50;
}

</style>
<nav class="bg-white border-gray-200 dark:bg-gray-900 relative z-50">
   <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
       <!-- Logo and Text -->
       <a href="https://flowbite.com/" class="flex items-center space-x-3 rtl:space-x-reverse">
           <img src="https://cdn-icons-png.flaticon.com/128/1146/1146203.png" 
                alt="" 
                class="w-8 h-8 filter invert hidden md:block"> <!-- Hidden on small screens -->
           <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white md:block">
               Admin RF
           </span> <!-- Hidden on small screens -->
       </a>
       
       <div class="flex md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse gap-4">
 
           <div class="flex items-center ms-3">
               <div>
                 <button type="button" class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600" aria-expanded="false" data-dropdown-toggle="dropdown-user">
                   <span class="sr-only">Open user menu</span>
                   <img class="w-8 h-8 rounded-full" src="https://cdn-icons-png.flaticon.com/128/5185/5185871.png" alt="user photo">
                 </button>
               </div>
               <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded shadow dark:bg-gray-700 dark:divide-gray-600" id="dropdown-user">
                 <div class="px-4 py-3" role="none">
                   <p class="text-sm text-gray-900 dark:text-white" role="none">
                     {{ Auth::user()->name }}
                   </p>
                   <p class="text-sm font-medium text-gray-900 truncate dark:text-gray-300" role="none">
                     {{ Auth::user()->email }}
                   </p>
                 </div>
                 <ul class="py-1" role="none">
                   <li>
                     <form method="POST" action="{{ route('logout') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white" onclick="this.closest('form').submit();">
                       @csrf
                       
                       <span>Log out</span>
                   </form>
                   </li>
                 </ul>
               </div>
             </div>

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
           <ul class="flex flex-col font-medium p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
               <li>
                   <a href="{{ route('admin.home') }}" class="block py-2 px-3 md:p-0 text-white rounded md:bg-transparent {{ Route::currentRouteName() == 'admin.home' ? 'md:text-blue-700 bg-blue-700' : '' }}" aria-current="page">Home</a>
               </li>
               <li>
                  <a href="{{ route('admin.film') }}" class="block py-2 px-3 md:p-0 text-white rounded md:bg-transparent {{ Route::currentRouteName() == 'admin.film' ? 'md:text-blue-700 bg-blue-700' : '' }}" aria-current="page">Film</a>
              </li>
              <li>
               <a href="{{ route('admin.genre') }}" class="block py-2 px-3 md:p-0 text-white rounded md:bg-transparent {{ Route::currentRouteName() == 'admin.genre' ? 'md:text-blue-700 bg-blue-700' : '' }}" aria-current="page">Genre</a>
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
    <div class="mt-5">
     @yield('navbar-admin')
 </div>
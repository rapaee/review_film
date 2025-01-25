<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $datafilm->judul }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    @extends('navbar-guest.navbar')
    @section('navbar-guest')
    <section class="bg-center w-full bg-no-repeat bg-cover mb-20 bg-[url('{{ asset('storage/' . $datafilm->poster) }}')] bg-gray-700 bg-blend-multiply">
        <div class="px-4 mx-auto max-w-screen-xl h-auto text-center py-24 lg:py-56">

            <div class="flex flex-col items-center md:flex-row -mt-0 md:-mt-20 md:max-w-9/12">
                <img class="object-cover w-full rounded-t-lg h-96 md:h-auto md:w-72 md:rounded-none md:rounded-s-lg" src="{{ asset('storage/' . $datafilm->poster) }}" alt="">
                <div class="flex flex-col justify-start p-4 md:p-10 leading-normal mt-0 md:mt-20">
                    <h5 class="mb-2 text-2xl font-bold text-left tracking-tight uppercase text-gray-900 dark:text-white">{{ $datafilm->judul }}</h5>
                    <p class="mb-3 font-normal text-center text-white md:text-gray-400 md:text-left">{{ $datafilm->deskripsi }}</p>

                   <div class="flex justify-center items-center md:justify-start">
                    <a href="{{ asset('storage/' . $datafilm->trailer) }}" target="_blank"" class="py-2.5 px-5 me-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-md w-40 border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                        Trailer
                    </a>
                    <hr style="  border: none; border-left: 2px solid gray; height: 50px;">
                    <p class=" ml-2 mb-3 font-normal text-left text-white md:text-gray-500">
                        @php
                            $hours = floor($datafilm->durasi / 60);
                            $minutes = $datafilm->durasi % 60;
                        @endphp
                        {{ $hours }} hours {{ $minutes }} minutes
                    </p>
                    
                   </div>
                </div>
                
                
            </div>

        </div>
    </section>


 <div>

    <div class="w-full mx-auto mt-10">
        <div class="bg-gray-100 p-6 rounded-lg shadow-lg">
            <h2 class="text-xl font-bold mb-4">Discussion (20)</h2>

            <form>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Rating</label>
                    <div class="flex items-center">
                        <input type="radio" id="star1" name="rating" value="1" class="hidden peer" required>
                        <label for="star1" class="cursor-pointer text-gray-400 peer-checked:text-yellow-500 text-3xl mx-1">★</label>
                        
                        <input type="radio" id="star2" name="rating" value="2" class="hidden peer">
                        <label for="star2" class="cursor-pointer text-gray-400 peer-checked:text-yellow-500 text-3xl mx-1">★</label>
                        
                        <input type="radio" id="star3" name="rating" value="3" class="hidden peer">
                        <label for="star3" class="cursor-pointer text-gray-400 peer-checked:text-yellow-500 text-3xl mx-1">★</label>
                        
                        <input type="radio" id="star4" name="rating" value="4" class="hidden peer">
                        <label for="star4" class="cursor-pointer text-gray-400 peer-checked:text-yellow-500 text-3xl mx-1">★</label>
                        
                        <input type="radio" id="star5" name="rating" value="5" class="hidden peer">
                        <label for="star5" class="cursor-pointer text-gray-400 peer-checked:text-yellow-500 text-3xl mx-1">★</label>
                    </div>
                </div>
                <div class="w-full mb-4 border border-gray-400 rounded-lg bg-gray-50 dark:bg-gray-200">
                    <div class="px-4 py-2 bg-white rounded-t-lg dark:bg-gray-200">
                        <label for="comment" class="sr-only">Your comment</label>
                        <textarea id="comment" rows="4" class="w-full px-0 text-sm text-gray-900 bg-white dark:bg-gray-200 dark:text-black dark:placeholder-gray-400" placeholder="Write a comment..." required ></textarea>
                    </div>
                    <div class="flex items-center justify-between px-3 py-2 border-t dark:border-gray-600">
                        <div class="flex ps-0 space-x-1 rtl:space-x-reverse sm:ps-2">
                            <button type="button" class="inline-flex justify-center items-center p-2 text-gray-500 rounded cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600">
                                <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 12 20">
                                     <path stroke="currentColor" stroke-linejoin="round" stroke-width="2" d="M1 6v8a5 5 0 1 0 10 0V4.5a3.5 3.5 0 1 0-7 0V13a2 2 0 0 0 4 0V6"/>
                                 </svg>
                                <span class="sr-only">Attach file</span>
                            </button>
                            <button type="button" class="inline-flex justify-center items-center p-2 text-gray-500 rounded cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600">
                                <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 20">
                                     <path d="M8 0a7.992 7.992 0 0 0-6.583 12.535 1 1 0 0 0 .12.183l.12.146c.112.145.227.285.326.4l5.245 6.374a1 1 0 0 0 1.545-.003l5.092-6.205c.206-.222.4-.455.578-.7l.127-.155a.934.934 0 0 0 .122-.192A8.001 8.001 0 0 0 8 0Zm0 11a3 3 0 1 1 0-6 3 3 0 0 1 0 6Z"/>
                                 </svg>
                                <span class="sr-only">Set location</span>
                            </button>
                            <button type="button" class="inline-flex justify-center items-center p-2 text-gray-500 rounded cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600">
                                <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
                                     <path d="M18 0H2a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2Zm-5.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm4.376 10.481A1 1 0 0 1 16 15H4a1 1 0 0 1-.895-1.447l3.5-7A1 1 0 0 1 7.468 6a.965.965 0 0 1 .9.5l2.775 4.757 1.546-1.887a1 1 0 0 1 1.618.1l2.541 4a1 1 0 0 1 .028 1.011Z"/>
                                 </svg>
                                <span class="sr-only">Upload image</span>
                            </button>
                        </div>
                        <a href="#" onclick="checkLogin(event)">
                            <button type="button" class="inline-flex items-center py-2.5 px-4 text-xs font-medium text-center text-white bg-blue-700 rounded-lg focus:ring-4 focus:ring-blue-200 dark:focus:ring-blue-900 hover:bg-blue-800">
                                Post comment
                            </button>
                        </a>
                        
                        <!-- Popup notifikasi -->
                        <div id="loginPopup" class="fixed top-0 left-0 right-0 bottom-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
                            <div class="bg-white p-4 rounded-lg shadow-lg">
                                <p class="text-sm text-gray-700">Anda harus login dulu untuk memposting komentar.</p>
                                <div class="mt-4 flex justify-end">
                                    <button onclick="closePopup()" class="px-4 py-2 text-white bg-blue-700 rounded-lg hover:bg-blue-800">
                                        OK
                                    </button>
                                </div>
                            </div>
                        </div>
                        
                        <script>
                            // Fungsi untuk memeriksa apakah pengguna login
                            function checkLogin(event) {
                                event.preventDefault(); // Mencegah tindakan default tombol
                                const isLoggedIn = false; // Ganti ini dengan logika cek login Anda
                        
                                if (!isLoggedIn) {
                                    document.getElementById('loginPopup').classList.remove('hidden'); // Tampilkan popup
                                } else {
                                    // Arahkan ke halaman tujuan jika sudah login
                                    window.location.href = '/post-comment';
                                }
                            }
                        
                            // Fungsi untuk menutup popup
                            function closePopup() {
                                document.getElementById('loginPopup').classList.add('hidden'); // Sembunyikan popup
                            }
                        </script>
                        
                    </div>
                </div>
             </form>

            <div class="space-y-6">
                <!-- Comment 1 -->
                <div class="bg-gray-300 p-4 rounded-lg">
                    <p class="font-bold">Michael Gough <span class="text-gray-400">Feb. 8, 2022</span></p>
                    <p>Very straight-to-point article. Really worth time reading. Thank you! But tools are just the instruments for the UX designers. The knowledge of the design tools are as important as the creation of the design strategy.</p>
                    <div class="flex items-center text-sm text-gray-400 mt-2">
                        <span class="mr-2">7 Likes</span>
                        <span class="cursor-pointer hover:text-blue-400">Reply</span>
                    </div>
                </div>

                <!-- Comment 2 -->
                <div class="bg-gray-300 p-4 rounded-lg">
                    <p class="font-bold">Jesa Loda <span class="text-gray-400">Feb. 12, 2022</span></p>
                    <p>Much appreciated! Glad you liked it 😊</p>
                    <div class="flex items-center text-sm text-gray-400 mt-2">
                        <span class="mr-2">3 Likes</span>
                        <span class="cursor-pointer hover:text-blue-400">Reply</span>
                    </div>
                </div>

                <!-- Comment 3 -->
                <div class="bg-gray-300 p-4 rounded-lg">
                    <p class="font-bold">Bonnie Green <span class="text-gray-400">Mar. 12, 2022</span></p>
                    <p>The article covers the essentials, challenges, myths and stages the UX designers should consider while creating the design strategy.</p>
                    <div class="flex items-center text-sm text-gray-400 mt-2">
                        <span class="mr-2">24 Likes</span>
                        <span class="cursor-pointer hover:text-blue-400">Reply</span>
                    </div>
                </div>

                <!-- Comment 4 -->
                <div class="bg-gray-300 p-4 rounded-lg">
                    <p class="font-bold">Helena Engels <span class="text-gray-400">Jan. 23, 2022</span></p>
                    <p>Thanks for sharing this. I do came from the Backend development and explored some of the tools to design my Side Projects.</p>
                    <div class="flex items-center text-sm text-gray-400 mt-2">
                        <span class="mr-2">19 Likes</span>
                        <span class="cursor-pointer hover:text-blue-400">Reply</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

 </div>
 
    
    @endsection
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $datafilm->judul }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x/dist/cdn.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .dropdown {
            position: relative;
            display: inline-block;
        }
        .dropdown-content {
            display: none;
            position: absolute;
            right: 0;
            background: white;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
            min-width: 120px;
            border-radius: 5px;
            padding: 10px;
        }
        .dropdown-content a {
            display: block;
            padding: 8px;
            text-decoration: none;
            color: black;
        }
        .dropdown-content a:hover {
            background: #ddd;
        }
        .show {
            display: block;
        }
    </style>
</head>
<body class="bg-gray-100">
    @extends('navbar-guest.navbar')
    @section('navbar-guest')
    <section class="bg-center w-full bg-no-repeat bg-cover mb-20 bg-[url('{{ asset('storage/' . $datafilm->poster) }}')] bg-gray-700 bg-blend-multiply">
        <div class="px-4 mx-auto max-w-screen-xl h-auto text-center py-24 lg:py-56">
            
            <div class="flex flex-col items-center md:flex-row -mt-0 md:-mt-20 md:max-w-9/12">
                <img class="object-cover w-full rounded-t-lg h-96 md:h-auto md:w-72 md:rounded-none md:rounded-s-lg" src="{{ asset('storage/' . $datafilm->poster) }}" alt="">
                <div class="flex flex-col justify-start p-4 md:p-10 leading-normal mt-0 md:mt-20">
                    <h5 class="mb-2 text-2xl font-bold text-left tracking-tight uppercase text-gray-900 dark:text-white">{{ $datafilm->judul }}</h5>
                    <p class="mb-2 font-normal text-center text-white md:text-white md:text-left">{{ $datafilm->deskripsi }}</p>
                    <div class="flex space-x-2 mb-2">
                        @foreach ($films as $film)
                        @php
                            $filteredComments = $film->comments->filter(function ($comment) {
                                return $comment->user->role === 'subcriber'; // Hanya hitung rating dari subscriber
                            });
                    
                            $averageRating = $filteredComments->avg('rating'); // Ambil rata-rata rating subscriber saja
                        @endphp
                    
                        <div class="film-rating">
                            <h3 class="text-lg font-semibold">{{ $film->title }}</h3>
                            @for ($i = 1; $i <= 5; $i++)
                                @if ($i <= floor($averageRating))
                                    <i class="star fas fa-star text-3xl text-yellow-400 pointer-events-none" data-value="{{ $i }}"></i>
                                @elseif ($i == ceil($averageRating) && fmod($averageRating, 1) >= 0.5)
                                    <i class="star fas fa-star-half-stroke text-3xl text-yellow-400 pointer-events-none" data-value="{{ $i }}"></i>
                                @else
                                    <i class="star fas fa-star text-3xl text-gray-400 pointer-events-none" data-value="{{ $i }}"></i>
                                @endif
                            @endfor
                        </div>
                    @endforeach
                    
                    

                    
                    </div>
                    
                   <div class="flex justify-center items-center md:justify-start">
                    
                    <div x-data="{ open: false }">
                        <!-- Tombol untuk membuka modal -->
                        <button @click="open = true" class="py-2.5 px-5 me-2 mb-2 text-sm font-medium text-white focus:outline-none bg-black rounded-md w-40 border border-gray-200 hover:bg-gray-900">
                            Lihat Trailer
                        </button>
                    
                        <!-- Modal Trailer -->
                        <div x-show="open" x-cloak class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
                            <div class="relative ml-52 rounded-lg w-[90%] md:w-[800px] flex flex-col items-center">
                                <!-- Tombol Close -->
                                <button @click="open = false; $refs.trailer.pause(); $refs.trailer.currentTime = 0;" class="absolute top-2 right-2 cursor-pointer text-gray-500 z-50 hover:text-gray-800">
                                    ✖
                                </button>
                    
                                <!-- Video Trailer -->
                                <video controls class="w-full rounded" x-ref="trailer">
                                    <source src="{{ asset('storage/' . $datafilm->trailer) }}" type="video/mp4">
                                    Browser tidak mendukung video.
                                </video>
                            </div>
                        </div>
                    </div>
                    
                    
                    <hr style="  border: none; border-left: 2px solid gray; height: 50px;">
                    <p class=" ml-2 mb-3 font-normal text-left text-white md:text-white">
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



    <div class="max-w-5xl mx-auto py-12 px-4">
        <h2 class="text-2xl font-bold mb-8">CAST & CREW</h2>
        <div class="grid grid-cols-3 gap-10">
            @foreach($casting as $cast)
            <div class="flex items-center space-x-4">
                {{-- <img class="w-16 h-16 rounded-full" src="{{ asset('storage/' . $cast->foto) }}" alt="{{ $cast->nama }}"> --}}
                <img src="https://cdn-icons-png.flaticon.com/128/3135/3135715.png" alt="" class="w-16 h-16 rounded-full">
                <div>
                    <p class="text-sm text-gray-400">Cast</p>
                    <p class="font-semibold">{{ $cast->nama_panggung }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    

 <div>
   {{-- Anonymous (Tampil jika belum login) --}}
@guest
<div class="w-full mx-auto mt-10">
    <div class="bg-white p-6 rounded-lg shadow-lg">
        <h2 class="text-xl font-bold mb-4">Komentar</h2>

        <form>
            <div class="mb-4 flex justify-center items-center">
                <div class="flex items-center">
                    <label for="rating">
                    <div id="rating-stars" class="flex space-x-2 mt-2">
                        <i class="star text-7xl cursor-pointer text-gray-400" data-value="1">★</i>
                        <i class="star text-7xl cursor-pointer text-gray-400" data-value="2">★</i>
                        <i class="star text-7xl cursor-pointer text-gray-400" data-value="3">★</i>
                        <i class="star text-7xl cursor-pointer text-gray-400" data-value="4">★</i>
                        <i class="star text-7xl cursor-pointer text-gray-400" data-value="5">★</i>
                    </div>
                    <input type="hidden" name="rating" id="rating">
                </div>
            </div>
            <div class="w-full mb-4 border border-gray-400 rounded-lg bg-gray-50 dark:bg-gray-200">
                <div class="px-4 py-2 bg-white rounded-t-lg dark:bg-gray-200">
                    <label for="comment" class="sr-only">Your comment</label>
                    <textarea id="comment" rows="4" class="w-full px-0 text-sm text-gray-900 bg-white dark:bg-gray-200 dark:text-black dark:placeholder-gray-400" placeholder="Write a comment..." required ></textarea>
                </div>
                <div class="flex items-center justify-between px-3 py-2 border-t dark:border-gray-600">
                    <a href="#" onclick="checkLogin(event)">
                        <button type="button" class="inline-flex items-center py-2.5 px-4 text-xs font-medium text-center text-white bg-blue-700 rounded-lg focus:ring-4 focus:ring-blue-200 dark:focus:ring-blue-900 hover:bg-blue-800">
                            Post comment
                        </button>
                    </a>
                    
                    <!-- Popup notifikasi -->
                    <div id="loginPopup" class="fixed top-0 left-0 right-0 bottom-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
                        <div class="bg-white p-4 rounded-lg shadow-lg">
                            <p class="text-sm text-gray-700">Anda harus login dulu untuk memposting komentar.</p>
                            <div class="mt-4 flex justify-end space-x-2">
                                <a href="/login" class="px-4 py-2 text-white bg-blue-700 rounded-lg hover:bg-blue-800">
                                    Login
                                </a>
                                <button id="closePopupBtn" class="px-4 py-2 text-white bg-gray-500 rounded-lg hover:bg-gray-600">
                                    Tutup
                                </button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
         </form>

        <div class="space-y-6">
            @foreach ($comment as $c)
            <div class="bg-gray-300 p-4 rounded-lg">
                <div class="flex justify-between">
                    <div class="flex gap-3">
                    <p class="font-bold">{{ $c->user->name }}</p>
                    @php
                        $rating = $c->rating; // Ambil rating dari database
                    @endphp

                    <p class="font-bold text-sm text-yellow-500">
                        @for ($i = 1; $i <= 5; $i++)
                            @if ($i <= $rating)
                                <i class="fas fa-star"></i> {{-- Bintang penuh --}}
                            @else
                                <i class="far fa-star"></i> {{-- Bintang kosong --}}
                            @endif
                        @endfor
                    </p>

                    </div>
                   
                  
                </div>
                <p>{{ $c->comment }}</p>
            </div>
            @endforeach
        </div>
    </div>
</div>
<script>
document.addEventListener("DOMContentLoaded", function() {
    const loginPopup = document.getElementById('loginPopup');
    const closePopupBtn = document.getElementById('closePopupBtn');

    function checkLogin(event) {
        event.preventDefault();
        loginPopup.classList.remove('hidden');
    }

    function closePopupAndReload() {
        loginPopup.classList.add('hidden');
        setTimeout(() => {
            location.reload();
white); // Beri jeda 100ms agar animasi berjalan sebelum reload
    }

    closePopupBtn.addEventListener('click', closePopupAndReload);
    window.checkLogin = checkLogin;
});
</script>

@endguest

{{-- Subscriber (Tampil jika sudah login) --}}
@auth
<div class="w-full mx-auto mt-10">
    <div class="bg-gray-100 p-6 rounded-lg shadow-lg">
        <h2 class="text-xl font-bold mb-4">Komentar</h2>

        @if (!$hasCommented)
        <form action="{{ route('subcriber.coment') }}" method="POST">
            @csrf
            <div class="flex justify-center items-center">
                <div class="mb-4">
                    <div class="flex items-center">
                        <div class="mt-4">
                            <label for="rating"></label>
                            <div id="rating-stars" class="flex space-x-2 mt-2">
                                <span class="star text-7xl cursor-pointer text-gray-400" data-value="1">★</span>
                                <span class="star text-7xl cursor-pointer text-gray-400" data-value="2">★</span>
                                <span class="star text-7xl cursor-pointer text-gray-400" data-value="3">★</span>
                                <span class="star text-7xl cursor-pointer text-gray-400" data-value="4">★</span>
                                <span class="star text-7xl cursor-pointer text-gray-400" data-value="5">★</span>
                            </div>
                            <input type="hidden" name="rating" id="rating" value="{{ old('rating') }}" required>
                        </div>
                    </div>
                </div>
            </div>
    
            <div class="w-full mb-4 border border-gray-400 rounded-lg bg-gray-50 dark:bg-gray-200">
                <div class="px-4 py-2 bg-white rounded-t-lg dark:bg-gray-200">
                    <label for="comment" class="sr-only">Your comment</label>
                    <textarea id="comment" name="comment" rows="4" class="w-full px-0 text-sm text-gray-900 bg-white dark:bg-gray-200 dark:text-black dark:placeholder-gray-400" placeholder="Write a comment..." required></textarea>
                </div>
                <div class="flex items-center justify-between px-3 py-2 border-t dark:border-gray-600">
                    <input type="hidden" name="id_film" value="{{ $datafilm->id_film }}">
                    <button type="submit" class="inline-flex items-center py-2.5 px-4 text-xs font-medium text-center text-white bg-blue-700 rounded-lg focus:ring-4 focus:ring-blue-200 dark:focus:ring-blue-900 hover:bg-blue-800">
                        Post comment
                    </button>
                </div>
            </div>
        </form>
    @else
        <p class="text-center text-gray-600 mb-4"></p>
    @endif
    
        <div class="space-y-6">
            @foreach ($comment as $c)
            <div class="bg-white p-4 rounded-lg">
                <div class="flex justify-between">
                    <div class="flex gap-3">
                        <p class="font-bold">{{ $c->user->name }}</p>
                        @php
                            $rating = $c->rating; // Ambil rating dari database
                        @endphp
    
                        <p class="font-bold text-sm text-yellow-500">
                            @for ($i = 1; $i <= 5; $i++)
                                @if ($i <= $rating)
                                    <i class="fas fa-star"></i> {{-- Bintang penuh --}}
                                @else
                                    <i class="far fa-star"></i> {{-- Bintang kosong --}}
                                @endif
                            @endfor
                        </p>
    
                        </div>
                        <div class="flex gap-3 items-center justify-center">
                            <p class="font-bold">{{ $c->created_at->diffForHumans()  }}</p>
                            <div class="dropdown">
                                @if ($c->id_user == auth()->id()) 
                                <i class="fas fa-ellipsis-v" onclick="toggleDropdown()"></i>
                                <div id="dropdownMenu" class="dropdown-content">
                                    <a href="#">Edit</a>
                                    <a href="#">
                                        <form action="{{ route('subcriber.comment.detail-film', $c->id_comments) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="cursor-pointer text-red-500 hover:text-red-700">
                                                Hapus
                                            </button>
                                        </form>
                                    </a>
                                </div>
                                @endif
                            </div>
                            
                            <script>
                                function toggleDropdown() {
                                    document.getElementById("dropdownMenu").classList.toggle("show");
                                }
                            
                                // Tutup dropdown jika klik di luar
                                window.onclick = function(event) {
                                    if (!event.target.matches('.fas')) {
                                        let dropdowns = document.getElementsByClassName("dropdown-content");
                                        for (let i = 0; i < dropdowns.length; i++) {
                                            let openDropdown = dropdowns[i];
                                            if (openDropdown.classList.contains('show')) {
                                                openDropdown.classList.remove('show');
                                            }
                                        }
                                    }
                                }
                            </script>
                        </div>
                </div>
                <div class="flex">
                    <p>{{ $c->comment }}</p>
                  
                   
                </div>
                <div class="flex items-center text-sm text-gray-400 mt-2">
                   
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endauth

 </div>
 
    
    @endsection
</body>
</html>
<script>
     document.addEventListener("DOMContentLoaded", function () {
            let stars = document.querySelectorAll(".star");
            let ratingInput = document.getElementById("rating");

            if (stars.length > 0) { // Pastikan elemen ada sebelum diproses
                stars.forEach(star => {
                    star.addEventListener("click", function () {
                        let rating = this.getAttribute("data-value");
                        ratingInput.value = rating;

                        stars.forEach(s => {
                            s.classList.toggle("text-yellow-400", s.getAttribute("data-value") <= rating);
                            s.classList.toggle("text-gray-400", s.getAttribute("data-value") > rating);
                        });
                    });
                });

                let savedRating = ratingInput.value;
                if (savedRating > 0) {
                    stars.forEach(s => {
                        s.classList.toggle("text-yellow-400", s.getAttribute("data-value") <= savedRating);
                        s.classList.toggle("text-gray-400", s.getAttribute("data-value") > savedRating);
                    });
                }
            }
        });
</script>

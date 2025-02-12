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
    <div class="bg-gray-100 p-6 rounded-lg shadow-lg">
        <h2 class="text-xl font-bold mb-4">Komentar</h2>

        <form>
            <div class="mb-4 flex justify-center items-center">
                <div class="flex items-center">
                    <label for="rating"/>
                    <div id="rating-stars" class="flex space-x-2 mt-2">
                        <span class="star text-7xl cursor-pointer text-gray-400" data-value="1">★</span>
                        <span class="star text-7xl cursor-pointer text-gray-400" data-value="2">★</span>
                        <span class="star text-7xl cursor-pointer text-gray-400" data-value="3">★</span>
                        <span class="star text-7xl cursor-pointer text-gray-400" data-value="4">★</span>
                        <span class="star text-7xl cursor-pointer text-gray-400" data-value="5">★</span>
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
                            <div class="mt-4 flex justify-end">
                                <button onclick="closePopup()" class="px-4 py-2 text-white bg-blue-700 rounded-lg hover:bg-blue-800">
                                    OK
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
                    <p class="font-bold">{{ $c->user->name }}</p>
                    <p class="font-bold">{{ \Carbon\Carbon::parse($c->created_at)->format('Y-m-d h:i A') }}</p>
                </div>
                <p>{{ $c->comment }}</p>
                <div class="flex items-center text-sm text-gray-400 mt-2">
                    <span class="cursor-pointer hover:text-blue-400">Reply</span>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endguest

{{-- Subscriber (Tampil jika sudah login) --}}
@auth
<div class="w-full mx-auto mt-10">
    <div class="bg-gray-100 p-6 rounded-lg shadow-lg">
        <h2 class="text-xl font-bold mb-4">Komentar</h2>

        <form action="{{ route('subcriber.coment') }}" method="POST">
            @csrf
            <div class="flex justify-center items-center">
                <div class="mb-4">
                    <div class="flex items-center">
                        <div class="mt-4">
                            <label for="rating" :value="('Rating')" />
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

        <div class="space-y-6">
            @foreach ($comment as $c)
            <div class="bg-gray-300 p-4 rounded-lg">
                <div class="flex justify-between">
                    <p class="font-bold">{{ $c->user->name }}</p>
                    <p class="font-bold">{{ \Carbon\Carbon::parse($c->created_at)->format('Y-m-d h:i A') }}</p>
                </div>
                <p>{{ $c->comment }}</p>
                <div class="flex items-center text-sm text-gray-400 mt-2">
                    <span class="cursor-pointer hover:text-blue-400">Reply</span>
                    @if ($c->id_user == auth()->id()) 
                        <form action="{{ route('subcriber.comment.detail-film', $c->id_comments) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="cursor-pointer text-red-500 hover:text-red-700 ml-2">
                                Hapus
                            </button>
                        </form>
                    @endif
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

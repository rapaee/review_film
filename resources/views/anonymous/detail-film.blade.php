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
        <section
            class="bg-center w-full bg-no-repeat bg-cover mb-20 bg-[url('{{ asset('storage/' . $datafilm->poster) }}')] bg-gray-700 bg-blend-multiply">
            <div class="px-4 mx-auto max-w-screen-xl h-auto text-center py-24 lg:py-56">

                <div class="flex flex-col items-center md:flex-row -mt-0 md:-mt-20 md:max-w-9/12">
                    <img class="object-cover w-full rounded-t-lg h-96 md:h-auto md:w-72 md:rounded-none md:rounded-s-lg"
                        src="{{ asset('storage/' . $datafilm->poster) }}" alt="">
                    <div class="flex flex-col justify-start p-4 md:p-10 leading-normal mt-0 md:mt-20">
                        <h5
                            class="mb-2 text-2xl font-bold text-left tracking-tight uppercase text-gray-900 dark:text-white">
                            {{ $datafilm->judul }}</h5>
                        <div class="flex items-center gap-2">
                            <i class="fas fa-video text-gray-400 text-2xl"></i>
                            <h5
                                class="mb-2 text-lg text-left mt-2 tracking-tight capitalize text-gray-900 dark:text-gray-400">
                                {{ $datafilm->pencipta }}</h5>

                        </div>
                        <div class="text-white flex gap-2 flex-wrap mb-2">
                            @foreach ($datafilm->genreRelations as $index => $relation)
                                <span
                                    class="px-2 py-1 rounded 
                                        {{ $loop->odd ? 'bg-blue-600' : 'bg-red-600' }}">
                                    {{ $relation->genre->title }}
                                </span>
                            @endforeach
                        </div>


                        <p class="mb-2 font-normal text-center text-white md:text-white md:text-left">
                            {{ $datafilm->deskripsi }}</p>

                        <div class="flex justify-center items-center md:justify-normal space-x-2 mb-2">
                            @foreach ($films as $film)
                                @php
                                    $filteredComments = $film->comments->filter(function ($comment) {
                                        return $comment->user->role === 'subcriber'; // Hanya hitung rating dari subscriber
                                    });

                                    $averageRating = $filteredComments->avg('rating'); // Ambil rata-rata rating subscriber saja
                                @endphp

                                <h3 class="text-lg font-semibold">{{ $film->title }}</h3>
                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= floor($averageRating))
                                        <i class="star fas fa-star text-3xl text-yellow-400 pointer-events-none"
                                            data-value="{{ $i }}"></i>
                                    @elseif ($i == ceil($averageRating) && fmod($averageRating, 1) >= 0.5)
                                        <i class="star fas fa-star-half-stroke text-3xl text-yellow-400 pointer-events-none"
                                            data-value="{{ $i }}"></i>
                                    @else
                                        <i class="star fas fa-star text-3xl text-gray-400 pointer-events-none"
                                            data-value="{{ $i }}"></i>
                                    @endif
                                @endfor
                            @endforeach

                            <p class="text-md mt-2 text-gray-300">
                                ( {{ $jumlahPengguna }} rates )
                            </p>



                        </div>

                        <div class="flex justify-center items-center md:justify-start">

                            <div x-data="{ open: false }">
                                <!-- Tombol untuk membuka modal -->
                                <button @click="open = true"
                                    class="py-2.5 px-5 me-2 mb-2 text-sm font-medium text-white focus:outline-none bg-black rounded-md w-40 border border-gray-200 hover:bg-gray-900">
                                    Lihat Trailer
                                </button>

                                <!-- Modal -->
                                <div x-show="open"
                                    class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
                                    <div
                                        class="relative ml-0 md:ml-52 rounded-lg w-[90%] md:w-[800px] flex flex-col items-center">
                                        <!-- Tombol Close -->
                                        <button @click="open = false; stopVideo()"
                                            class="absolute top-2 right-2 cursor-pointer text-gray-500 z-50 hover:text-gray-800">
                                            ✖
                                        </button>

                                        <!-- Video Trailer -->
                                        <iframe id="trailerVideo" width="100%" height="400"
                                            src="https://www.youtube.com/embed/{{ Str::afterLast($datafilm->trailer, '/') }}"
                                            frameborder="0" allowfullscreen class="w-full rounded">
                                        </iframe>
                                    </div>
                                </div>


                                <script>
                                    function stopVideo() {
                                        const iframe = document.getElementById('trailerVideo');
                                        if (iframe) {
                                            const iframeSrc = iframe.src;
                                            iframe.src = iframeSrc; // Menghentikan video dengan mengatur ulang src
                                        }
                                    }
                                </script>

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



        @if ($casting->isNotEmpty())
            <div class="max-w-full mx-auto py-12 bg-white px-4">
                <h2 class="text-2xl font-bold mb-8 text-center md:text-left md:ml-20">CAST</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-10">
                    @foreach ($casting as $cast)
                        <div class="flex items-start justify-center space-x-4 mx-auto md:ml-20">
                            <img src="https://cdn-icons-png.flaticon.com/128/3135/3135715.png" alt=""
                                class="w-16 h-16 rounded-full">
                            <div>
                                <p class="text-sm text-gray-400">Cast</p>
                                <p class="font-semibold">{{ $cast->casting->nama_panggung }}</p>
                                <p class="font-semibold"><span class="text-gray-400">Artis: </span> {{ $cast->casting->nama_asli }}
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif




        <div>
            {{-- Anonymous (Tampil jika belum login) --}}
            @guest
                <div class="w-full mx-auto mt-10">
                    <div class=" p-6 rounded-lg shadow-lg">
                        <h2 class="text-xl font-bold mb-4">Komentar</h2>

                        <form>
                            <div class="mb-4 flex justify-center items-center">
                                <div class="flex items-center">
                                    <label for="rating">
                                        <div id="rating-stars" class="flex space-x-2 mt-2">
                                            <i class="star text-7xl cursor-pointer text-blue-500" data-value="1">★</i>
                                            <i class="star text-7xl cursor-pointer text-blue-500" data-value="2">★</i>
                                            <i class="star text-7xl cursor-pointer text-blue-500" data-value="3">★</i>
                                            <i class="star text-7xl cursor-pointer text-blue-500" data-value="4">★</i>
                                            <i class="star text-7xl cursor-pointer text-blue-500" data-value="5">★</i>
                                        </div>
                                        <input type="hidden" name="rating" id="rating">
                                </div>
                            </div>
                            <div class="w-full mb-4 border border-gray-400 rounded-lg bg-white">
                                <div class="px-4 py-2 bg-white rounded-t-lg ">
                                    <label for="comment" class="sr-only">Your comment</label>
                                    <textarea id="comment" rows="4"
                                        class="w-full px-0 text-sm text-gray-900 bg-white dark:placeholder-gray-400"
                                        placeholder="Write a comment..." required></textarea>
                                </div>
                                <div class="flex items-center justify-between px-3 py-2 border-t dark:border-gray-600">
                                    <a href="#" onclick="checkLogin(event)">
                                        <button type="button"
                                            class="inline-flex items-center py-2.5 px-4 text-xs font-medium text-center text-white bg-blue-700 rounded-lg focus:ring-4 focus:ring-blue-200 dark:focus:ring-blue-900 hover:bg-blue-800">
                                            Post comment
                                        </button>
                                    </a>

                                    <!-- Popup notifikasi -->
                                    <div id="loginPopup"
                                        class="fixed top-0 left-0 right-0 bottom-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
                                        <div class="bg-white p-4 rounded-lg shadow-lg">
                                            <p class="text-sm text-gray-700">Anda harus login dulu untuk memposting komentar.
                                            </p>
                                            <div class="mt-4 flex justify-end space-x-2">
                                                <a href="/login"
                                                    class="px-4 py-2 text-white bg-blue-700 rounded-lg hover:bg-blue-800">
                                                    Login
                                                </a>
                                                <button id="closePopupBtn"
                                                    class="px-4 py-2 text-white bg-gray-500 rounded-lg hover:bg-gray-600">
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
                                <div class="bg-white p-4 rounded-lg">
                                    <div class="flex justify-between">
                                        <div class="flex gap-3">
                                            <p class="font-bold text-[12px] md:text-sm">{{ $c->user->name }}</p>

                                            @php
                                                $rating = $c->rating; // Ambil rating dari database
                                                $role = $c->user->role; // Ambil role dari user
                                            @endphp

                                            <p class="font-bold text-xs text-yellow-500">
                                                @if (isset($role) && $role === 'admin')
                                                    <p
                                                        class="text-[10px] md:text-sm -ml-4 text-red-500 items-center justify-center flex rounded-md">
                                                        Admin
                                                    </p>
                                                @elseif (isset($role) && $role === 'author')
                                                    <p
                                                        class="text-[10px] md:text-sm -ml-4 text-blue-500 items-center justify-center flex rounded-md">
                                                        Author
                                                    </p>
                                                @elseif (isset($rating) && is_numeric($rating))
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        @if ($i <= $rating)
                                                            <i class="fas fa-star text-yellow-400"></i> {{-- Bintang penuh --}}
                                                        @else
                                                            <i class="far fa-star text-gray-400"></i> {{-- Bintang kosong --}}
                                                        @endif
                                                    @endfor
                                                @endif

                                            </p>

                                        </div>
                                        <p class="text-[10px] font-bold">{{ $c->created_at->diffForHumans() }}</p>
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

                        // Pastikan elemen ditemukan sebelum menambahkan event listener
                        if (!loginPopup || !closePopupBtn) {
                            console.error("Elemen popup tidak ditemukan!");
                            return;
                        }

                        function checkLogin(event) {
                            event.preventDefault();
                            loginPopup.classList.remove('hidden'); // Tampilkan popup
                        }

                        function closePopupAndReload() {
                            loginPopup.classList.add('hidden'); // Sembunyikan popup
                            setTimeout(() => {
                                location.reload(); // Beri jeda sebelum reload
                            }, 100);
                        }

                        closePopupBtn.addEventListener('click', closePopupAndReload);
                        window.checkLogin = checkLogin; // Buat fungsi global agar bisa dipanggil dari luar
                    });
                </script>


            @endguest

            {{-- Subscriber (Tampil jika sudah login) --}}
            @auth
                <div class="w-full mx-auto mt-10">
                    <div class="bg-gray-100 p-6 rounded-lg shadow-lg">
                        <h2 class="text-xl font-bold mb-4">Komentar</h2>
                        @if (session('success'))
                            <div class="p-4 mb-4 text-sm text-green-800 bg-green-200 rounded-lg">
                                {{ session('success') }}
                            </div>
                        @endif
                        @if (!$hasCommented)
                            <form action="{{ route('subcriber.coment') }}" method="POST">
                                @csrf
                                <div class="flex justify-center items-center">
                                    <div class="mb-4">
                                        <div class="flex items-center">
                                            <div class="mt-4">
                                                <label for="rating"></label>
                                                <div id="rating-stars" class="flex space-x-2 mt-2">
                                                    <span class="star text-7xl cursor-pointer text-blue-500"
                                                        data-value="1">★</span>
                                                    <span class="star text-7xl cursor-pointer text-blue-500"
                                                        data-value="2">★</span>
                                                    <span class="star text-7xl cursor-pointer text-blue-500"
                                                        data-value="3">★</span>
                                                    <span class="star text-7xl cursor-pointer text-blue-500"
                                                        data-value="4">★</span>
                                                    <span class="star text-7xl cursor-pointer text-blue-500"
                                                        data-value="5">★</span>
                                                </div>
                                                <input type="hidden" name="rating" id="rating"
                                                    value="{{ old('rating') }}" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="w-full mb-4 border border-gray-400 rounded-lg bg-white">
                                    <div class="px-4 py-2 bg-white rounded-t-lg ">
                                        <label for="comment" class="sr-only">Your comment</label>
                                        <textarea id="comment" name="comment" rows="4"
                                            class="w-full px-0 text-sm text-gray-900 bg-white dark:text-black dark:placeholder-gray-400"
                                            placeholder="Write a comment..." required></textarea>
                                    </div>
                                    <div class="flex items-center justify-between px-3 py-2 border-t bg-white">
                                        <input type="hidden" name="id_film" value="{{ $datafilm->id_film }}">
                                        <button type="submit"
                                            class="inline-flex items-center py-2.5 px-4 text-xs font-medium text-center text-white bg-blue-700 rounded-lg focus:ring-4 focus:ring-blue-200 dark:focus:ring-blue-900 hover:bg-blue-800">
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
                                <div class="bg-white p-4 rounded-lg" id="comment-{{ $c->id_comments }}">
                                    <div class="flex justify-between">
                                        <div class="flex justify-center items-center gap-3">
                                            <p class="font-bold text-[12px] md:text-sm">{{ $c->user->name }}</p>

                                            @php
                                                $rating = $c->rating; // Ambil rating dari database
                                                $role = $c->user->role; // Ambil role dari user
                                            @endphp

                                            <p class="font-bold text-xs text-yellow-500">
                                                @if (isset($role) && $role === 'admin')
                                                    <p
                                                        class="text-[10px] md:text-sm -ml-4 text-red-500 items-center justify-center flex rounded-md">
                                                        Admin
                                                    </p>
                                                @elseif (isset($role) && $role === 'author')
                                                    <p
                                                        class="text-[10px] md:text-sm -ml-4 text-blue-500 items-center justify-center flex rounded-md">
                                                        Author
                                                    </p>
                                                @elseif (isset($rating) && is_numeric($rating))
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        @if ($i <= $rating)
                                                            <i class="fas fa-star text-yellow-400"></i> {{-- Bintang penuh --}}
                                                        @else
                                                            <i class="far fa-star text-gray-400"></i> {{-- Bintang kosong --}}
                                                        @endif
                                                    @endfor
                                                @endif

                                            </p>
                                        </div>
                                        <div class="flex gap-3 items-center justify-center">
                                            <p class="text-[10px] font-bold">{{ $c->created_at->diffForHumans() }}</p>
                                            <div class="dropdown">
                                                @if ($c->id_user == auth()->id() || auth()->user()->role == 'admin')
                                                    <i class="fas fa-ellipsis-v cursor-pointer"
                                                        onclick="toggleDropdown({{ $c->id_comments }})"></i>
                                                    <div id="dropdownMenu-{{ $c->id_comments }}"
                                                        class="dropdown-content bg-white p-2 rounded shadow-md w-20">
                                                        <div class="flex flex-col gap-2">
                                                            @if ($c->id_user == auth()->id())
                                                                <form
                                                                    action="{{ route('hapus-untuk-admin', $c->id_comments) }}"
                                                                    method="POST" class="w-full">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit"
                                                                        class="bg-white text-black px-4 py-2 rounded hover:bg-gray-200 w-full">
                                                                        Hapus
                                                                    </button>
                                                                </form>
                                                                <button onclick="showEditForm({{ $c->id_comments }})"
                                                                    class="bg-white text-black px-4 py-2 rounded hover:bg-gray-200">
                                                                    Edit
                                                                </button>
                                                            @endif
                                                            @if (auth()->user()->role == 'admin')
                                                                <form
                                                                    action="{{ route('hapus-untuk-admin', $c->id_comments) }}"
                                                                    method="POST" class="w-full">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit"
                                                                        class="bg-white text-black px-4 py-2 rounded hover:bg-gray-200 w-full">
                                                                        Hapus
                                                                    </button>
                                                                </form>
                                                            @endif
                                                        </div>
                                                    </div>
                                                @endif

                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex">
                                        <p>{{ $c->comment }}</p>
                                    </div>
                                    <!-- Form edit akan muncul di sini -->
                                    <div id="edit-form-{{ $c->id_comments }}" class="hidden w-full mt-4">

                                        <form action="{{ route('subcriber.comment.update', $c->id_comments) }}"
                                            method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="flex justify-center items-center">
                                                <div class="mb-4">
                                                    <div class="flex items-center">
                                                        <div class="mt-4">
                                                            <label for="rating"></label>
                                                            <div id="rating-stars-{{ $c->id_comments }}"
                                                                class="flex space-x-2 mt-2">
                                                                @for ($i = 1; $i <= 5; $i++)
                                                                    <span class="star text-7xl cursor-pointer text-blue-500"
                                                                        data-value="{{ $i }}"
                                                                        onclick="setRating({{ $i }}, {{ $c->id_comments }})">★</span>
                                                                @endfor
                                                            </div>
                                                            <input type="hidden" name="rating"
                                                                id="rating-{{ $c->id_comments }}"
                                                                value="{{ $c->rating }}" required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div
                                                class="w-full mb-4 border border-gray-400 rounded-lg bg-gray-50 dark:bg-gray-200">
                                                <div class="px-4 py-2 bg-white rounded-t-lg dark:bg-gray-200">
                                                    <label for="comment-{{ $c->id_comments }}" class="sr-only">Your
                                                        comment</label>
                                                    <textarea id="comment-{{ $c->id_comments }}" name="comment" rows="4"
                                                        class="w-full px-0 text-sm text-gray-900 bg-white dark:bg-gray-200 dark:text-black dark:placeholder-gray-400"
                                                        required>{{ $c->comment }}</textarea>
                                                </div>
                                                <div
                                                    class="flex items-center justify-between px-3 py-2 border-t dark:border-gray-600">
                                                    <input type="hidden" name="id_film" value="{{ $datafilm->id_film }}">
                                                    <button type="submit"
                                                        class="inline-flex items-center py-2.5 px-4 text-xs font-medium text-center text-white bg-blue-700 rounded-lg focus:ring-4 focus:ring-blue-200 dark:focus:ring-blue-900 hover:bg-blue-800">
                                                        Update comment
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                    </div>
                </div>
            @endauth

        </div>
    @endsection

    <script>
        // Fungsi untuk menampilkan dropdown
        function toggleDropdown(commentId) {
            document.getElementById("dropdownMenu-" + commentId).classList.toggle("show");
        }

        // Fungsi untuk menampilkan form edit
        function showEditForm(commentId) {
            // Sembunyikan semua form edit yang mungkin terbuka
            document.querySelectorAll('[id^="edit-form-"]').forEach(form => {
                form.classList.add('hidden');
            });

            // Tampilkan form edit yang dipilih
            const editForm = document.getElementById("edit-form-" + commentId);
            editForm.classList.remove('hidden');
        }

        // Fungsi untuk mengatur rating
        function setRating(rating, commentId) {
            document.getElementById("rating-" + commentId).value = rating;
            const stars = document.querySelectorAll("#rating-stars-" + commentId + " .star");
            stars.forEach((star, index) => {
                if (index < rating) {
                    star.classList.add('text-yellow-500');
                    star.classList.remove('text-blue-500');
                } else {
                    star.classList.remove('text-yellow-500');
                    star.classList.add('text-blue-500');
                }
            });
        }

        // Fungsi untuk menangani submit form edit
        function handleEditFormSubmit(event, commentId) {
            event.preventDefault(); // Mencegah reload halaman

            const form = event.target;
            const formData = new FormData(form);

            fetch(form.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Update tampilan komentar tanpa reload
                        const commentText = document.querySelector(`#comment-${commentId} p`);
                        const commentRating = document.querySelector(
                            `#comment-${commentId} .font-bold.text-sm.text-yellow-500`);

                        if (commentText && commentRating) {
                            commentText.textContent = formData.get('comment');
                            const newRating = formData.get('rating');
                            let starsHtml = '';
                            for (let i = 1; i <= 5; i++) {
                                if (i <= newRating) {
                                    starsHtml += '<i class="fas fa-star"></i>';
                                } else {
                                    starsHtml += '<i class="far fa-star"></i>';
                                }
                            }
                            commentRating.innerHTML = starsHtml;
                        }

                        // Sembunyikan form edit
                        document.getElementById("edit-form-" + commentId).classList.add('hidden');
                    } else {
                        alert('Gagal mengupdate komentar');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
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

        document.addEventListener("DOMContentLoaded", function() {
            let stars = document.querySelectorAll(".star");
            let ratingInput = document.getElementById("rating");

            if (stars.length > 0) { // Pastikan elemen ada sebelum diproses
                stars.forEach(star => {
                    star.addEventListener("click", function() {
                        let rating = this.getAttribute("data-value");
                        ratingInput.value = rating;

                        stars.forEach(s => {
                            s.classList.toggle("text-yellow-400", s.getAttribute(
                                "data-value") <= rating);
                            s.classList.toggle("text-blue-500", s.getAttribute(
                                "data-value") > rating);
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

</body>

</html>

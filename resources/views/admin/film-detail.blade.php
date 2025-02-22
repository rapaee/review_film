<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $datafilm->judul }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x/dist/cdn.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</head>

<body>
    @extends('navbar-admin.navbar')
    @section('navbar-admin')
        {{-- <section class="bg-center w-full bg-no-repeat bg-cover -mt-6 bg-[url('{{ asset('storage/' . $datafilm->poster) }}')] bg-gray-700 bg-blend-multiply"> --}}
        <a href="{{ route('admin.film') }}"
            class="flex items-center absolute border py-2 px-5 rounded-lg ml-5 hover:bg-gray-100">
            <img src="https://cdn-icons-png.flaticon.com/128/16026/16026444.png" alt="" class="w-6 h-6">
            <p>Kembali</p>
        </a>
        <div class="px-4 mx-auto max-w-screen-xl h-[500px] text-center py-24 lg:py-56">

            <div class="flex flex-col items-center md:flex-row -mt-0 md:-mt-36 md:max-w-9/12">
                <img class="object-cover w-full rounded-t-lg h-96 md:h-[350px] md:w-72 md:rounded-none md:rounded-s-lg"
                    src="{{ asset('storage/' . $datafilm->poster) }}" alt="">
                <div class="flex flex-col justify-start p-4 md:p-10 leading-normal">
                    <h5 class="mb-2 text-2xl font-bold text-left tracking-tight uppercase text-gray-900 dark:text-black">
                        {{ $datafilm->judul }}</h5>
                    <h5 class="text-md text-left tracking-tight uppercase text-gray-900 dark:text-black"> Pencipta :
                        {{ $datafilm->pencipta }}</h5>
                    {{-- <h5 class="text-md text-left tracking-tight uppercase text-gray-900 dark:text-black">( {{ $datafilm->kategori_umur }} )</h5> --}}
                    <h5 class="mb-2 text-md text-left tracking-tight uppercase text-gray-900 dark:text-black"> Tahun Rilis
                        ({{ $datafilm->tahun_rilis }}) ({{ $datafilm->kategori_umur }})</h5>

                    <div class="flex flex-col gap-2">
                        @if ($datafilm->castings->isNotEmpty())
                            @foreach ($datafilm->castings as $casting)
                                <div class="flex items-center gap-2">
                                    <h5 class="text-md tracking-tight uppercase text-gray-900 dark:text-black">
                                        Pemeran {{ $casting->nama_panggung }} ({{ $casting->nama_asli }})
                                    </h5>
                                    <a
                                        href="{{ route('admin.edit-castings-film-detail.edit', ['id' => $casting->id_castings]) }}">
                                        <button class="  px-3 text-white bg-green-700 rounded hover:bg-green-800">
                                            <i class="fas fa-pencil w-5 h-5"></i>
                                        </button>
                                    </a>
                                </div>
                            @endforeach
                        @else
                            <p class="text-left text-gray-500">Tidak ada data casting.</p>
                        @endif
                    </div>


                    <p class="mb-1 font-normal text-left text-white md:text-blue-600">
                        @php
                            $hours = floor($datafilm->durasi / 60);
                            $minutes = $datafilm->durasi % 60;
                        @endphp
                        {{ $hours }} hours {{ $minutes }} minutes
                    </p>
                    <p class="mb-3 font-normal text-center text-white md:text-gray-400 md:text-left">
                        {{ $datafilm->deskripsi }}</p>

                    <div class="flex justify-center items-center md:justify-start">

                        <div x-data="{ open: false }" class="flex">

                            <!-- Tombol untuk membuka modal -->
                            <button @click="open = true"
                                class="py-2.5 px-5 me-2 mb-2 text-sm font-medium text-white focus:outline-none bg-black rounded-md w-40 border border-gray-200 hover:bg-gray-900">
                                Lihat Trailer
                            </button>

                            <div x-data="{ open: false }">
                                <button @click="open = true"
                                    class="py-2.5 px-5 me-2 mb-2 text-sm font-medium text-white focus:outline-none bg-black rounded-md w-40 border border-gray-200 hover:bg-gray-900">
                                    Castings
                                </button>

                                <div x-show="open"
                                    class="fixed inset-0 bg-gray-800 bg-opacity-50 flex justify-center items-center">
                                    <div class="bg-white p-6 rounded-md w-96 relative">
                                        <h2 class="text-xl font-semibold mb-4">Tambah Castings</h2>
                                        <form id="castingForm" action="{{ route('admin.film-detail.casting') }}"
                                            method="POST">
                                            @csrf
                                            <div class="mb-4 hidden">
                                                <label for="id_film"
                                                    class="block text-sm font-medium text-gray-700 text-left">ID
                                                    Film</label>
                                                <input type="text" id="id_film" name="id_film"
                                                    class="mt-1 p-2 w-full border border-gray-300 rounded-md"
                                                    value="{{ $id }}" readonly>
                                            </div>

                                            <div class="mb-4">
                                                <label for="nama_panggung"
                                                    class="block text-sm font-medium text-gray-700 text-left">Nama
                                                    Panggung</label>
                                                <input type="text" id="nama_panggung" name="nama_panggung"
                                                    class="mt-1 p-2 w-full border border-gray-300 rounded-md" required>
                                            </div>

                                            <div class="mb-4">
                                                <label for="nama_asli"
                                                    class="block text-sm font-medium text-gray-700 text-left">Nama
                                                    Asli</label>
                                                <input type="text" id="nama_asli" name="nama_asli"
                                                    class="mt-1 p-2 w-full border border-gray-300 rounded-md" required>
                                            </div>

                                            <div class="flex justify-end">
                                                <button type="submit"
                                                    class="py-2 px-4 bg-blue-500 text-white rounded-md">Tambah</button>
                                            </div>
                                        </form>

                                        <button @click="open = false"
                                            class="absolute top-2 right-2 text-gray-500 hover:text-gray-700 z-10">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M6 18L18 6M6 6l12 12"></path>
                                            </svg>
                                        </button>
                                    </div>
                                </div>

                            </div>




                            <!-- Modal -->
                            <div x-show="open"
                                class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
                                <div class="relative ml-52 rounded-lg w-[90%] md:w-[800px] flex flex-col items-center">
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


                    </div>
                </div>


            </div>

        </div>
        {{-- </section> --}}

    @endsection
    <script>
        // Pastikan script ini di bagian bawah sebelum penutupan </body>
        const openModalButton = document.getElementById('OpenCastings');
        const modal = document.getElementById('castingModal');
        const closeModalButton = document.getElementById('closeModal');

        if (openModalButton) {
            openModalButton.addEventListener('click', function() {
                modal.classList.remove('hidden');
                modal.classList.add('flex');
            });
        }

        if (closeModalButton) {
            closeModalButton.addEventListener('click', function() {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            });
        }

        window.addEventListener('click', function(event) {
            if (event.target === modal) {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            }
        });
    </script>

</body>

</html>

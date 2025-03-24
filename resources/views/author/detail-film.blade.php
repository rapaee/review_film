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
        <a href="{{ route('author.film') }}"
            class="flex items-center absolute border py-2 px-5 rounded-lg ml-5 hover:bg-gray-100">
            <img src="https://cdn-icons-png.flaticon.com/128/16026/16026444.png" alt="" class="w-6 h-6">
            <p>Kembali</p>
        </a>
        <div x-data="{ openTrailer: false, openCasting: false }" class="px-4 mx-auto max-w-screen h-[500px] py-24 lg:py-56">
            <div class="flex flex-col items-center md:flex-row -mt-0 md:-mt-36 md:max-w-9/12">
                <img class="object-cover w-full rounded-t-lg h-96 md:h-[350px] md:w-72 md:rounded-none md:rounded-s-lg"
                    src="{{ asset('storage/' . $datafilm->poster) }}" alt="">
                <div class="flex flex-col justify-start p-4 md:p-10 leading-normal text-center md:text-left">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight uppercase text-gray-900 dark:text-black">
                        {{ $datafilm->judul }} ({{ $datafilm->kategori_umur }})</h5>
                    <h5 class="text-md tracking-tight uppercase text-gray-900 dark:text-black">Pencipta:
                        {{ $datafilm->pencipta }}</h5>
                    <h5 class="mb-2 text-md tracking-tight uppercase text-gray-900 dark:text-black">Tahun Rilis:
                        {{ $datafilm->tahun_rilis }}</h5>
                    <h5 class="mb-2 text-md tracking-tight uppercase text-gray-900 dark:text-black">
                        Cast:
                        <div class="mt-1">
                            @foreach ($castingrelation as $c)
                                <div class="flex gap-5">
                                    {{ $c->casting->nama_panggung }} ({{ $c->casting->nama_asli }})
                                    <div>
                                        <!-- Ikon Pencil -->

                                        <form id="delete-form-{{ $c->id }}"
                                            action="{{ route('author.detail-film.delete', $c->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class=" delete-btn" data-id="{{ $c->id }}">
                                                <i
                                                    class="fa-solid fa-trash text-white bg-red-600 hover:bg-red-700 px-2 py-1 rounded-md cursor-pointer">
                                                </i>
                                            </button>
                                        </form>

                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </h5>

                    <p class="mb-1 font-normal text-blue-600">
                        @php
                            $hours = floor($datafilm->durasi / 60);
                            $minutes = $datafilm->durasi % 60;
                        @endphp
                        {{ $hours }} hours {{ $minutes }} minutes
                    </p>
                    <p class="mb-3 font-normal text-gray-400">{{ $datafilm->deskripsi }}</p>

                    <div class="flex gap-4 mt-4">
                        <button @click="openTrailer = true"
                            class="py-2 px-5 text-sm font-medium text-white bg-black rounded-md w-40 border border-gray-200 hover:bg-gray-900">
                            Lihat Trailer
                        </button>

                        <button @click="openCasting = true"
                            class="py-2 px-5 text-sm font-medium text-white bg-black rounded-md w-40 border border-gray-200 hover:bg-gray-900">
                            Castings
                        </button>
                    </div>
                </div>
            </div>

            <!-- Modal Trailer -->
            <div x-show="openTrailer" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
                <div class="relative w-[90%] md:w-[800px] flex flex-col items-center bg-white p-4 rounded-lg">
                    <button @click="openTrailer = false; stopVideo()"
                        class="absolute top-2 right-2 text-gray-500 hover:text-gray-800">✖</button>
                    <iframe id="trailerVideo" width="100%" height="400"
                        src="https://www.youtube.com/embed/{{ Str::afterLast($datafilm->trailer, '/') }}" frameborder="0"
                        allowfullscreen class="w-full rounded"></iframe>
                </div>
            </div>

            <!-- Modal Cast -->
            <div x-show="openCasting" class="fixed inset-0 bg-gray-800 bg-opacity-50 flex justify-center items-center">
                <div class="bg-white p-6 rounded-md w-96 relative">
                    <h2 class="text-xl font-semibold mb-4">Tambah Castings</h2>

                    <form id="castingForm" action="{{ route('author.detail-film.casting') }}" method="POST">
                        @csrf
                        <input type="hidden" id="id_film" name="id_film" value="{{ $id }}">

                        <div class="mb-4">
                            <label for="id_casting" class="block text-sm font-medium text-gray-700">Pilih Cast</label>
                            <select id="id_casting" name="id_casting" required
                                class="w-full border-gray-500 rounded-lg shadow-sm focus:ring focus:ring-blue-200 p-2">
                                <option value="" selected disabled>Pilih</option>
                                @foreach ($listcasting as $f)
                                    <option value="{{ $f->id_castings }}">{{ $f->nama_panggung }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="flex justify-end">
                            <button type="submit" class="py-2 px-4 bg-blue-500 text-white rounded-md">Tambah</button>
                        </div>
                    </form>

                    <button @click="openCasting = false"
                        class="absolute top-2 right-2 text-gray-500 hover:text-gray-700">✖</button>
                </div>
            </div>
        </div>

        <script>
            function stopVideo() {
                const iframe = document.getElementById('trailerVideo');
                if (iframe) {
                    const iframeSrc = iframe.src;
                    iframe.src = iframeSrc;
                }
            }
        </script>
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

        //alert button delete
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll('.delete-btn').forEach(button => {
                button.addEventListener('click', function() {
                    let userId = this.getAttribute('data-id');
                    Swal.fire({
                        title: 'Apakah Anda yakin?',
                        text: "Data ini akan dihapus secara permanen!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Ya, hapus!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            document.getElementById('delete-form-' + userId).submit();
                        }
                    });
                });
            });
        });
    </script>

</body>

</html>

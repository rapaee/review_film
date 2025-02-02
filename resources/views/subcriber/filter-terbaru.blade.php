<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Film Terbaru</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    @extends('navbar-subcriber.navbar')
    @section('navbar-subcriber')
    <div class=" w-full md:w-10/12 flex justify-center items-center mx-auto">
        <div class="p-5 w-full mt-20">
            <!-- Header -->
            <div class="bg-white w-full md:w-[1205px] ml-0 md:ml-2.5 p-2 flex justify-center md:justify-normal mb-4">
                <h1 class="text-xl font-bold mb-4">Daftar Film Terbaru Review Film</h1>
            </div>
    
            <div class="grid grid-cols-3 gap-3 justify-center md:flex md:flex-wrap">
                @php
                    $groupedFilms = $terbaru->groupBy('id_film');
                @endphp

                @foreach ($groupedFilms as $id_film => $films)
                    @php
                        $firstFilm = $films->first(); // Ambil data pertama untuk poster dan judul
                        $genres = $films->pluck('genre.title')->unique()->implode(', '); // Gabungkan genre
                    @endphp

                    <a href="{{ route('subcriber.detail-film', ['id' => $id_film]) }}" class="bg-white md:pb-12 pb-20 w-full md:w-[140px] group">
                        <div class="relative flex-shrink-0">
                            <!-- Gambar Poster -->
                            <img src="{{ asset('storage/' . $firstFilm->film->poster) }}" alt="{{ $firstFilm->film->judul }}" 
                                class="w-full md:w-[150px] h-40 md:h-[200px] group-hover:opacity-75 transition-transform-300">
                        </div> 
                        <div class="flex justify-center items-center text-center">
                            <!-- Judul dan Tahun Rilis -->
                            <p class="font-bold md:text-md text-xs">
                                {{ $firstFilm->film->judul }} <br> ({{ $firstFilm->film->tahun_rilis }})
                            </p> 
                        </div>
                        <!-- Menampilkan semua genre -->
                        <p class="flex justify-center text-red-600 md:text-xs text-xs">
                            {{ $genres }}
                        </p> 
                    </a>
                @endforeach

            </div>
                         
        </div>
    </div>


   
    @endsection
</body>
</html>

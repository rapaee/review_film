<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Film Genre</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    @extends('navbar-guest.navbar')
    @section('navbar-guest')
    <div class=" w-full md:w-10/12 flex justify-center items-center mx-auto">
        <div class="p-5 w-full mt-32">
            <!-- Header -->
            <div class="bg-white w-full md:w-[1205px] ml-0 md:ml-2.5 p-2 flex justify-center md:justify-normal mb-4">
                <h1 class="text-xl font-bold mb-4">Daftar Film Genre {{ $selectedGenre }}</h1>
            </div>
            
    
            <div class="grid grid-cols-3 gap-3 justify-center md:flex md:flex-wrap">
                @foreach ($films as $film)
                <a href="{{ route('anonymous.detail-film', ['id' => $film->id_film]) }}" 
                   class="bg-white md:pb-12 pb-20 w-full md:w-[140px] group">
                    <div class="relative flex-shrink-0">
                        <!-- Gambar Poster -->
                        <img src="{{ asset('storage/' . $film->poster) }}" 
                             alt="{{ $film->judul }}" 
                             class="w-full md:w-[150px] h-40 md:h-[200px] group-hover:opacity-75 transition-transform-300">
            
                        <div class="flex justify-center items-center text-center">
                            <!-- Judul dan Tahun Rilis -->
                            <p class="font-bold md:text-md text-xs">
                                {{ $film->judul }} <br> ({{ $film->tahun_rilis }})
                            </p> 
                        </div>
            
                        <!-- Genre (Semua Genre Ditampilkan di Bawah Film) -->
                        <p class="flex justify-center text-red-600 md:text-xs text-xs">
                            {{ implode(', ', $film->genres) }}
                        </p> 
                    </div> 
                </a>
                @endforeach
            </div>
            
                         
        </div>
    </div>
    
    @endsection

</body>
</html>

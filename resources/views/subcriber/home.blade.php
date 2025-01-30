<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body class="bg-gray-100">
    @extends('navbar-subcriber.navbar')
    @section('navbar-subcriber')
    <div class=" flex flex-col justify-center items-center bg-black p-5">
        <!-- Tombol navigasi -->
        <div class="flex justify-between w-full max-w-4xl mt-80">
            <button id="prevBtn" class="bg-gray-700 text-white px-4 py-2 rounded hover:bg-gray-600">
                <i class="fa-solid fa-chevron-left"></i>
            </button>
            <button id="nextBtn" class="bg-gray-700 text-white px-4 py-2 rounded hover:bg-gray-600">
                <i class="fa-solid fa-chevron-right"></i>
            </button>
        </div>
        
        <!-- Container untuk film -->
        <div class="film-container pr-[500px] md:pr-0 flex space-x-4 mt-8 overflow-x-hidden scrollbar-thin absolute ml-[500px] md:ml-0 scrollbar-thumb-gray-500 scrollbar-track-gray-300 max-w-4xl">
            @foreach($datafilm->take(10) as $film)
            <a href="{{ route('anonymous.detail-film', ['id' => $film->id_film]) }}">
                <div class="relative flex-shrink-0 min-w-[144px]">
                    <img src="{{ asset('storage/' . $film->poster) }}" alt="{{ $film->judul }}" class="w-36 md:w-36 h-56">
                    <p class="absolute bottom-0 left-0 w-full text-center bg-black bg-opacity-50 text-white p-1">
                        {{ $film->judul }} <br> ({{ $film->tahun_rilis }})
                    </p>
                </div>
            </a>
        @endforeach
        
        </div>
    </div>


    <div class="bg-white w-full md:w-10/12 flex justify-center items-center mx-auto mt-5">
        <div class="p-3 w-full">
            <!-- Header -->
            <div class="flex justify-between items-center mb-2">
                <h1 class="text-xl font-bold">TERBARU</h1>
                <button class="bg-[#2E236C] hover:bg-[#17153B] text-white px-4 py-2 rounded">SEMUA</button>
            </div>
    
            <div class="grid grid-cols-3 gap-5 justify-center md:flex md:flex-wrap">
                @foreach ($terbaru as $poster)
                <a href="{{ route('anonymous.detail-film', ['id' => $poster->id_film]) }}" class="w-full md:w-[110px] group">
                    <div class="relative flex-shrink-0">
                        <!-- Gambar Poster -->
                        <img src="{{ asset('storage/' . $poster->poster) }}" alt="{{ $poster->judul }}" 
                             class="w-full md:w-[130px] h-32 md:h-[170px] group-hover:opacity-75 transition-transform-300">
                        
                        <!-- Judul dan Tahun Rilis (Mobile Text) -->
                        <p class="absolute bottom-0 left-0 z-10 w-full text-center bg-black bg-opacity-50 text-white p-1 text-[10px] md:text-md hidden group-hover:block md:hidden">
                            {{ $poster->judul }} <br> ({{ $poster->tahun_rilis }})
                        </p> 
                        
                        <!-- Judul dan Tahun Rilis (Desktop Text) -->
                        <p class="absolute bottom-0 left-0 z-10 w-full text-center bg-black bg-opacity-50 text-white p-1 text-[10px] md:text-md md:block hidden">
                            {{ $poster->judul }} <br> ({{ $poster->tahun_rilis }})
                        </p>
    
                        <!-- Overlay Efek Hover -->
                        <div class="absolute inset-0 bg-black opacity-0 group-hover:opacity-60 transition-opacity duration-300 ease-in-out"></div>
                    </div> 
                </a>
                @endforeach
            </div>
                         
        </div>
    </div>
    


  
    <div class="bg-white w-full md:w-10/12 flex justify-center items-center mx-auto mt-8">
        <div class="p-3 w-full">
            <!-- Header -->
            <div class="flex justify-between items-center mb-4">
                <h1 class="text-xl font-bold">Paling Populer</h1>
                <button class="bg-[#2E236C] hover:bg-[#17153B] text-white px-4 py-2 rounded">SEMUA</button>
            </div>
    
            <div class="grid grid-cols-3 gap-5 justify-center md:flex md:flex-wrap">
                @foreach ($gl as $poster)
                <a href="{{ route('anonymous.detail-film', ['id' => $poster->film->id_film]) }}" class="w-full md:w-36 group">
                    <div class="relative flex-shrink-0">
                        <!-- Gambar Poster -->
                        <img src="{{ asset('storage/' . $poster->film->poster) }}" alt="{{ $poster->film->judul }}" 
                             class="w-full md:w-[150px] h-32 md:h-[200px] group-hover:opacity-75 transition-transform-300">
                        
                        <!-- Judul dan Tahun Rilis (Mobile Text) -->
                        <p class="absolute bottom-0 left-0 z-10 w-full text-center bg-black bg-opacity-50 text-white p-1 text-[10px] md:text-md hidden group-hover:block md:hidden">
                            {{ $poster->film->judul }} <br> ({{ $poster->film->tahun_rilis }})
                        </p> 
                        
                        <!-- Judul dan Tahun Rilis (Desktop Text) -->
                        <p class="absolute bottom-0 left-0 z-10 w-full text-center bg-black bg-opacity-50 text-white p-1 text-[10px] md:text-md md:block hidden">
                            {{ $poster->film->judul }} <br> ({{ $poster->film->tahun_rilis }})
                        </p>
    
                        <!-- Overlay Efek Hover -->
                        <div class="absolute inset-0 bg-black opacity-0 group-hover:opacity-60 transition-opacity duration-300 ease-in-out"></div>
                    </div> 
                </a>
                @endforeach
            </div>

        </div>
    </div>
    
    

    
    

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const filmContainer = document.querySelector('.film-container');
            const prevBtn = document.getElementById('prevBtn');
            const nextBtn = document.getElementById('nextBtn');

            // Fungsi untuk scroll kiri
            prevBtn.addEventListener('click', () => {
                filmContainer.scrollBy({
                    left: -300, // Scroll ke kiri sejauh 300px
                    behavior: 'smooth',
                });
            });

            // Fungsi untuk scroll kanan
            nextBtn.addEventListener('click', () => {
                filmContainer.scrollBy({
                    left: 300, // Scroll ke kanan sejauh 300px
                    behavior: 'smooth',
                });
            });
        });
    </script>
    @endsection
</body>
</html>
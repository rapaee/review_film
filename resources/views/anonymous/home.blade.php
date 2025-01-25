<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
{{-- <style>
    .film-container {
    padding-right: 500px; /* Tambahkan padding untuk memberikan ruang ekstra */
}

</style> --}}
<body class="bg-gray-100">
    @extends('navbar-guest.navbar')
    @section('navbar-guest')
        <div class=" flex flex-col justify-center items-center bg-black p-5">
            <!-- Tombol navigasi -->
            <div class="flex justify-between w-full max-w-4xl mt-80">
                <button id="prevBtn" class="bg-gray-700 text-white px-4 py-2 rounded hover:bg-gray-600">
                    Prev
                </button>
                <button id="nextBtn" class="bg-gray-700 text-white px-4 py-2 rounded hover:bg-gray-600">
                    Next
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

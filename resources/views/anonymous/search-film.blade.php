<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Film</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
</head>
<style>

</style>

<body class="bg-gray-100">
    @extends('navbar-guest.navbar')
    @section('navbar-guest')
        <div class="container mx-auto p-4">
            <h2 class="text-xl font-bold mb-4 mt-40">Hasil Pencarian</h2>

            @if ($film->isEmpty())
                <p class="text-gray-500">Tidak ada film yang ditemukan.</p>
            @else
                <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-4">
                    @foreach ($film as $f)
                        <a href="{{ route('anonymous.detail-film', ['id' => $f->id_film]) }}">
                            <div class="bg-white shadow-md rounded-lg overflow-hidden relative">
                                <div class="relative">
                                    <img src="{{ asset('storage/' . $f->poster) }}" alt="{{ $f->judul }}"
                                        class="w-full h-56 object-cover">

                                    <!-- Rating di kanan atas -->
                                    @php
                                        $rating = $f->averageRating ?? 0;
                                        $formattedRating =
                                            $rating == floor($rating)
                                                ? number_format($rating, 0)
                                                : number_format($rating, 1);
                                    @endphp
                                    <div
                                        class="absolute top-2 right-2 bg-black bg-opacity-50 text-yellow-500 text-sm font-semibold px-2 py-1 rounded flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24"
                                            class="w-4 h-4 mr-1">
                                            <path
                                                d="M12 .587l3.668 7.425 8.215 1.196-5.941 5.8 1.402 8.187L12 18.896l-7.344 3.86 1.402-8.187-5.941-5.8 8.215-1.196L12 .587z" />
                                        </svg>

                                        <p class="text-white text-sm ml-1"> {{ $formattedRating }}</p>
                                    </div>
                                </div>

                                <div class="p-4">
                                    <h3 class="text-lg font-semibold">{{ $f->judul }}</h3>
                                    <p class="text-gray-500">
                                        Tahun Rilis ( {{ $f->tahun_rilis }} )<br>
                                        <span class="text-red-500">
                                            @if (isset($filmGenres[$f->id_film]))
                                                {{ $filmGenres[$f->id_film]->pluck('genre.title')->implode(', ') }}
                                            @else
                                                Tidak ada genre
                                            @endif
                                        </span>
                                    </p>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            @endif
        </div>

    @endsection
</body>

</html>

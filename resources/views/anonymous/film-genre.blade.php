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
        <div class="container mx-auto px-4 py-6">
            <h2 class="text-2xl font-bold mb-5 mt-32">Film Genre {{ $selectedGenre }}</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-4">
                @foreach ($films as $film)
                    <a href="{{ route('anonymous.detail-film', ['id' => $film->id_film]) }}">
                        <div class="bg-white shadow-md rounded-lg overflow-hidden relative">
                            <div class="relative">
                                <img src="{{ asset('storage/' . $film->poster) }}" alt="{{ $film->judul }}"
                                    class="w-full h-56 object-cover">

                                <!-- Rating di kanan atas -->
                                @php
                                    $rating = $film->averageRating ?? 0;
                                    $formattedRating =
                                        $rating == floor($rating)
                                            ? number_format($rating, 0)
                                            : number_format($rating, 1);
                                @endphp
                                <div
                                    class="absolute top-2 right-2 bg-black bg-opacity-70 text-yellow-500 text-sm font-semibold px-2 py-1 rounded flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24"
                                        class="w-4 h-4 mr-1">
                                        <path
                                            d="M12 .587l3.668 7.425 8.215 1.196-5.941 5.8 1.402 8.187L12 18.896l-7.344 3.86 1.402-8.187-5.941-5.8 8.215-1.196L12 .587z" />
                                    </svg>
                                
                                    <p class="text-white text-sm ml-1"> {{ $formattedRating }}</p>
                                </div>
                            </div>

                            <div class="p-4">
                                <h3 class="text-lg font-semibold">{{ $film->judul }}</h3>
                                <p class="text-gray-500">Tahun Rilis ({{ $film->tahun_rilis }})</p>
                                <p class="text-red-500">
                                    @if (isset($filmGenres[$film->id_film]) && count($filmGenres[$film->id_film]) > 0)
                                        {{ implode(', ', $filmGenres[$film->id_film]) }}
                                    @else
                                        Tidak ada genre
                                    @endif
                                </p>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>


            @empty($films)
                <p class="text-gray-500">Tidak ada film untuk genre ini.</p>
                @endforelse
            </div>
        @endsection

    </body>

    </html>

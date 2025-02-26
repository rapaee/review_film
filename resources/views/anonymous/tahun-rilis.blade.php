<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Film Terbaru</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
    @extends('navbar-guest.navbar')
    @section('navbar-guest')
        <div class="container mx-auto px-4 py-6">
            <h2 class="text-2xl font-bold mb-5 mt-32">Film Tahun {{ $tahun }}</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-4">
                @foreach ($films as $film)
                    <a href="{{ route('anonymous.detail-film', ['id' => $film->id_film]) }}">
                        <div class="bg-white shadow-md rounded-lg overflow-hidden">
                            <img src="{{ asset('storage/' . $film->poster) }}" alt="{{ $film->judul }}"
                                class="w-full h-56 object-cover">
                            <div class="p-4">
                                <h3 class="text-lg font-semibold">{{ $film->judul }}</h3>
                                <p class="text-gray-500">Tahun Rilis ({{ $film->tahun_rilis }})</p>
                                <p class="text-red-500">
                                    @if(isset($filmGenres[$film->id_film]))
                                        {{ $filmGenres[$film->id_film]->pluck('genre.title')->implode(', ') }}
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
                <p class="text-gray-500">Tidak ada film untuk tahun ini.</p>
                @endforelse
            </div>


        @endsection
    </body>

    </html>

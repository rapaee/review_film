<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Film Populer</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    @extends('navbar-guest.navbar')
    @section('navbar-guest')
    <div class="container mx-auto px-4 py-6">
        <h2 class="text-2xl font-bold mb-5 mt-32">Film Populer Review Film</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-4">
            @foreach ($comments as $poster)
                <a href="{{ route('anonymous.detail-film', ['id' => $poster->film->id_film]) }}" class="bg-white shadow-md rounded-lg overflow-hidden group">
                    <div class="relative">
                        <!-- Gambar Poster -->
                        <img src="{{ asset('storage/' . $poster->film->poster) }}" alt="{{ $poster->film->judul }}" class="w-full h-56 object-cover group-hover:opacity-75 transition-all">
                        
                        @php
                            // Cari film berdasarkan id_film dari poster
                            $film = $films->firstWhere('id_film', $poster->film->id_film);
                        @endphp
                        
                        @if ($film)
                            <div class="p-4">
                                <!-- Judul dan Tahun Rilis -->
                                <h3 class="text-lg font-semibold">{{ $film->film->judul }}</h3>
                                <p class="text-gray-500">Tahun Rilis ({{ $film->film->tahun_rilis }})</p>
                                
                                <!-- Menampilkan semua genre -->
                                <p class="text-red-500 text-sm">
                                    @if(isset($film->genre))
                                        {{ $film->genre->title }}
                                    @else
                                        Tidak ada genre
                                    @endif
                                </p>
                            </div>
                        @endif
                    </div>
                </a>
            @endforeach
        </div>
        
        @empty($comments)
            <p class="text-gray-500"></p>
        @endforelse
    </div>
    


   
    @endsection
</body>
</html>

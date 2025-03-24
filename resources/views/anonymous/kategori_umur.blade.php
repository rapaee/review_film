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
        <h2 class="text-2xl font-bold mb-5 mt-32">Film Kategori Umur {{ $selectedUmur }}</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-4">
            @foreach ($filterUmur as $poster)
                <a href="{{ route('anonymous.detail-film', ['id' => $poster->id_film]) }}" class="bg-white shadow-md rounded-lg overflow-hidden group">
                    <div class="relative">
                        <!-- Gambar Poster -->
                        <img src="{{ asset('storage/' . $poster->poster) }}" alt="{{ $poster->judul }}" class="w-full h-56 object-cover group-hover:opacity-75 transition-all">
                        
                        @php
                            // Cari film berdasarkan id_film dari poster
                            $film = $filterUmur->firstWhere('id_film', $poster->id_film);
                        @endphp
                        
                        @php
                        // Cari film berdasarkan id_film dari poster menggunakan filterUmur
                        $film = $filterUmur->firstWhere('id_film', $poster->id_film);
                    @endphp
                    
                    @if ($film)
                        <div class="p-4">
                            <h3 class="text-lg font-semibold">{{ $film->judul }}</h3>
                            <p class="text-gray-500">Tahun Rilis ({{ $film->tahun_rilis }})</p>
                        </div>
                    @endif
                    
                    </div>
                </a>
            @endforeach
        </div>
        
        @empty($showfilm)
            <p class="text-gray-500"></p>
        @endforelse
    </div>
    


   
    @endsection
</body>
</html>

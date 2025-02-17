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
        
        @if($film->isEmpty())
            <p class="text-gray-500">Tidak ada film yang ditemukan.</p>
        @else
            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-4">
                @foreach($film as $f)
                <div class="bg-white shadow-md rounded-lg overflow-hidden">
                    <img src="{{ asset('storage/' . $f->poster) }}" alt="{{ $f->judul }}" class="w-full h-56 object-cover">
                    <div class="p-4">
                        <h3 class="text-lg font-semibold">{{ $f->judul }}</h3>
                        <p class="text-gray-500">Tahun Rilis: {{ $f->tahun_rilis }}</p>
                        <a href="" class="text-blue-500 hover:underline">Lihat Detail</a>
                    </div>
                </div>
            @endforeach
            
            </div>
        @endif
    </div>
    
    @endsection
</body>
</html>

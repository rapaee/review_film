<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    @extends('navbar-guest.navbar')
    @section('navbar-guest')
    <div class="flex justify-center items-center">
        <div class="flex space-x-4 mt-28">
            @foreach($datafilm as $film)
            <a href="{{ route('anonymous.detail-film', ['id' => $film->id_film]) }}">
                <div class="relative">
                    <img src="{{ asset('storage/' . $film->poster) }}" alt="{{ $film->judul }}" class="w-20 md:w-36 h-56">
                    <p class="absolute bottom-0 left-0 w-full text-center bg-black bg-opacity-50 text-white p-1">
                        {{ $film->judul }} <br> ({{ $film->tahun_rilis }})
                    </p>
                </div>
            </a>
            @endforeach
        </div>
    </div>
    @endsection
</body>
</html>

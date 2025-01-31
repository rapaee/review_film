<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $datafilm->judul }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    @extends('navbar-subcriber.navbar')
    @section('navbar-subcriber')
    <section class="bg-center w-full bg-no-repeat bg-cover mb-20 bg-[url('{{ asset('storage/' . $datafilm->poster) }}')] bg-gray-700 bg-blend-multiply">
        <div class="px-4 mx-auto max-w-screen-xl h-auto text-center py-24 lg:py-56">

            <div class="flex flex-col items-center md:flex-row -mt-0 md:-mt-20 md:max-w-9/12">
                <img class="object-cover w-full rounded-t-lg h-96 md:h-auto md:w-72 md:rounded-none md:rounded-s-lg" src="{{ asset('storage/' . $datafilm->poster) }}" alt="">
                <div class="flex flex-col justify-start p-4 md:p-10 leading-normal mt-0 md:mt-20">
                    <h5 class="mb-2 text-2xl font-bold text-left tracking-tight uppercase text-gray-900 dark:text-white">{{ $datafilm->judul }}</h5>
                    <p class="mb-3 font-normal text-center text-white md:text-gray-400 md:text-left">{{ $datafilm->deskripsi }}</p>

                   <div class="flex justify-center items-center md:justify-start">
                    <a href="{{ asset('storage/' . $datafilm->trailer) }}" target="_blank"" class="py-2.5 px-5 me-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-md w-40 border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                        Trailer
                    </a>
                    <hr style="  border: none; border-left: 2px solid gray; height: 50px;">
                    <p class=" ml-2 mb-3 font-normal text-left text-white md:text-gray-500">
                        @php
                            $hours = floor($datafilm->durasi / 60);
                            $minutes = $datafilm->durasi % 60;
                        @endphp
                        {{ $hours }} hours {{ $minutes }} minutes
                    </p>
                    
                   </div>
                </div>
                
                
            </div>

        </div>
    </section>


 <div>

    <div class="w-full mx-auto mt-10">
        <div class="bg-gray-100 p-6 rounded-lg shadow-lg">
            <h2 class="text-xl font-bold mb-4">Komentar</h2>

            <form action="{{ route('subcriber.coment') }}" method="POST">
                @csrf
                <div class="flex justify-center items-center">
                    <div class="mb-4">
                        <div class="flex items-center">
                            @for ($i = 1; $i <= 5; $i++)
                                <input type="radio" id="star{{ $i }}" name="rating" value="{{ $i }}" class="hidden peer" required>
                                <label for="star{{ $i }}" class=" cursor-pointer text-gray-400 peer-checked:text-yellow-500 text-7xl mx-1">★</label>
                            @endfor
                        </div>
                    </div>
                </div>
            
                <div class="w-full mb-4 border border-gray-400 rounded-lg bg-gray-50 dark:bg-gray-200">
                    <div class="px-4 py-2 bg-white rounded-t-lg dark:bg-gray-200">
                        <label for="comment" class="sr-only">Your comment</label>
                        <textarea id="comment" name="comment" rows="4" class="w-full px-0 text-sm text-gray-900 bg-white dark:bg-gray-200 dark:text-black dark:placeholder-gray-400" placeholder="Write a comment..." required></textarea>
                    </div>
                    <div class="flex items-center justify-between px-3 py-2 border-t dark:border-gray-600">
                        <input type="hidden" name="id_film" value="{{ $datafilm->id_film }}">
            
                        <button type="submit" class="inline-flex items-center py-2.5 px-4 text-xs font-medium text-center text-white bg-blue-700 rounded-lg focus:ring-4 focus:ring-blue-200 dark:focus:ring-blue-900 hover:bg-blue-800">
                            Post comment
                        </button>
                    </div>
                </div>
            </form>
            

            <div class="space-y-6">

                @foreach ($comment as $c)
                <!-- Comment -->
                <div class="bg-gray-300 p-4 rounded-lg">
                    <div class="flex justify-between">
                        <p class="font-bold">{{ $c->user->name }}</p>
                        <p class="font-bold">{{ \Carbon\Carbon::parse($c->created_at)->format('Y-m-d') }}</p>
                    </div>
            
                    <p>{{ $c->comment }}</p>
                    <div class="flex items-center text-sm text-gray-400 mt-2">
                        {{-- <span class="mr-2">{{ $c->rating }} <span class="text-yellow-400">★</span></span> --}}
                        <span class="cursor-pointer hover:text-blue-400">Reply</span>
                    </div>
                </div>
            @endforeach
            

            </div>
        </div>
    </div>

 </div>
 
    
    @endsection
</body>
</html>

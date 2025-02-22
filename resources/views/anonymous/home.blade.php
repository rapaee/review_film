<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
</head>
<style>
    .swiper {
        width: 100%;
        height: 100vh;
    }

    .swiper-slide {
        text-align: center;
        font-size: 18px;
        background: #fff;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .swiper-slide img {
        display: block;
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
</style>

<body class="bg-gray-100">
    @extends('navbar-guest.navbar')
    @section('navbar-guest')
        <div id="carouselExampleIndicators" class="relative mt-20 md:mt-20" data-twe-carousel-init data-twe-ride="carousel">

            <!--Carousel indicators-->
            <div class="absolute bottom-0 left-0 right-0 z-[2] mx-[15%] mb-4 flex list-none justify-center p-0"
                data-twe-carousel-indicators>
                @foreach ($banner as $key => $b)
                    <button type="button" data-twe-target="#carouselExampleIndicators"
                        data-twe-slide-to="{{ $key }}"
                        class="mx-[3px] box-content h-[3px] w-[30px] flex-initial cursor-pointer border-0 border-y-[10px] border-solid border-transparent bg-white bg-clip-padding p-0 -indent-[999px] opacity-50 transition-opacity duration-[600ms] ease-[cubic-bezier(0.25,0.1,0.25,1.0)] motion-reduce:transition-none {{ $loop->first ? 'data-twe-carousel-active' : '' }}"
                        aria-label="Slide {{ $key + 1 }}">
                    </button>
                @endforeach
            </div>

            <!--Carousel items-->
            <div class="relative w-full overflow-hidden after:clear-both after:block after:content-['']">
                @foreach ($banner as $key => $b)
                    <div class="relative float-left w-full transition-transform duration-[600ms] ease-in-out motion-reduce:transition-none {{ $loop->first ? 'data-twe-carousel-active' : '' }}"
                        data-twe-carousel-item>
                        <img src="{{ asset('storage/' . $b->gambar) }}" alt="Slide {{ $key + 1 }}"
                            class="block w-full ">
                    </div>
                @endforeach
            </div>

            <!--Carousel controls - prev item-->
            <button
                class="absolute bottom-0 left-0 top-0 z-[1] flex w-[15%] items-center justify-center border-0 bg-none p-0 text-center text-white opacity-50 transition-opacity duration-150 ease-[cubic-bezier(0.25,0.1,0.25,1.0)] hover:text-white hover:no-underline hover:opacity-90 hover:outline-none focus:text-white focus:no-underline focus:opacity-90 focus:outline-none motion-reduce:transition-none"
                type="button" data-twe-target="#carouselExampleIndicators" data-twe-slide="prev">
                <span class="inline-block h-8 w-8">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="h-6 w-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                    </svg>
                </span>
                <span class="sr-only">Previous</span>
            </button>

            <!--Carousel controls - next item-->
            <button
                class="absolute bottom-0 right-0 top-0 z-[1] flex w-[15%] items-center justify-center border-0 bg-none p-0 text-center text-black opacity-50 transition-opacity duration-150 ease-[cubic-bezier(0.25,0.1,0.25,1.0)] hover:text-white hover:no-underline hover:opacity-90 hover:outline-none focus:text-white focus:no-underline focus:opacity-90 focus:outline-none motion-reduce:transition-none"
                type="button" data-twe-target="#carouselExampleIndicators" data-twe-slide="next">
                <span class="inline-block h-8 w-8">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="h-6 w-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                    </svg>
                </span>
                <span class="sr-only">Next</span>
            </button>
        </div>



        <div data-aos="fade-up" class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 p-5">
            @foreach ($datafilm as $poster)
                <div
                    class="max-w-sm bg-black border border-gray-200 rounded-lg shadow-sm dark:bg-white dark:border-gray-200">
                    <a href="{{ route('anonymous.detail-film', ['id' => $poster->id_film]) }}">
                        <img class="rounded-t-lg w-full h-52 object-cover" src="{{ asset('storage/' . $poster->poster) }}"
                            alt="{{ $poster->judul }}" />
                        <a href="{{ route('anonymous.detail-film', ['id' => $poster->id_film]) }}">
                            <div class="p-4">
                                <h5 class="mb-2 text-lg font-bold tracking-tight text-gray-900 dark:text-black">
                                    {{ $poster->judul }}</h5>
                                <p class="mb-3 text-sm text-gray-700 dark:text-gray-400">Tahun Rilis (
                                    {{ $poster->tahun_rilis }} )</p>
                            </div>
                        </a>
                </div>
                </a>
            @endforeach
        </div>


        <div data-aos="fade-up"
            class="rounded-md bg-white w-full md:w-[1480px] flex justify-center items-center mx-auto mt-8 mb-12">
            <div class="p-5 w-full">
                <!-- Header -->
                <div class="flex justify-between items-center mb-4">
                    <h1 class="text-xl font-bold">Paling Populer</h1>
                    <button class="bg-[#2E236C] hover:bg-[#17153B] text-white px-4 py-2 rounded">
                        <a href="{{ route('anonymous.filter-rating') }}">SEMUA</a>
                    </button>
                </div>

                <div class="grid grid-cols-3 gap-5 justify-center md:flex md:flex-wrap">
                    @foreach ($comments as $poster)
                        <a href="{{ route('anonymous.detail-film', ['id' => $poster->film->id_film]) }}"
                            class="w-full md:w-[110px] group">
                            <div class="relative flex-shrink-0">
                                <!-- Gambar Poster -->
                                <img src="{{ asset('storage/' . $poster->film->poster) }}"
                                    alt="{{ $poster->film->judul }}"
                                    class="w-full md:w-[130px] h-32 md:h-[170px] group-hover:opacity-75 transition-transform-300">

                                <!-- Ikon Bintang -->
                                <div class="absolute top-2 right-2 flex justify-center items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-yellow-500"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path
                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.285 3.945a1 1 0 00.95.69h4.15c.969 0 1.372 1.24.588 1.81l-3.356 2.438a1 1 0 00-.364 1.118l1.285 3.945c.3.921-.755 1.688-1.538 1.118L10 14.347l-3.951 2.844c-.783.57-1.837-.197-1.538-1.118l1.285-3.945a1 1 0 00-.364-1.118L2.076 8.372c-.784-.57-.38-1.81.588-1.81h4.15a1 1 0 00.95-.69l1.285-3.945z" />
                                    </svg>
                                    <div>
                                        <p class="text-white">{{ $poster->film->averageRating ?? 'N/A' }}</p>
                                    </div>
                                </div>

                                <!-- Judul dan Tahun Rilis -->
                                <p
                                    class="absolute bottom-0 left-0 z-10 w-full text-center bg-black bg-opacity-50 text-white p-1 text-[10px] md:text-md">
                                    {{ $poster->film->judul }} <br> ({{ $poster->film->tahun_rilis }})
                                </p>

                                <!-- Overlay Efek Hover -->
                                <div
                                    class="absolute inset-0 bg-black opacity-0 group-hover:opacity-60 transition-opacity duration-300 ease-in-out">
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>



        <footer class="bg-white dark:bg-[#17153B]">
            <div class="px-4 py-6 bg-gray-100 dark:bg-[#1d1353] md:flex md:items-center md:justify-between">
                <span class="text-sm text-gray-500 dark:text-gray-300 sm:text-center">© 2023 <a
                        href="https://flowbite.com/">Paee Films</a>. All Rights Reserved.
                </span>
                <div class="flex mt-4 sm:justify-center md:mt-0 space-x-5 rtl:space-x-reverse">
                    <a href="#" class="text-gray-400 hover:text-gray-900 dark:hover:text-white">
                        <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 8 19">
                            <path fill-rule="evenodd"
                                d="M6.135 3H8V0H6.135a4.147 4.147 0 0 0-4.142 4.142V6H0v3h2v9.938h3V9h2.021l.592-3H5V3.591A.6.6 0 0 1 5.592 3h.543Z"
                                clip-rule="evenodd" />
                        </svg>
                        <span class="sr-only">Facebook page</span>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-gray-900 dark:hover:text-white">
                        <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 21 16">
                            <path
                                d="M16.942 1.556a16.3 16.3 0 0 0-4.126-1.3 12.04 12.04 0 0 0-.529 1.1 15.175 15.175 0 0 0-4.573 0 11.585 11.585 0 0 0-.535-1.1 16.274 16.274 0 0 0-4.129 1.3A17.392 17.392 0 0 0 .182 13.218a15.785 15.785 0 0 0 4.963 2.521c.41-.564.773-1.16 1.084-1.785a10.63 10.63 0 0 1-1.706-.83c.143-.106.283-.217.418-.33a11.664 11.664 0 0 0 10.118 0c.137.113.277.224.418.33-.544.328-1.116.606-1.71.832a12.52 12.52 0 0 0 1.084 1.785 16.46 16.46 0 0 0 5.064-2.595 17.286 17.286 0 0 0-2.973-11.59ZM6.678 10.813a1.941 1.941 0 0 1-1.8-2.045 1.93 1.93 0 0 1 1.8-2.047 1.919 1.919 0 0 1 1.8 2.047 1.93 1.93 0 0 1-1.8 2.045Zm6.644 0a1.94 1.94 0 0 1-1.8-2.045 1.93 1.93 0 0 1 1.8-2.047 1.918 1.918 0 0 1 1.8 2.047 1.93 1.93 0 0 1-1.8 2.045Z" />
                        </svg>
                        <span class="sr-only">Discord community</span>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-gray-900 dark:hover:text-white">
                        <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 20 17">
                            <path fill-rule="evenodd"
                                d="M20 1.892a8.178 8.178 0 0 1-2.355.635 4.074 4.074 0 0 0 1.8-2.235 8.344 8.344 0 0 1-2.605.98A4.13 4.13 0 0 0 13.85 0a4.068 4.068 0 0 0-4.1 4.038 4 4 0 0 0 .105.919A11.705 11.705 0 0 1 1.4.734a4.006 4.006 0 0 0 1.268 5.392 4.165 4.165 0 0 1-1.859-.5v.05A4.057 4.057 0 0 0 4.1 9.635a4.19 4.19 0 0 1-1.856.07 4.108 4.108 0 0 0 3.831 2.807A8.36 8.36 0 0 1 0 14.184 11.732 11.732 0 0 0 6.291 16 11.502 11.502 0 0 0 17.964 4.5c0-.177 0-.35-.012-.523A8.143 8.143 0 0 0 20 1.892Z"
                                clip-rule="evenodd" />
                        </svg>
                        <span class="sr-only">Twitter page</span>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-gray-900 dark:hover:text-white">
                        <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 .333A9.911 9.911 0 0 0 6.866 19.65c.5.092.678-.215.678-.477 0-.237-.01-1.017-.014-1.845-2.757.6-3.338-1.169-3.338-1.169a2.627 2.627 0 0 0-1.1-1.451c-.9-.615.07-.6.07-.6a2.084 2.084 0 0 1 1.518 1.021 2.11 2.11 0 0 0 2.884.823c.044-.503.268-.973.63-1.325-2.2-.25-4.516-1.1-4.516-4.9A3.832 3.832 0 0 1 4.7 7.068a3.56 3.56 0 0 1 .095-2.623s.832-.266 2.726 1.016a9.409 9.409 0 0 1 4.962 0c1.89-1.282 2.717-1.016 2.717-1.016.366.83.402 1.768.1 2.623a3.827 3.827 0 0 1 1.02 2.659c0 3.807-2.319 4.644-4.525 4.889a2.366 2.366 0 0 1 .673 1.834c0 1.326-.012 2.394-.012 2.72 0 .263.18.572.681.475A9.911 9.911 0 0 0 10 .333Z"
                                clip-rule="evenodd" />
                        </svg>
                        <span class="sr-only">GitHub account</span>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-gray-900 dark:hover:text-white">
                        <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 0a10 10 0 1 0 10 10A10.009 10.009 0 0 0 10 0Zm6.613 4.614a8.523 8.523 0 0 1 1.93 5.32 20.094 20.094 0 0 0-5.949-.274c-.059-.149-.122-.292-.184-.441a23.879 23.879 0 0 0-.566-1.239 11.41 11.41 0 0 0 4.769-3.366ZM8 1.707a8.821 8.821 0 0 1 2-.238 8.5 8.5 0 0 1 5.664 2.152 9.608 9.608 0 0 1-4.476 3.087A45.758 45.758 0 0 0 8 1.707ZM1.642 8.262a8.57 8.57 0 0 1 4.73-5.981A53.998 53.998 0 0 1 9.54 7.222a32.078 32.078 0 0 1-7.9 1.04h.002Zm2.01 7.46a8.51 8.51 0 0 1-2.2-5.707v-.262a31.64 31.64 0 0 0 8.777-1.219c.243.477.477.964.692 1.449-.114.032-.227.067-.336.1a13.569 13.569 0 0 0-6.942 5.636l.009.003ZM10 18.556a8.508 8.508 0 0 1-5.243-1.8 11.717 11.717 0 0 1 6.7-5.332.509.509 0 0 1 .055-.02 35.65 35.65 0 0 1 1.819 6.476 8.476 8.476 0 0 1-3.331.676Zm4.772-1.462A37.232 37.232 0 0 0 13.113 11a12.513 12.513 0 0 1 5.321.364 8.56 8.56 0 0 1-3.66 5.73h-.002Z"
                                clip-rule="evenodd" />
                        </svg>
                        <span class="sr-only">Dribbble account</span>
                    </a>
                </div>
            </div>
            </div>
        </footer>

        <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

        <!-- Initialize Swiper -->
        <script>
            var swiper = new Swiper(".mySwiper", {
                navigation: {
                    nextEl: ".swiper-button-next",
                    prevEl: ".swiper-button-prev",
                },
            });
        </script>

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const carousel = document.querySelector("#carouselExampleIndicators");
                const items = carousel.querySelectorAll("[data-twe-carousel-item]");
                const indicators = carousel.querySelectorAll("[data-twe-carousel-indicators] button");
                const prevButton = carousel.querySelector("[data-twe-slide='prev']");
                const nextButton = carousel.querySelector("[data-twe-slide='next']");
                let currentIndex = 0;
                let autoSlide;

                function updateCarousel(index) {
                    items.forEach((item, i) => {
                        item.classList.toggle("hidden", i !== index);
                    });
                    indicators.forEach((indicator, i) => {
                        indicator.classList.toggle("opacity-100", i === index);
                        indicator.classList.toggle("opacity-50", i !== index);
                    });
                }

                function nextSlide() {
                    currentIndex = (currentIndex + 1) % items.length;
                    updateCarousel(currentIndex);
                }

                prevButton.addEventListener("click", function() {
                    currentIndex = (currentIndex - 1 + items.length) % items.length;
                    updateCarousel(currentIndex);
                    resetAutoSlide();
                });

                nextButton.addEventListener("click", function() {
                    nextSlide();
                    resetAutoSlide();
                });

                indicators.forEach((indicator, i) => {
                    indicator.addEventListener("click", function() {
                        currentIndex = i;
                        updateCarousel(currentIndex);
                        resetAutoSlide();
                    });
                });

                function startAutoSlide() {
                    autoSlide = setInterval(nextSlide, 5000);
                }

                function resetAutoSlide() {
                    clearInterval(autoSlide);
                    startAutoSlide();
                }

                startAutoSlide();
                updateCarousel(currentIndex);
            });

            AOS.init();

            document.addEventListener("DOMContentLoaded", function() {
                const container = document.querySelector(".film-container");
                const prevBtn = document.getElementById("prevBtn");
                const nextBtn = document.getElementById("nextBtn");

                function getItemWidth() {
                    // Ambil lebar elemen pertama sebagai referensi
                    const firstItem = container.querySelector(".film-item");
                    return firstItem ? firstItem.offsetWidth + 16 : 160; // Tambahkan margin (sesuaikan jika perlu)
                }

                function updateScroll(direction) {
                    const itemWidth = getItemWidth();
                    container.scrollBy({
                        left: direction * itemWidth,
                        behavior: "smooth"
                    });
                }

                nextBtn.addEventListener("click", function() {
                    updateScroll(1);
                });

                prevBtn.addEventListener("click", function() {
                    updateScroll(-1);
                });

                // Tambahkan event listener untuk menangani perubahan ukuran layar
                window.addEventListener("resize", function() {
                    getItemWidth(); // Pastikan nilai diperbarui sesuai layar
                });
            });
        </script>
    @endsection
</body>

</html>

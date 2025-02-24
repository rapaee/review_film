<script src="https://cdn.tailwindcss.com"></script>

<body class="bg-gray-100">
    @extends('navbar-guest.navbar')
    @section('navbar-guest')
        <div class="py-12 mt-28">
            {{-- <a href="{{ route('anonymous.home') }}" class="hidden md:flex items-center py-2 px-5 ml-24 mb-5">
                <img src="https://cdn-icons-png.flaticon.com/128/16026/16026444.png" alt="" class="w-6 h-6">
                <p>Kembali</p>
            </a> --}}
            
            <div class="max-w-4xl object-cover sm:max-w-5xl md:max-w-md lg:max-w-7xl mx-auto space-y-6">
                <!-- Form Update Profile Information -->
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>

                <!-- Form Update Password -->
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>

                <!-- Form Delete User -->
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
            </div>
        </div>
    @endsection
</body>

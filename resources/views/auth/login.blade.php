<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="my-16">
        <h1 class="text-2xl font-bold flex justify-center mb-4">LOGIN</h1>
        <!-- Email Address -->
        <div class="mb-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="mt-4 flex justify-between">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Ingat saya?') }}</span>
            </label>
            @if (Route::has('password.request'))
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                {{ __('Lupa kata sandi anda?') }}
            </a>
            @endif
        </div>
        

        <div class="flex flex-col items-center justify-between mt-4 text-center">
         
            <div class="flex gap-2 mb-4 text-gray-600">
                <p class="">Belum punya akun?</p>
                <a href="{{ route('register') }}" class=" hover:text-gray-900">Register</a>
            </div>

            <x-primary-button class="w-full mt-5">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
        </div>
    </form>
</x-guest-layout>
@if(session('registerSuccess'))
<script>
    Swal.fire({
        title: 'Registrasi Berhasil!',
        text: "{{ session('registerSuccess') }}",
        icon: 'success',
        confirmButtonText: 'OK'
    });
</script>
@endif
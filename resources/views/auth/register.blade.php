<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="my-16">
            <h1 class="text-2xl font-bold flex justify-center mb-4">REGISTER</h1>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Name -->
                <div>
                    <x-input-label for="name" :value="__('Name')" />
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Email Address -->
                <div>
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div>
                    <x-input-label for="password" :value="__('Password')" />
                    <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirm Password -->
                <div>
                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                    <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                    
            </div>

            <!-- Register Button -->
            <div class="flex flex-col items-center justify-between mt-6 text-center">
                <div class="flex gap-2 mb-4">
                    <p>Sudah punya akun?</p>
                    <a href="{{ route('login') }}" class="underline hover:text-gray-400">Login</a>
                </div>

                <x-primary-button class="w-full mt-5">
                    {{ __('Register') }}
                </x-primary-button>
            </div>
        </div>
    </form>
</x-guest-layout>
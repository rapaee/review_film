<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>
    <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <!-- Foto Profil -->
        <div class="w-32 h-32 rounded-full overflow-hidden border-4 border-gray-200 mb-5 cursor-pointer"
            id="profile-photo-container">
            <img class="w-full h-full object-cover"
            src="{{ Auth::user()->photo ? asset('storage/photos/' . Auth::user()->photo) : 'https://cdn-icons-png.flaticon.com/128/149/149071.png' }}"
            alt="user photo">
        </div>


        <input type="file" id="photo-input" name="photo" class="hidden" accept="image/*">

        <!-- Nama -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text"
                class="mt-1 block w-full p-2 shadow-md border-gray-200 border" :value="old('name', $user->name)" required autofocus
                autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <!-- Email -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email"
                class="mt-1 block w-full p-2 shadow-md border-gray-200 border" :value="old('email', $user->email)" required
                autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />
        </div>

        <!-- Tombol Simpan -->
        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Simpan') }}</x-primary-button>
        </div>
    </form>

    <script>
        document.getElementById('profile-photo-container').addEventListener('click', function() {
            document.getElementById('photo-input').click();
        });

        document.getElementById('photo-input').addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    // Simpan foto baru ke localStorage agar preview lebih cepat
                    localStorage.setItem('profile_photo', e.target.result);
                    document.getElementById('profile-photo').src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });

        // Hapus foto lama dari localStorage saat halaman dimuat ulang
        window.addEventListener('load', function() {
            if (localStorage.getItem('profile_photo')) {
                document.getElementById('profile-photo').src = localStorage.getItem('profile_photo');
            }
        });

        // Hapus foto dari localStorage setelah formulir dikirim
        document.querySelector('form').addEventListener('submit', function() {
            localStorage.removeItem('profile_photo');
        });
    </script>


</section>

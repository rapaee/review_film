<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    @extends('navbar-admin.navbar')
    @section('navbar-admin')
       
    <h1 class="flex justify-center font-bold mb-4 mt-2 text-2xl">TABLE USER</h1>
<div class="flex justify-between mb-3">
    <form class="flex-grow me-4 ml-2">   
        <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
        <div class="relative">
            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                </svg>
            </div>
            <input type="search" id="default-search" class="block w-3/12 p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 " placeholder="Search" />
        </div>
    </form>
    <button id="openModal" class="text-blue-700 hover:text-white border focus:ring-blue-300 font-medium rounded-lg text-sm w-24 h-12 text-center me-2 mb-2 dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:hover:bg-blue-500">
        Tambah
    </button>
</div>

<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm rtl:text-right text-gray-500 dark:text-black text-center">
        <thead class="text-xs uppercase dark:bg-blue-200 dark:text-black">
            <tr>
                <th scope="col" class="px-6 py-3">Nama</th>
                <th scope="col" class="px-6 py-3">Email</th>
                <th scope="col" class="px-6 py-3">Role</th>
                <th scope="col" class="px-6 py-3"><span class="sr-only">Edit</span></th>
            </tr>
        </thead>
        <tbody>
            @foreach ( $user as $u )
            <tr class="bg-white border-b dark:border-gray-400">
                <td class="px-6 py-4">{{ $u->name }}</td>
                <td class="px-6 py-4">{{ $u->email }}</td>
                <td class="px-6 py-4">{{ $u->role }}</td>
                <td class="px-2 py-4 flex justify-end gap-3">
                    <form action="{{ route('admin.user.delete', $u->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-white bg-red-600 hover:bg-red-700 py-1 rounded w-16">Delete</button>
                    </form>
                    <button 
                        class="text-white bg-green-600 hover:bg-green-700 py-1 rounded px-4" 
                        onclick="showEditUserPopup('{{ route('admin.user.update', $u->id) }}', '{{ $u->name }}', '{{ $u->email }}', '{{ $u->role }}')">
                        Edit
                    </button>

                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script>


function showEditUserPopup(updateUrl, name, email, role) {
    Swal.fire({
        title: 'Edit User',
        html: `
            <form id="showEditPopup" action="${updateUrl}" method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="_method" value="PUT">
                <div class="mb-3 text-left">
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Name</label>
                    <input type="text" name="name" id="name" value="${name}" 
                           class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                </div>
                <div class="mb-3 text-left">
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Email</label>
                    <input type="email" name="email" id="email" value="${email}" 
                           class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                </div>
                <div class="mb-3 text-left">
                    <label for="role" class="block mb-2 text-sm font-medium text-gray-900">Role</label>
                    <select name="role" id="role" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                        <option value="admin" ${role === 'admin' ? 'selected' : ''}>Admin</option>
                        <option value="subcriber" ${role === 'subcriber' ? 'selected' : ''}>Subcriber</option>
                        <option value="author" ${role === 'author' ? 'selected' : ''}>Author</option>

                    </select>
                </div>
                <div class="mb-3 text-left">
                    <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Password (Kosongkan jika tidak ingin diubah)</label>
                    <input type="password" name="password" id="password" 
                           class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                </div>
                <div class="mb-3 text-left">
                    <label for="password_confirmation" class="block mb-2 text-sm font-medium text-gray-900">Confirm Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" 
                           class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                </div>
            </form>
        `,
        showCancelButton: true,
        confirmButtonText: 'Submit',
        cancelButtonText: 'Batal',
        cancelButtonColor: '#ff0000',
        confirmButtonColor: '#008000',
        preConfirm: () => {
            document.getElementById('showEditPopup').submit();
        }
    });
}


        document.getElementById('openModal').addEventListener('click', function () {
    Swal.fire({
        title: 'FORM TAMBAH USER',
        html: `
            <form action="{{ route('admin.user.store') }}" method="POST" id="userForm" class="text-left">
                @csrf
                <div class="mb-3">
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Nama</label>
                    <input type="text" name="name" id="name" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" required />
                </div>
                <div class="mb-3">
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Email</label>
                    <input type="email" name="email" id="email" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" required />
                </div>
                <div class="mb-3">
                    <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Password</label>
                    <input type="password" name="password" id="password" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" required />
                </div>
                <div class="mb-3">
                    <label for="password_confirmation" class="block mb-2 text-sm font-medium text-gray-900">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" required />
                </div>
            </form>
        `,
        showCancelButton: true,
        confirmButtonText: 'Submit',
        cancelButtonText: 'Batal',
        cancelButtonColor: '#ff0000',  // Warna merah untuk tombol Batal
        confirmButtonColor: '#008000', // Warna hijau untuk tombol Submit
        preConfirm: () => {
            const form = document.getElementById('userForm');
            form.submit();
        }
    });
});


    document.addEventListener('DOMContentLoaded', function () {
        const searchInput = document.getElementById('default-search');
        const tableRows = document.querySelectorAll('tbody tr');

        searchInput.addEventListener('input', function () {
            const searchQuery = searchInput.value.toLowerCase();
            tableRows.forEach(row => {
                const cells = Array.from(row.querySelectorAll('td'));
                const rowText = cells.map(cell => cell.textContent.toLowerCase()).join(' ');
                
                if (rowText.includes(searchQuery)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    });
</script>
@endsection
</body>
</html>

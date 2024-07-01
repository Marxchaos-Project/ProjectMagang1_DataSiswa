<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite('resources/css/app.css')
    <title>Siswa</title>
    <style>
        .modal {
            display: none;
        }

        .modal.active {
            display: block;
        }

        .modal .close-btn {
            cursor: pointer;
        }
        #flash-message {
        transition: opacity 0.5s ease-out;
    }
        #flash-message.opacity-0 {
        opacity: 0;
    }
    </style>
</head>
<!-- Main Index -->
<header class="bg-teal-700 w-100% h-20 items-center flex justify-between">
    <div class="uppercase font-sans text-slate-200 font-black text-3xl ml-8">DATA SISWA</div>
    <div class="relative flex items-center w-50 h-10 mr-4 rounded-lg focus-within:shadow-lg bg-white overflow-hidden">
        <form onsubmit="openModal(); return false;" class="flex items-center bg-white rounded shadow-md">
            <input type="text" name="query" placeholder="Search..."
                class="px-4 py-2 w-64 border border-gray-300 rounded-l focus:outline-none" required>
            <button type="submit" class="grid place-items-center h-full w-12 text-gray-500 hover:text-gray-700">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </button>
        </form>

        <!-- Modal Search -->
        <div id="searchModal" tabindex="-1" aria-hidden="true" class="modal fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 ">
            <div class="bg-white p-8 rounded shadow-md w-1/2">
                <button class="absolute top-0 right-0 mt-4 mr-4 text-gray-700 hover:text-gray-900"
                type="button" aria-hidden="true" data-modal-hide="searchModal" onclick="closeModal()" >
                    &times;
                </button>
                <div id="modalContent">
                    <!-- Konten modal  -->
                </div>
            </div>
        </div>

        <script>
            function openModal() {
                const query = document.querySelector('input[name="query"]').value;
                fetch(`/search?query=${query}`)
                    .then(response => response.text())
                    .then(html => {
                        document.getElementById('modalContent').innerHTML = html;
                        document.getElementById('searchModal').classList.add('active');
                    })
                    .catch(error => console.error('Error:', error));
            }

            function closeModal() {
            document.getElementById('searchModal').classList.remove('active');
    }
        </script>

    </div>
    <!-- End of Modal Search -->
</header>

<body>
    <div class="container">
        <div class="row">
            <h2 class="mt-8 font-semibold text-center text-2xl">Data Siswa Sekolah</h2>
                <button
                class="mt-8 ml-6 py-2.5 px-6 rounded-lg text-sm font-medium text-slate-200 bg-teal-700 hover:bg-teal-900 justify-end"
                id="modal-toggle"  data-modal-target="static-modal" data-modal-toggle="static-modal">ADD DATA</button>
            </div>

<!-- Flash Messages -->
@if(session('success'))
<div id="flash-message" class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mt-4 ml-6 mr-6 text-center transition-opacity duration-500 ease-out" role="alert">
    <span class="block sm:inline">{{ session('success') }}</span>
</div>
@endif

<script>
document.addEventListener('DOMContentLoaded', function () {
const flashMessage = document.getElementById('flash-message');
if (flashMessage) {
    setTimeout(() => {
        flashMessage.classList.add('opacity-0');
        setTimeout(() => {
            flashMessage.remove();
        }, 500); // waktu transisi yang sesuai dengan durasi transisi di CSS
    }, 3000); // ganti 3000 dengan waktu dalam milidetik yang Anda inginkan
}
});
</script>
<!-- Flash Messages -->

        <div class="mt-8">
            <div class="grid grid-cols-3 gap-4 mr-6 ml-6">
                @foreach ($identitas as $identitas)
                    <div class="bg-slate-100 shadow-md rounded border-gray-200">
                        <p class="ml-6 mt-3">Nama: {{ $identitas->Nama }}</p>
                        <p class="ml-6">Ttl: {{ $identitas->Ttl }}</p>
                        <p class="ml-6">Sekolah: {{ $identitas->Sekolah }}</p>
                        <p class="ml-6">keterangan: {{ $identitas->Keterangan }}</p>
                        <div class="ml-6 mb-3 mt-3 justify-between">
                            <button class="px-3 py-2 bg-teal-700 hover:bg-teal-800 rounded text-slate-200"
                                class="btn btn-primary" data-modal-target="editModal{{ $identitas->id }}"
                                data-modal-togggle="editModal{{ $identitas->id }}">Edit</button>
                            <button class="px-3 py-2 bg-teal-600 hover:bg-teal-700 rounded"
                                data-modal-target="modelConfirm{{ $identitas->id }}"
                                data-modal-togggle="modelConfirm{{ $identitas->id }}">Delete</button>
                        </div>
                    </div>
         
                        @include('Data.modal-delete')
                        @include('Data.modal-edit')
                    
                @endforeach
            </div>
        </div>
        <!-- End of Main Index -->

        <br>

        <!-- Add Data modal -->
        <div id="static-modal" tabindex="-1" aria-hidden="true"
            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full bg-gray-900 bg-opacity-50">
            <div class="relative p-4 w-full max-w-2xl max-h-full">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                        <h3 class="text-xl font-semibold text-gray-900">
                            Tambah Data Siswa
                        </h3>
                        <button type="button" id="close-modal {{$identitas->id}}"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="static-modal">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="p-4 md:p-5 space-y-4">
                        <form action="{{ route('Identitas.save') }}" method="POST" class="text-black rounded">
                            @csrf
                            <div class="form-group mb-5">
                                <label for="Nama" class="">Nama: </label>
                                <br>
                                <input type="text" name="Nama"
                                    class="form-control w-full rounded h-10 appearance-none border-2 pl-10 border-gray-300 hover:border-gray-400 transition-colors py-2 px-3 text-gray-800 leading-tight focus:outline-none focus:ring-teal-600 focus:border-teal-700 focus:shadow-outline"
                                    required>
                            </div>
                            <div class="form-group mb-5">
                                <label for="Ttl">Ttl: </label>
                                <br>
                                <input type="text" name="Ttl"
                                    class="form-control w-full rounded h-10 appearance-none border-2 pl-10 border-gray-300 hover:border-gray-400 transition-colors py-2 px-3 text-gray-800 leading-tight focus:outline-none focus:ring-teal-600 focus:border-teal-700 focus:shadow-outline"
                                    required>
                            </div>
                            <div class="form-group mb-5">
                                <label for="Sekolah">Sekolah: </label>
                                <br>
                                <input type="text" name="Sekolah"
                                    class="form-control w-full rounded h-10 appearance-none border-2 pl-10 border-gray-300 hover:border-gray-400 transition-colors py-2 px-3 text-gray-800 leading-tight focus:outline-none focus:ring-teal-600 focus:border-teal-700 focus:shadow-outline"
                                    required>
                            </div>
                            <div class="form-group mb-5">
                                <label for="Keterangan">Keterangan: </label>
                                <br>
                                <input type="text" name="Keterangan"
                                    class="form-control w-full rounded h-10 appearance-none border-2 pl-10 border-gray-300 hover:border-gray-400 transition-colors py-2 px-3 text-gray-800 leading-tight focus:outline-none focus:ring-teal-600 focus:border-teal-700 focus:shadow-outline"
                                    required>
                            </div>
                            <button type="submit"
                                class="btn btn-primary mb-5 bg-teal-700 hover:bg-teal-800 text-white rounded l p-2 justify-self: end;">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const toggleModalButtons = document.querySelectorAll('[data-modal-target]');
                const hideModalButtons = document.querySelectorAll('[data-modal-hide]');

                toggleModalButtons.forEach(button => {
                    button.addEventListener('click', () => {
                        const modalId = button.getAttribute('data-modal-target');
                        const modal = document.getElementById(modalId);
                        modal.classList.toggle('hidden');
                        modal.classList.toggle('flex');
                    });
                });

                hideModalButtons.forEach(button => {
                    button.addEventListener('click', () => {
                        const modalId = button.getAttribute('data-modal-hide');
                        const modal = document.getElementById(modalId);
                        modal.classList.add('hidden');
                        modal.classList.remove('flex');
                    });
                });

                window.addEventListener('click', (event) => {
                    hideModalButtons.forEach(button => {
                        const modalId = button.getAttribute('data-modal-hide');
                        const modal = document.getElementById(modalId);
                        if (event.target === modal) {
                            modal.classList.add('hidden');
                            modal.classList.remove('flex');
                        }
                    });
                });
            });
        </script>
        {{-- <script>
document.getElementById('modal-toggle').addEventListener('click', function() {
    document.getElementById('static-modal').classList.remove('hidden');
    document.getElementById('static-modal').classList.add('flex');
});

document.getElementById('close-modal').addEventListener('click', function() {
    document.getElementById('static-modal').classList.add('hidden');
    document.getElementById('static-modal').classList.remove('flex');
});
</script> --}}


        <!-- Add Data Modal End -->

        <script integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
        </script>
        <script integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
        </script>
        <script integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
        </script>


</body>

</html>

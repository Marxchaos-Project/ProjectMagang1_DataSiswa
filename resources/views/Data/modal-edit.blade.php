<div id="editModal{{$identitas->id}}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center bg-gray-900 bg-opacity-60  items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-2xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-black">
                    Edit Data {{$identitas->Nama}}
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="editModal{{$identitas->id}}">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-4 md:p-5 space-y-4">
                <form action="{{ route('Identitas.update', $identitas->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label for="Nama" class="block text-sm font-medium text-gray-700">Nama: </label>
                        <input type="text" class="form-input mt-1 block w-full" id="Nama" name="Nama" value="{{ old('Nama', $identitas->Nama) }}">
                    </div>
                    <div class="mb-4">
                        <label for="Ttl" class="block text-sm font-medium text-gray-700">Ttl: </label>
                        <input type="text" class="form-input mt-1 block w-full" id="Ttl" name="Ttl" value="{{ old('Ttl', $identitas->Ttl) }}">
                    </div>
                    <div class="mb-4">
                        <label for="Sekolah" class="block text-sm font-medium text-gray-700">Sekolah: </label>
                        <input type="text" class="form-input mt-1 block w-full" id="Sekolah" name="Sekolah" value="{{ old('Sekolah', $identitas->Sekolah) }}">
                    </div>
                    <div class="mb-4">
                        <label for="Keterangan" class="block text-sm font-medium text-gray-700">Keterangan: </label>
                        <input type="text" class="form-input mt-1 block w-full" id="Keterangan" name="Keterangan" value="{{ old('Keterangan', $identitas->Keterangan) }}">
                    </div>
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary bg-teal-700 hover:bg-teal-800 rounded p-2 text-slate-200">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

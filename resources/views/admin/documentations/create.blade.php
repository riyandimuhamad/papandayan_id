@extends('layouts.admin')

@section('header_title', 'Tambah Dokumentasi')

@section('content')
<div class="mb-6">
    <a href="{{ route('admin.documentations.index') }}" class="text-blue-600 hover:text-blue-800 flex items-center text-sm font-medium">
        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        Kembali ke Daftar
    </a>
</div>

<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden max-w-2xl">
    <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
        <h3 class="text-lg font-bold text-gray-800">Form Tambah Foto</h3>
    </div>
    
    <div class="p-6">
        <form action="{{ route('admin.documentations.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="space-y-6">
                <!-- Foto -->
                <div x-data="imageViewer()">
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Foto Dokumentasi <span class="text-red-500">*</span></label>
                    <label for="image_path" class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md relative hover:bg-gray-50 transition-colors cursor-pointer block w-full" :class="{'bg-gray-50': imageUrl}">
                        <div class="space-y-1 text-center" x-show="!imageUrl">
                            <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <div class="flex text-sm text-gray-600 justify-center">
                                <span class="relative font-medium text-yellow-600 hover:text-yellow-500 px-1">
                                    Klik di sini untuk upload foto
                                    <input id="image_path" name="image_path" type="file" class="sr-only" required accept="image/*" @change="fileChosen">
                                </span>
                            </div>
                            <p class="text-xs text-gray-500 mt-1">PNG, JPG, GIF up to 5MB</p>
                            <p class="text-xs text-green-600 font-medium mt-2">Gambar akan otomatis dioptimasi untuk performa web.</p>
                        </div>
                        <div x-show="imageUrl" class="relative w-full" style="display: none;">
                            <img :src="imageUrl" class="max-h-64 mx-auto rounded-md object-contain">
                            <button type="button" @click.prevent.stop="removeImage" class="absolute top-2 right-2 bg-red-500 text-white rounded-full p-1 hover:bg-red-600 transition-colors shadow-sm" title="Hapus foto">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                            </button>
                        </div>
                    </label>
                    @error('image_path')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Caption -->
                <div>
                    <label for="caption" class="block text-sm font-semibold text-gray-700 mb-1">Keterangan Foto (Opsional)</label>
                    <input type="text" name="caption" id="caption" value="{{ old('caption') }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-yellow-500 focus:ring focus:ring-yellow-500 focus:ring-opacity-50" placeholder="Misal: Keseruan di Padang Edelweis">
                    @error('caption')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Order -->
                <div>
                    <label for="order" class="block text-sm font-semibold text-gray-700 mb-1">Urutan Tampil <span class="text-red-500">*</span></label>
                    <input type="number" name="order" id="order" value="{{ old('order', 0) }}" required min="0" class="w-24 rounded-md border-gray-300 shadow-sm focus:border-yellow-500 focus:ring focus:ring-yellow-500 focus:ring-opacity-50">
                    <p class="text-xs text-gray-500 mt-1">Angka terkecil (contoh: 1) akan ditampilkan paling awal. Jika 0, akan diurutkan berdasarkan tanggal terbaru.</p>
                    @error('order')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mt-8 flex justify-end">
                <button type="submit" class="inline-flex items-center px-6 py-3 border border-transparent rounded-lg shadow-sm text-sm font-bold text-white bg-slate-900 hover:bg-slate-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-slate-900 transition-colors">
                    <svg class="w-5 h-5 mr-2 -ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path></svg>
                    Simpan & Upload
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function imageViewer() {
        return {
            imageUrl: '',
            fileChosen(event) {
                this.fileToDataUrl(event, src => this.imageUrl = src)
            },
            fileToDataUrl(event, callback) {
                if (! event.target.files.length) return
                let file = event.target.files[0],
                    reader = new FileReader()
                reader.readAsDataURL(file)
                reader.onload = e => callback(e.target.result)
            },
            removeImage() {
                this.imageUrl = '';
                document.getElementById('image_path').value = '';
                document.getElementById('image_path_hidden').value = '';
            }
        }
    }
</script>
@endsection

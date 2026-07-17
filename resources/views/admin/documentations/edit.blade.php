@extends('layouts.admin')

@section('header_title', 'Edit Dokumentasi')

@section('content')
<div class="mb-6">
    <a href="{{ route('admin.documentations.index') }}" class="text-blue-600 hover:text-blue-800 flex items-center text-sm font-medium">
        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        Kembali ke Daftar
    </a>
</div>

<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden max-w-2xl">
    <div class="px-6 py-4 border-b border-gray-100 bg-gray-50 flex justify-between items-center">
        <h3 class="text-lg font-bold text-gray-800">Form Edit Foto</h3>
        <span class="text-sm bg-yellow-100 text-yellow-800 font-bold px-2 py-1 rounded">Urutan: {{ $documentation->order }}</span>
    </div>
    
    <div class="p-6">
        <form id="data-form" action="{{ route('admin.documentations.update', $documentation) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="space-y-6">
                <!-- Foto -->
                <div x-data="imageViewer('{{ $documentation->image_path ? url('storage/' . $documentation->image_path) : '' }}')">
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Foto Dokumentasi</label>
                    <label for="image_path" class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md relative hover:bg-gray-50 transition-colors cursor-pointer block w-full" :class="{'bg-gray-50': imageUrl}">
                        <div class="space-y-1 text-center" x-show="!imageUrl">
                            <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <div class="flex text-sm text-gray-600 justify-center">
                                <span class="relative font-medium text-yellow-600 hover:text-yellow-500 px-1">
                                    Klik di sini untuk ganti foto
                                    <input id="image_path" name="image_path" type="file" class="sr-only" accept="image/*" @change="fileChosen">
                                </span>
                            </div>
                            <p class="text-xs text-gray-500 mt-1">Biarkan kosong jika tidak ingin mengubah foto saat ini.</p>
                        </div>
                        <div x-show="imageUrl" class="relative w-full">
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
                    <input type="text" name="caption" id="caption" value="{{ old('caption', $documentation->caption) }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-yellow-500 focus:ring focus:ring-yellow-500 focus:ring-opacity-50">
                    @error('caption')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Order -->
                <div>
                    <label for="order" class="block text-sm font-semibold text-gray-700 mb-1">Urutan Tampil <span class="text-red-500">*</span></label>
                    <input type="number" name="order" id="order" value="{{ old('order', $documentation->order) }}" required min="0" class="w-24 rounded-md border-gray-300 shadow-sm focus:border-yellow-500 focus:ring focus:ring-yellow-500 focus:ring-opacity-50">
                    <p class="text-xs text-gray-500 mt-1">Angka terkecil (contoh: 1) akan ditampilkan paling awal. Jika 0, akan diurutkan berdasarkan tanggal terbaru.</p>
                    @error('order')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Buttons -->
            <div class="flex items-center justify-end pt-4 border-t border-gray-100 gap-3">
                <a href="{{ route('admin.documentations.index') }}" class="px-5 py-2.5 bg-white border border-gray-300 rounded-lg font-bold text-gray-700 text-sm hover:bg-gray-50 focus:outline-none transition-all shadow-sm">Batal</a>
                <button type="submit" id="btn-submit" class="px-5 py-2.5 bg-gray-300 border border-transparent rounded-lg font-bold text-gray-500 text-sm cursor-not-allowed focus:outline-none transition-all shadow-md" disabled>Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('data-form');
        const inputs = form.querySelectorAll('input, textarea, select');
        const btnSubmit = document.getElementById('btn-submit');
        
        inputs.forEach(input => {
            if(input.name !== '_token' && input.name !== '_method') {
                if(input.type === 'file') {
                    input.dataset.initial = '';
                } else if(input.type === 'checkbox' || input.type === 'radio') {
                    input.dataset.initial = input.checked ? 'true' : 'false';
                } else {
                    input.dataset.initial = input.value;
                }
                
                input.addEventListener('input', checkChanges);
                input.addEventListener('change', checkChanges);
            }
        });

        function checkChanges() {
            let isChanged = false;
            inputs.forEach(input => {
                if(input.name !== '_token' && input.name !== '_method') {
                    if(input.type === 'file') {
                        if(input.files && input.files.length > 0) isChanged = true;
                    } else if(input.type === 'checkbox' || input.type === 'radio') {
                        const currentChecked = input.checked ? 'true' : 'false';
                        if(currentChecked !== input.dataset.initial) isChanged = true;
                    } else {
                        if(input.value !== input.dataset.initial) isChanged = true;
                    }
                }
            });

            if (isChanged) {
                btnSubmit.disabled = false;
                btnSubmit.classList.remove('bg-gray-300', 'text-gray-500', 'cursor-not-allowed', 'border-transparent');
                btnSubmit.classList.add('bg-slate-900', 'text-white', 'hover:bg-slate-800');
            } else {
                btnSubmit.disabled = true;
                btnSubmit.classList.add('bg-gray-300', 'text-gray-500', 'cursor-not-allowed', 'border-transparent');
                btnSubmit.classList.remove('bg-slate-900', 'text-white', 'hover:bg-slate-800');
            }
        }
    });

    function imageViewer(initialUrl = '') {
        return {
            imageUrl: initialUrl,
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
                if(document.getElementById('image_path_hidden')) {
                    document.getElementById('image_path_hidden').value = '';
                }
                // Trigger change event to enable button
                document.getElementById('image_path').dispatchEvent(new Event('change'));
            }
        }
    }
</script>
@endsection

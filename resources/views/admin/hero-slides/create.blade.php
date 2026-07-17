@extends('layouts.admin')

@section('header_title', 'Tambah Slider')

@section('content')
<div class="mb-6">
    <a href="{{ route('admin.hero-slides.index') }}" class="inline-flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 transition-colors">
        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        Kembali ke Daftar
    </a>
</div>

<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden max-w-4xl">
    <div class="p-6 sm:p-8 border-b border-gray-100">
        <h3 class="text-lg font-bold text-gray-900">Form Tambah Slider</h3>
        <p class="text-sm text-gray-500">Masukkan gambar dan caption untuk slider halaman utama.</p>
    </div>
    
    <div class="p-6 sm:p-8">
        <form id="slide-form" action="{{ route('admin.hero-slides.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <!-- Image -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Gambar Slider <span class="text-red-500">*</span></label>
                <div class="flex items-center gap-6">
                    <div class="w-48 h-32 rounded-lg bg-gray-100 border-2 border-dashed border-gray-300 flex items-center justify-center overflow-hidden" id="photo-preview-container">
                        <svg id="photo-placeholder" class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        <img id="photo-preview" class="w-full h-full object-cover hidden" src="" alt="Preview">
                    </div>
                    <div class="flex-1">
                        <input type="file" name="image" id="image" accept="image/*" required onchange="previewImage(event)" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-yellow-50 file:text-yellow-700 hover:file:bg-yellow-100 transition-colors">
                        <p class="mt-2 text-xs text-gray-500">Format: JPG, PNG, WEBP. Maksimal 2MB. Rekomendasi rasio landscape (16:9).</p>
                        @error('image')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Title -->
            <div>
                <label for="title" class="block text-sm font-semibold text-gray-700 mb-1">Judul Teks (Title) <span class="text-red-500">*</span></label>
                <input type="text" name="title" id="title" value="{{ old('title') }}" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-yellow-500 focus:ring focus:ring-yellow-500 focus:ring-opacity-50">
                @error('title')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Subtitle -->
            <div>
                <label for="subtitle" class="block text-sm font-semibold text-gray-700 mb-1">Sub Judul (Subtitle)</label>
                <textarea name="subtitle" id="subtitle" rows="3" class="w-full rounded-md border-gray-300 shadow-sm focus:border-yellow-500 focus:ring focus:ring-yellow-500 focus:ring-opacity-50">{{ old('subtitle') }}</textarea>
                @error('subtitle')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Order & Status -->
            <div class="space-y-6">
                <div>
                    <label for="order" class="block text-sm font-semibold text-gray-700 mb-1">Urutan Tampil <span class="text-red-500">*</span></label>
                    <input type="number" name="order" id="order" value="{{ old('order', 0) }}" required min="0" class="w-24 rounded-md border-gray-300 shadow-sm focus:border-yellow-500 focus:ring focus:ring-yellow-500 focus:ring-opacity-50">
                    <p class="text-xs text-gray-500 mt-1">Angka terkecil (contoh: 1) akan ditampilkan paling awal.</p>
                    @error('order')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="flex items-center">
                    <input type="hidden" name="is_active" value="0">
                    <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }} class="w-5 h-5 rounded border-gray-300 text-yellow-500 shadow-sm focus:ring-yellow-500">
                    <label for="is_active" class="ml-3 block text-sm font-bold text-gray-800">Aktifkan Slider Ini</label>
                </div>
            </div>

            <!-- Buttons -->
            <div class="flex items-center justify-end pt-4 border-t border-gray-100 gap-3">
                <a href="{{ route('admin.hero-slides.index') }}" class="px-5 py-2.5 bg-white border border-gray-300 rounded-lg font-bold text-gray-700 text-sm hover:bg-gray-50 focus:outline-none transition-all shadow-sm">Batal</a>
                <button type="submit" id="btn-submit" class="px-5 py-2.5 bg-gray-300 border border-transparent rounded-lg font-bold text-gray-500 text-sm cursor-not-allowed focus:outline-none transition-all shadow-md" disabled>Simpan</button>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('slide-form');
        const inputs = form.querySelectorAll('input, textarea');
        const btnSubmit = document.getElementById('btn-submit');
        
        inputs.forEach(input => {
            if(input.name !== '_token' && input.name !== '_method') {
                if(input.type === 'file') {
                    input.dataset.initial = '';
                } else if(input.type === 'checkbox') {
                    input.dataset.initial = input.checked ? 'true' : 'false';
                } else {
                    input.dataset.initial = input.value;
                }
                
                input.addEventListener('input', checkChanges);
                input.addEventListener('change', checkChanges);
            }
        });

        window.previewImage = function(event) {
            const input = event.target;
            const preview = document.getElementById('photo-preview');
            const placeholder = document.getElementById('photo-placeholder');
            const container = document.getElementById('photo-preview-container');

            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                    placeholder.classList.add('hidden');
                    container.classList.remove('p-2', 'border-dashed');
                }
                reader.readAsDataURL(input.files[0]);
            } else {
                preview.src = '';
                preview.classList.add('hidden');
                placeholder.classList.remove('hidden');
                container.classList.add('border-dashed');
            }
            checkChanges();
        };

        function checkChanges() {
            let isChanged = false;
            inputs.forEach(input => {
                if(input.name !== '_token' && input.name !== '_method') {
                    if(input.type === 'file') {
                        if(input.files && input.files.length > 0) isChanged = true;
                    } else if(input.type === 'checkbox') {
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
</script>


@endsection

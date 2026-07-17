@extends('layouts.admin')

@section('header_title', 'Edit Pemandu')

@section('content')
<div class="mb-6">
    <a href="{{ route('admin.guides.index') }}" class="inline-flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 transition-colors">
        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        Kembali ke Daftar
    </a>
</div>

<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden max-w-4xl">
    <div class="p-6 sm:p-8 border-b border-gray-100">
        <h3 class="text-lg font-bold text-gray-900">Form Edit Pemandu</h3>
        <p class="text-sm text-gray-500">Ubah informasi detail untuk {{ $guide->name }}.</p>
    </div>
    
    <div class="p-6 sm:p-8">
        <form id="data-form" action="{{ route('admin.guides.update', $guide) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Foto -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Foto Profil</label>
                <div class="flex items-start gap-6">
                    <div class="w-24 h-24 rounded-lg bg-gray-100 border-2 border-dashed border-gray-300 flex items-center justify-center overflow-hidden" id="photo-preview-container">
                        @if($guide->photo_path)
                            <img id="photo-preview" class="w-full h-full object-cover" src="{{ url('storage/' . $guide->photo_path) }}" alt="Preview">
                            <svg id="photo-placeholder" class="w-8 h-8 text-gray-400 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        @else
                            <img id="photo-preview" class="w-full h-full object-cover hidden" src="" alt="Preview">
                            <svg id="photo-placeholder" class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        @endif
                    </div>
                    <div class="flex-1">
                        <input type="file" name="photo" id="photo" accept="image/*" onchange="previewImage(event)" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-yellow-50 file:text-yellow-700 hover:file:bg-yellow-100 transition-colors">
                        <p class="mt-2 text-xs text-gray-500">Format yang diizinkan: JPG, PNG, GIF. Maksimal ukuran 5MB. Biarkan kosong jika tidak ingin mengubah foto.</p>
                        @error('photo')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Name -->
                <div>
                    <label for="name" class="block text-sm font-semibold text-gray-700 mb-1">Nama Lengkap <span class="text-red-500">*</span></label>
                    <input type="text" name="name" id="name" value="{{ old('name', $guide->name) }}" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-yellow-500 focus:ring focus:ring-yellow-500 focus:ring-opacity-50">
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Position -->
                <div>
                    <label for="position" class="block text-sm font-semibold text-gray-700 mb-1">Jabatan <span class="text-red-500">*</span></label>
                    <input type="text" name="position" id="position" value="{{ old('position', $guide->position) }}" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-yellow-500 focus:ring focus:ring-yellow-500 focus:ring-opacity-50">
                    @error('position')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Specialization -->
                <div>
                    <label for="specialization" class="block text-sm font-semibold text-gray-700 mb-1">Spesialisasi</label>
                    <input type="text" name="specialization" id="specialization" value="{{ old('specialization', $guide->specialization) }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-yellow-500 focus:ring focus:ring-yellow-500 focus:ring-opacity-50">
                    @error('specialization')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Phone -->
                <div>
                    <label for="phone" class="block text-sm font-semibold text-gray-700 mb-1">No. Handphone</label>
                    <input type="text" name="phone" id="phone" value="{{ old('phone', $guide->phone) }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-yellow-500 focus:ring focus:ring-yellow-500 focus:ring-opacity-50">
                    @error('phone')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Description -->
            <div>
                <label for="description" class="block text-sm font-semibold text-gray-700 mb-1">Deskripsi / Bio Singkat</label>
                <textarea name="description" id="description" rows="4" class="w-full rounded-md border-gray-300 shadow-sm focus:border-yellow-500 focus:ring focus:ring-yellow-500 focus:ring-opacity-50">{{ old('description', $guide->description) }}</textarea>
                @error('description')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

                        <!-- Order -->
            <div>
                <label for="order" class="block text-sm font-semibold text-gray-700 mb-1">Urutan Tampil <span class="text-red-500">*</span></label>
                <input type="number" name="order" id="order" value="{{ old('order', $guide->order) }}" required min="0" class="w-24 rounded-md border-gray-300 shadow-sm focus:border-yellow-500 focus:ring focus:ring-yellow-500 focus:ring-opacity-50">
                <p class="text-xs text-gray-500 mt-1">Angka terkecil (contoh: 1) akan ditampilkan paling awal. Jika 0, akan diurutkan berdasarkan tanggal terbaru.</p>
                @error('order')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Buttons -->
            <div class="flex items-center justify-end pt-4 border-t border-gray-100 gap-3">
                <a href="{{ route('admin.guides.index') }}" class="px-5 py-2.5 bg-white border border-gray-300 rounded-lg font-bold text-gray-700 text-sm hover:bg-gray-50 focus:outline-none transition-all shadow-sm">Batal</a>
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

        window.previewImage = function(event) {
            const input = event.target;
            const preview = document.getElementById('photo-preview');
            const placeholder = document.getElementById('photo-placeholder');
            
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    if (preview) {
                        preview.src = e.target.result;
                        preview.classList.remove('hidden');
                    }
                    if (placeholder) {
                        placeholder.classList.add('hidden');
                    }
                }
                reader.readAsDataURL(input.files[0]);
            }
            checkChanges();
        };

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
</script>
@endsection

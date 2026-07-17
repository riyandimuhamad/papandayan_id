@extends('layouts.admin')

@section('header_title', 'Edit Testimoni')

@section('content')
<div class="mb-6">
    <a href="{{ route('admin.testimonials.index') }}" class="inline-flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 transition-colors">
        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        Kembali ke Daftar
    </a>
</div>

<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden max-w-4xl">
    <div class="p-6 sm:p-8 border-b border-gray-100">
        <h3 class="text-lg font-bold text-gray-900">Form Edit Testimoni</h3>
        <p class="text-sm text-gray-500">Ubah ulasan dari klien {{ $testimonial->customer_name }}.</p>
    </div>
    
    <div class="p-6 sm:p-8">
        <form id="data-form" action="{{ route('admin.testimonials.update', $testimonial) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Avatar -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Foto Klien (Avatar)</label>
                <div class="flex items-center gap-6">
                    <div class="w-20 h-20 rounded-full bg-gray-100 border-2 border-dashed border-gray-300 flex items-center justify-center overflow-hidden" id="photo-preview-container">
                        @if($testimonial->avatar_path)
                            <img id="photo-preview" class="w-full h-full object-cover" src="{{ url('storage/' . $testimonial->avatar_path) }}" alt="Preview">
                            <svg id="photo-placeholder" class="w-8 h-8 text-gray-400 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        @else
                            <img id="photo-preview" class="w-full h-full object-cover hidden" src="" alt="Preview">
                            <svg id="photo-placeholder" class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        @endif
                    </div>
                    <div class="flex-1">
                        <input type="file" name="avatar" id="avatar" accept="image/*" onchange="previewImage(event)" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-yellow-50 file:text-yellow-700 hover:file:bg-yellow-100 transition-colors">
                        <p class="mt-2 text-xs text-gray-500">Format: JPG, PNG, GIF. Maksimal: 2MB. Biarkan kosong jika tidak mengubah foto.</p>
                        @error('avatar')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Customer Name -->
                <div>
                    <label for="customer_name" class="block text-sm font-semibold text-gray-700 mb-1">Nama Klien <span class="text-red-500">*</span></label>
                    <input type="text" name="customer_name" id="customer_name" value="{{ old('customer_name', $testimonial->customer_name) }}" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-yellow-500 focus:ring focus:ring-yellow-500 focus:ring-opacity-50">
                    @error('customer_name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Trip Date -->
                <div>
                    <label for="trip_date" class="block text-sm font-semibold text-gray-700 mb-1">Tanggal Trip</label>
                    <input type="date" name="trip_date" id="trip_date" value="{{ old('trip_date', $testimonial->trip_date) }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-yellow-500 focus:ring focus:ring-yellow-500 focus:ring-opacity-50">
                    @error('trip_date')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Package (Optional) -->
                <div>
                    <label for="package_id" class="block text-sm font-semibold text-gray-700 mb-1">Terkait Paket Pendakian (Opsional)</label>
                    <select name="package_id" id="package_id" class="w-full rounded-md border-gray-300 shadow-sm focus:border-yellow-500 focus:ring focus:ring-yellow-500 focus:ring-opacity-50">
                        <option value="">Pilih Paket...</option>
                        @foreach($packages as $package)
                            <option value="{{ $package->id }}" {{ old('package_id', $testimonial->package_id) == $package->id ? 'selected' : '' }}>
                                {{ $package->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('package_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Rating -->
                <div>
                    <label for="rating" class="block text-sm font-semibold text-gray-700 mb-1">Rating (1-5) <span class="text-red-500">*</span></label>
                    <select name="rating" id="rating" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-yellow-500 focus:ring focus:ring-yellow-500 focus:ring-opacity-50">
                        <option value="5" {{ old('rating', $testimonial->rating) == 5 ? 'selected' : '' }}>5 - Sangat Puas 🌟🌟🌟🌟🌟</option>
                        <option value="4" {{ old('rating', $testimonial->rating) == 4 ? 'selected' : '' }}>4 - Puas 🌟🌟🌟🌟</option>
                        <option value="3" {{ old('rating', $testimonial->rating) == 3 ? 'selected' : '' }}>3 - Biasa 🌟🌟🌟</option>
                        <option value="2" {{ old('rating', $testimonial->rating) == 2 ? 'selected' : '' }}>2 - Kurang Puas 🌟🌟</option>
                        <option value="1" {{ old('rating', $testimonial->rating) == 1 ? 'selected' : '' }}>1 - Kecewa 🌟</option>
                    </select>
                    @error('rating')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Message -->
            <div>
                <label for="message" class="block text-sm font-semibold text-gray-700 mb-1">Ulasan / Pesan <span class="text-red-500">*</span></label>
                <textarea name="message" id="message" rows="5" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-yellow-500 focus:ring focus:ring-yellow-500 focus:ring-opacity-50">{{ old('message', $testimonial->message) }}</textarea>
                @error('message')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

                        <!-- Order -->
            <div>
                <label for="order" class="block text-sm font-semibold text-gray-700 mb-1">Urutan Tampil <span class="text-red-500">*</span></label>
                <input type="number" name="order" id="order" value="{{ old('order', $testimonial->order) }}" required min="0" class="w-24 rounded-md border-gray-300 shadow-sm focus:border-yellow-500 focus:ring focus:ring-yellow-500 focus:ring-opacity-50">
                <p class="text-xs text-gray-500 mt-1">Angka terkecil (contoh: 1) akan ditampilkan paling awal. Jika 0, akan diurutkan berdasarkan tanggal terbaru.</p>
                @error('order')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Buttons -->
            <div class="flex items-center justify-end pt-4 border-t border-gray-100 gap-3">
                <a href="{{ route('admin.testimonials.index') }}" class="px-5 py-2.5 bg-white border border-gray-300 rounded-lg font-bold text-gray-700 text-sm hover:bg-gray-50 focus:outline-none transition-all shadow-sm">Batal</a>
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

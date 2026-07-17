@extends('layouts.admin')

@section('header_title', 'Pengaturan Website')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <div>
        <h2 class="text-xl font-bold text-gray-800">Pengaturan Website</h2>
        <p class="text-sm text-gray-500">Kelola teks, deskripsi, dan kontak yang tampil di halaman depan website.</p>
    </div>
    <div class="flex items-center gap-3">
        <button type="button" id="btn-edit" class="px-5 py-2.5 bg-slate-900 text-white rounded-lg font-bold text-sm hover:bg-slate-800 transition-all shadow-md flex items-center">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
            Edit Pengaturan
        </button>
        <div id="action-buttons" class="hidden flex items-center gap-3">
            <button type="button" id="btn-cancel" class="px-5 py-2.5 bg-white border border-gray-300 rounded-lg font-bold text-gray-700 text-sm hover:bg-gray-50 focus:outline-none transition-all shadow-sm">
                Batal
            </button>
            <button type="submit" form="settings-form" id="btn-submit" class="px-5 py-2.5 bg-gray-300 border border-transparent rounded-lg font-bold text-gray-500 text-sm cursor-not-allowed focus:outline-none transition-all shadow-md" disabled>
                Simpan Perubahan
            </button>
        </div>
    </div>
</div>

@if(session('success'))
<div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-700 rounded-lg flex items-center">
    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
    <span class="font-medium">{{ session('success') }}</span>
</div>
@endif

<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
    <form id="settings-form" action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data" class="divide-y divide-gray-100">
        @csrf
        @method('PUT')
        
        <!-- Informasi Umum -->
        <div class="p-6 sm:p-8">
            <h3 class="text-lg font-bold text-gray-900 mb-6">1. Informasi Umum</h3>
            <div class="space-y-6 max-w-4xl">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Deskripsi Footer Singkat</label>
                    <textarea name="footer_description" rows="3" class="w-full rounded-md border-gray-300 shadow-sm focus:border-yellow-500 focus:ring focus:ring-yellow-500 focus:ring-opacity-50 transition-colors">{{ old('footer_description', $settings['footer_description']->value ?? '') }}</textarea>
                </div>
            </div>
        </div>

        <!-- Kontak & Sosial Media -->
        <div class="p-6 sm:p-8">
            <h3 class="text-lg font-bold text-gray-900 mb-6">2. Kontak & Sosial Media</h3>
            <div class="space-y-6 max-w-4xl">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Nomor WhatsApp</label>
                        <input type="text" name="contact_whatsapp" value="{{ old('contact_whatsapp', $settings['contact_whatsapp']->value ?? '') }}" placeholder="+62 8..." class="w-full rounded-md border-gray-300 shadow-sm focus:border-yellow-500 focus:ring focus:ring-yellow-500 focus:ring-opacity-50 transition-colors">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Alamat Email</label>
                        <input type="email" name="contact_email" value="{{ old('contact_email', $settings['contact_email']->value ?? '') }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-yellow-500 focus:ring focus:ring-yellow-500 focus:ring-opacity-50 transition-colors">
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Link Instagram</label>
                    <input type="url" name="social_instagram" value="{{ old('social_instagram', $settings['social_instagram']->value ?? '') }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-yellow-500 focus:ring focus:ring-yellow-500 focus:ring-opacity-50 transition-colors">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Alamat Basecamp</label>
                    <textarea name="contact_address" rows="2" class="w-full rounded-md border-gray-300 shadow-sm focus:border-yellow-500 focus:ring focus:ring-yellow-500 focus:ring-opacity-50 transition-colors">{{ old('contact_address', $settings['contact_address']->value ?? '') }}</textarea>
                </div>
            </div>
        </div>

        <!-- Tentang Kami (Visi & Misi) -->
        <div class="p-6 sm:p-8">
            <h3 class="text-lg font-bold text-gray-900 mb-6">3. Tentang Kami & Visi Misi</h3>
            <div class="space-y-6 max-w-4xl">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Judul Tentang Kami</label>
                    <input type="text" name="about_title" value="{{ old('about_title', $settings['about_title']->value ?? '') }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-yellow-500 focus:ring focus:ring-yellow-500 focus:ring-opacity-50 transition-colors">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Deskripsi Panjang (Tentang Kami)</label>
                    <textarea name="about_description" rows="5" class="w-full rounded-md border-gray-300 shadow-sm focus:border-yellow-500 focus:ring focus:ring-yellow-500 focus:ring-opacity-50 transition-colors">{{ old('about_description', $settings['about_description']->value ?? '') }}</textarea>
                </div>
                
                <div class="pt-4">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Foto / Gambar (Tentang Kami)</label>
                    <div class="flex items-center gap-6">
                        <div class="w-48 h-32 rounded-lg bg-gray-100 border-2 border-dashed border-gray-300 flex items-center justify-center overflow-hidden">
                            @if(isset($settings['about_image']) && $settings['about_image']->value)
                                @php $imgSrc = strpos($settings['about_image']->value, 'http') === 0 ? $settings['about_image']->value : asset($settings['about_image']->value); @endphp
                                <img src="{{ $imgSrc }}" data-original-src="{{ $imgSrc }}" alt="Preview" class="w-full h-full object-cover" id="photo-preview">
                                <span id="photo-placeholder" class="text-gray-400 text-sm hidden">Tidak ada gambar</span>
                            @else
                                <img src="" data-original-src="" alt="Preview" class="w-full h-full object-cover hidden" id="photo-preview">
                                <span id="photo-placeholder" class="text-gray-400 text-sm">Tidak ada gambar</span>
                            @endif
                        </div>
                        <div class="flex-1">
                            <input type="file" name="about_image_file" accept="image/*" onchange="previewImage(event)" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-yellow-50 file:text-yellow-700 hover:file:bg-yellow-100 transition-colors cursor-pointer disabled:opacity-50 disabled:cursor-not-allowed">
                            <p class="mt-2 text-xs text-gray-500">Biarkan kosong jika tidak ingin mengubah gambar.</p>
                        </div>
                    </div>
                </div>

                <div class="pt-4 grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Deskripsi Visi</label>
                        <textarea name="vision_description" rows="5" class="w-full rounded-md border-gray-300 shadow-sm focus:border-yellow-500 focus:ring focus:ring-yellow-500 focus:ring-opacity-50 transition-colors">{{ old('vision_description', $settings['vision_description']->value ?? '') }}</textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Misi (Pisahkan setiap poin dengan baris baru / Enter)</label>
                        <textarea name="mission_description" rows="5" class="w-full rounded-md border-gray-300 shadow-sm focus:border-yellow-500 focus:ring focus:ring-yellow-500 focus:ring-opacity-50 transition-colors">{{ old('mission_description', strip_tags(str_replace(['<ul>', '</ul>', '<li>', '</li>'], ['', '', '', "\n"], $settings['mission_description']->value ?? ''))) }}</textarea>
                        <p class="text-xs text-gray-500 mt-1">Contoh:<br>Menyediakan layanan aman.<br>Memberikan fasilitas premium.</p>
                    </div>
                </div>
            </div>
        </div>

    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('settings-form');
        const inputs = form.querySelectorAll('input, textarea');
        const btnEdit = document.getElementById('btn-edit');
        const btnCancel = document.getElementById('btn-cancel');
        const btnSubmit = document.getElementById('btn-submit');
        const actionButtons = document.getElementById('action-buttons');
        
        // Save initial state and disable inputs
        inputs.forEach(input => {
            if(input.name !== '_token' && input.name !== '_method') {
                if(input.type === 'file') {
                    input.dataset.initial = '';
                } else {
                    input.dataset.initial = input.value;
                }
                // disable by default
                input.disabled = true;
                input.classList.add('bg-gray-100', 'cursor-not-allowed');
                
                // add change listener
                input.addEventListener('input', checkChanges);
                input.addEventListener('change', checkChanges);
            }
        });

        // Photo preview logic
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
            } else {
                // If cancelled file selection
                if(preview && preview.dataset.originalSrc) {
                    preview.src = preview.dataset.originalSrc;
                    preview.classList.remove('hidden');
                    if (placeholder) placeholder.classList.add('hidden');
                } else {
                    if (preview) preview.classList.add('hidden');
                    if (placeholder) placeholder.classList.remove('hidden');
                }
            }
            checkChanges();
        };

        function checkChanges() {
            let isChanged = false;
            inputs.forEach(input => {
                if(input.name !== '_token' && input.name !== '_method') {
                    if(input.type === 'file') {
                        if(input.files && input.files.length > 0) isChanged = true;
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

        btnEdit.addEventListener('click', function() {
            btnEdit.classList.add('hidden');
            actionButtons.classList.remove('hidden');
            
            inputs.forEach(input => {
                if(input.name !== '_token' && input.name !== '_method') {
                    input.disabled = false;
                    input.classList.remove('bg-gray-100', 'cursor-not-allowed');
                }
            });
        });

        btnCancel.addEventListener('click', function() {
            btnEdit.classList.remove('hidden');
            actionButtons.classList.add('hidden');
            
            form.reset(); // Reset to original values
            
            // Reset photo preview if exists
            const preview = document.getElementById('photo-preview');
            const placeholder = document.getElementById('photo-placeholder');
            const originalSrc = preview ? preview.dataset.originalSrc : '';
            if(originalSrc) {
                preview.src = originalSrc;
                preview.classList.remove('hidden');
                if (placeholder) placeholder.classList.add('hidden');
            } else {
                if (preview) preview.classList.add('hidden');
                if (placeholder) placeholder.classList.remove('hidden');
            }

            inputs.forEach(input => {
                if(input.name !== '_token' && input.name !== '_method') {
                    input.disabled = true;
                    input.classList.add('bg-gray-100', 'cursor-not-allowed');
                }
            });
            
            checkChanges();
        });
    });
</script>

@endsection

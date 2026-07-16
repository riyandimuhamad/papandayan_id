@extends('layouts.admin')

@section('header_title', 'Tulis Artikel Baru')

@section('content')
<div class="mb-6">
    <a href="{{ route('admin.articles.index') }}" class="inline-flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 transition-colors">
        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        Kembali ke Daftar
    </a>
</div>

<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="p-6 sm:p-8 border-b border-gray-100">
        <h3 class="text-lg font-bold text-gray-900">Tulis Artikel / Jurnal</h3>
        <p class="text-sm text-gray-500">Buat tulisan baru untuk dipublikasikan di blog papandayan_id.</p>
    </div>
    
    <div class="p-6 sm:p-8">
        <form action="{{ route('admin.articles.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <!-- Thumbnail Image -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Gambar Utama (Thumbnail)</label>
                <div class="flex items-start gap-6">
                    <div class="w-48 h-32 rounded-lg bg-gray-100 border-2 border-dashed border-gray-300 flex items-center justify-center overflow-hidden" id="photo-preview-container">
                        <svg id="photo-placeholder" class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        <img id="photo-preview" class="w-full h-full object-cover hidden" src="" alt="Preview">
                    </div>
                    <div class="flex-1">
                        <input type="file" name="thumbnail" id="thumbnail" accept="image/*" onchange="previewImage(event)" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-yellow-50 file:text-yellow-700 hover:file:bg-yellow-100 transition-colors">
                        <p class="mt-2 text-xs text-gray-500">Format yang diizinkan: JPG, PNG, GIF. Maksimal ukuran 5MB.</p>
                        @error('thumbnail')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 border-t border-gray-100 pt-6">
                <!-- Title & Category (Left col: 2/3) -->
                <div class="md:col-span-2 space-y-6">
                    <!-- Title -->
                    <div>
                        <label for="title" class="block text-sm font-semibold text-gray-700 mb-1">Judul Artikel <span class="text-red-500">*</span></label>
                        <input type="text" name="title" id="title" value="{{ old('title') }}" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-yellow-500 focus:ring focus:ring-yellow-500 focus:ring-opacity-50 text-lg">
                        @error('title')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Content (TinyMCE) -->
                    <div>
                        <label for="content" class="block text-sm font-semibold text-gray-700 mb-1">Isi Konten <span class="text-red-500">*</span></label>
                        <textarea name="content" id="content" class="tinymce-editor">{{ old('content') }}</textarea>
                        @error('content')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Settings (Right col: 1/3) -->
                <div class="space-y-6 bg-gray-50 p-4 rounded-lg border border-gray-200 h-fit">
                    <h4 class="font-semibold text-gray-900 border-b border-gray-200 pb-2">Pengaturan</h4>
                    
                    <!-- Status -->
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status Publikasi</label>
                        <select name="status" id="status" class="w-full rounded-md border-gray-300 shadow-sm focus:border-yellow-500 focus:ring focus:ring-yellow-500 focus:ring-opacity-50">
                            <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft (Simpan sementara)</option>
                            <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>Published (Terbitkan sekarang)</option>
                        </select>
                        @error('status')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Category -->
                    <div>
                        <label for="category" class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                        <input type="text" name="category" id="category" placeholder="Misal: Tips Pendakian, Info" value="{{ old('category') }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-yellow-500 focus:ring focus:ring-yellow-500 focus:ring-opacity-50">
                        @error('category')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="pt-4 border-t border-gray-200">
                        <h5 class="text-sm font-medium text-gray-900 mb-3">SEO Meta Data (Opsional)</h5>
                        
                        <!-- Meta Title -->
                        <div class="mb-3">
                            <label for="meta_title" class="block text-xs text-gray-600 mb-1">Meta Title</label>
                            <input type="text" name="meta_title" id="meta_title" value="{{ old('meta_title') }}" class="w-full rounded-md border-gray-300 shadow-sm text-sm focus:border-yellow-500 focus:ring focus:ring-yellow-500 focus:ring-opacity-50">
                        </div>
                        
                        <!-- Meta Description -->
                        <div class="mb-3">
                            <label for="meta_description" class="block text-xs text-gray-600 mb-1">Meta Description</label>
                            <textarea name="meta_description" id="meta_description" rows="2" class="w-full rounded-md border-gray-300 shadow-sm text-sm focus:border-yellow-500 focus:ring focus:ring-yellow-500 focus:ring-opacity-50">{{ old('meta_description') }}</textarea>
                        </div>

                        <!-- Meta Keywords -->
                        <div>
                            <label for="meta_keywords" class="block text-xs text-gray-600 mb-1">Keywords</label>
                            <input type="text" name="meta_keywords" id="meta_keywords" placeholder="pisahkan, dengan, koma" value="{{ old('meta_keywords') }}" class="w-full rounded-md border-gray-300 shadow-sm text-sm focus:border-yellow-500 focus:ring focus:ring-yellow-500 focus:ring-opacity-50">
                        </div>
                    </div>
                </div>
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

            <!-- Buttons -->
            <div class="flex items-center justify-end pt-4 border-t border-gray-100 gap-3">
                <button type="reset" class="px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 transition ease-in-out duration-150">Batal</button>
                <button type="submit" class="px-4 py-2 bg-slate-900 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-slate-800 focus:bg-slate-800 active:bg-slate-900 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-sm">Simpan Artikel</button>
            </div>
        </form>
    </div>
</div>

<!-- CKEditor 5 CDN -->
<style>
    .ck-editor__editable_inline {
        min-height: 500px;
        font-family: 'Plus Jakarta Sans', sans-serif;
    }
</style>
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create( document.querySelector( '.tinymce-editor' ), {
            toolbar: [ 'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote', 'undo', 'redo' ]
        })
        .catch( error => {
            console.error( error );
        } );

    function previewImage(event) {
        var reader = new FileReader();
        reader.onload = function() {
            var output = document.getElementById('photo-preview');
            var placeholder = document.getElementById('photo-placeholder');
            output.src = reader.result;
            output.classList.remove('hidden');
            placeholder.classList.add('hidden');
        }
        if(event.target.files[0]) {
            reader.readAsDataURL(event.target.files[0]);
        }
    }
</script>
@endsection

@extends('layouts.admin')

@section('header_title', 'Manajemen Slider Beranda')

@section('content')
<div class="mb-6 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
    <div>
        <h2 class="text-xl font-bold text-gray-800">Daftar Slider Beranda</h2>
        <p class="text-sm text-gray-500">Kelola gambar dan caption yang tampil pada slider utama halaman depan.</p>
    </div>
    <a href="{{ route('admin.hero-slides.create') }}" class="inline-flex items-center px-5 py-2.5 bg-slate-900 text-white rounded-lg font-bold text-sm hover:bg-slate-800 transition-all shadow-md">
        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
        Tambah Slider
    </a>
</div>

@if(session('success'))
<div x-data="{ show: true }" x-show="show" x-transition.duration.500ms class="mb-6 bg-green-50 border-l-4 border-green-500 p-4 rounded-md shadow-sm flex justify-between items-start">
    <div class="flex">
        <div class="flex-shrink-0">
            <svg class="h-5 w-5 text-green-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" /></svg>
        </div>
        <div class="ml-3">
            <p class="text-sm text-green-700">{{ session('success') }}</p>
        </div>
    </div>
    <button @click="show = false" class="text-green-500 hover:text-green-700 focus:outline-none"><svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg></button>
</div>
@endif

<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Gambar</th>
                    <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Caption / Teks</th>
                    <th scope="col" class="px-6 py-4 text-center text-xs font-bold text-gray-500 uppercase tracking-wider">Status</th>
                    <th scope="col" class="px-6 py-4 text-center text-xs font-bold text-gray-500 uppercase tracking-wider">Urutan</th>
                    <th scope="col" class="px-6 py-4 text-right text-xs font-bold text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($slides as $slide)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="h-16 w-32 rounded-lg overflow-hidden border border-gray-200 shadow-sm">
                            <img class="h-full w-full object-cover" src="{{ strpos($slide->image, 'http') === 0 ? $slide->image : asset($slide->image) }}" alt="Slider">
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="text-sm font-bold text-gray-900">{{ $slide->title }}</div>
                        <div class="text-xs text-gray-500 mt-1 line-clamp-2 max-w-xs">{{ $slide->subtitle }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-center">
                        @if($slide->is_active)
                            <span class="px-2.5 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Aktif</span>
                        @else
                            <span class="px-2.5 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Nonaktif</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium text-gray-900">
                        {{ $slide->order }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <div class="flex items-center justify-end gap-3">
                            <a href="{{ route('admin.hero-slides.edit', $slide) }}" class="text-yellow-600 hover:text-yellow-900 transition-colors tooltip-btn" title="Edit">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                            </a>
                            <form action="{{ route('admin.hero-slides.destroy', $slide) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus slider ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900 transition-colors tooltip-btn" title="Hapus">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-12 text-center">
                        <svg class="mx-auto h-12 w-12 text-gray-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        <p class="text-gray-500 font-medium">Belum ada slider yang ditambahkan.</p>
                        <a href="{{ route('admin.hero-slides.create') }}" class="mt-4 inline-block text-yellow-600 hover:text-yellow-700 font-medium">Tambah Slider Pertama</a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

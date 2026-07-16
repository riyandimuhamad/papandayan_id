@extends('layouts.admin')

@section('header_title', 'Dashboard')

@section('content')
<div class="bg-white overflow-hidden shadow-sm rounded-xl border border-gray-100">
    <div class="p-6 text-gray-900 flex items-center justify-between">
        <div>
            <h2 class="text-lg font-bold mb-1">Selamat datang kembali, {{ Auth::user()->name }}!</h2>
            <p class="text-sm text-gray-500">Anda berhasil masuk ke Admin Panel papandayan_id.</p>
        </div>
        <div class="hidden sm:block">
            <svg class="w-16 h-16 text-yellow-500 opacity-20" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2L2 22h20L12 2zm0 4.2l7 13.8H5l7-13.8z"></path></svg>
        </div>
    </div>
</div>

<div class="mt-8 grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-5">
    <!-- Stat Card 1 -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        <div class="flex items-center">
            <div class="flex-shrink-0 bg-blue-50 text-blue-600 rounded-lg p-3">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21l-3 6 3 6h-8.5l-1-1H5a2 2 0 00-2 2zm9-13.5V9"></path></svg>
            </div>
            <div class="ml-4">
                <h3 class="text-sm font-medium text-gray-500">Total Paket</h3>
                <span class="text-2xl font-bold text-gray-900">{{ $countPackages ?? 0 }}</span>
            </div>
        </div>
    </div>
    
    <!-- Stat Card 2 -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        <div class="flex items-center">
            <div class="flex-shrink-0 bg-yellow-50 text-yellow-600 rounded-lg p-3">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
            </div>
            <div class="ml-4">
                <h3 class="text-sm font-medium text-gray-500">Tim Pemandu</h3>
                <span class="text-2xl font-bold text-gray-900">{{ $countGuides ?? 0 }}</span>
            </div>
        </div>
    </div>
    
    <!-- Stat Card 3 -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        <div class="flex items-center">
            <div class="flex-shrink-0 bg-green-50 text-green-600 rounded-lg p-3">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
            </div>
            <div class="ml-4">
                <h3 class="text-sm font-medium text-gray-500">Artikel Blog</h3>
                <span class="text-2xl font-bold text-gray-900">{{ $countArticles ?? 0 }}</span>
            </div>
        </div>
    </div>
    
    <!-- Stat Card 4 -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        <div class="flex items-center">
            <div class="flex-shrink-0 bg-purple-50 text-purple-600 rounded-lg p-3">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
            </div>
            <div class="ml-4">
                <h3 class="text-sm font-medium text-gray-500">Testimoni</h3>
                <span class="text-2xl font-bold text-gray-900">{{ $countTestimonials ?? 0 }}</span>
            </div>
        </div>
    </div>

    <!-- Stat Card 5 (Dokumentasi) -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        <div class="flex items-center">
            <div class="flex-shrink-0 bg-red-50 text-red-600 rounded-lg p-3">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
            </div>
            <div class="ml-4">
                <h3 class="text-sm font-medium text-gray-500">Dokumentasi</h3>
                <span class="text-2xl font-bold text-gray-900">{{ $countDocumentations ?? 0 }}</span>
            </div>
        </div>
    </div>
</div>
@endsection

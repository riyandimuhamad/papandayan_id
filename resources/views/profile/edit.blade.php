@extends('layouts.admin')

@section('header_title', 'Profil Akun')

@section('content')
<div class="mb-6">
    <a href="{{ route('dashboard') }}" class="inline-flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 transition-colors mb-4">
        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        Kembali ke Dashboard
    </a>
    <h2 class="text-xl font-bold text-gray-800">Pengaturan Profil</h2>
    <p class="text-sm text-gray-500">Perbarui informasi profil dan kata sandi Anda.</p>
</div>

<div class="space-y-6">
    <div class="p-6 bg-white shadow-sm border border-gray-100 rounded-xl">
        <div class="max-w-xl">
            @include('profile.partials.update-profile-information-form')
        </div>
    </div>

    <div class="p-6 bg-white shadow-sm border border-gray-100 rounded-xl">
        <div class="max-w-xl">
            @include('profile.partials.update-password-form')
        </div>
    </div>

    <div class="p-6 bg-white shadow-sm border border-gray-100 rounded-xl">
        <div class="max-w-xl">
            @include('profile.partials.delete-user-form')
        </div>
    </div>
</div>
@endsection

@extends('layouts.public')


@section('content')
<!-- Hero Slider Section -->
<div x-data="{ 
        activeSlide: 0,
        slides: [
            @foreach($heroSlides as $slide)
            { 
                image: '{{ strpos($slide->image, 'http') === 0 ? $slide->image : asset($slide->image) }}', 
                title: '{{ addslashes($slide->title) }}', 
                subtitle: '{{ addslashes($slide->subtitle) }}' 
            },
            @endforeach
            @if($heroSlides->isEmpty())
            { image: 'https://images.unsplash.com/photo-1542308111-e63ccce11666?q=80&w=1920&auto=format&fit=crop', title: 'Welcome', subtitle: 'No slides available' }
            @endif
        ],
        next() { this.activeSlide = this.activeSlide === this.slides.length - 1 ? 0 : this.activeSlide + 1 },
        prev() { this.activeSlide = this.activeSlide === 0 ? this.slides.length - 1 : this.activeSlide - 1 },
        init() { setInterval(() => { this.next() }, 5000) }
    }" 
    class="relative h-screen w-full overflow-hidden">
    
    <!-- Slides -->
    <template x-for="(slide, index) in slides" :key="index">
        <div x-show="activeSlide === index" 
             x-transition:enter="transition ease-out duration-1000"
             x-transition:enter-start="opacity-0 scale-105"
             x-transition:enter-end="opacity-100 scale-100"
             x-transition:leave="transition ease-in duration-1000"
             x-transition:leave-start="opacity-100 scale-100"
             x-transition:leave-end="opacity-0 scale-105"
             class="absolute inset-0">
            <!-- Background Image -->
            <div class="absolute inset-0 bg-cover bg-center" :style="'background-image: url(' + slide.image + ')'"></div>
            <!-- Overlay -->
            <div class="absolute inset-0 bg-slate-900/60"></div>
            
            <!-- Content -->
            <div class="absolute inset-0 flex items-center justify-center text-center px-4">
                <div class="max-w-4xl">
                    <h1 class="text-4xl md:text-6xl font-bold text-white mb-6 tracking-tight drop-shadow-lg" x-text="slide.title"></h1>
                    <p class="text-lg md:text-xl text-slate-200 mb-10 font-light drop-shadow-md" x-text="slide.subtitle"></p>
                    <a href="#packages" class="inline-block px-8 py-4 bg-yellow-500 hover:bg-yellow-400 text-slate-900 font-bold rounded-full transition-all hover:scale-105 shadow-xl text-lg">
                        Lihat Paket Trip
                    </a>
                </div>
            </div>
        </div>
    </template>

    <!-- Controls -->
    <button @click="prev" class="absolute left-4 md:left-10 top-1/2 -translate-y-1/2 w-12 h-12 rounded-full bg-white/10 hover:bg-white/20 backdrop-blur text-white flex items-center justify-center transition-all z-20">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
    </button>
    <button @click="next" class="absolute right-4 md:right-10 top-1/2 -translate-y-1/2 w-12 h-12 rounded-full bg-white/10 hover:bg-white/20 backdrop-blur text-white flex items-center justify-center transition-all z-20">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
    </button>
</div>

<!-- About Section -->
<section id="about" class="py-24 bg-white relative">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-16 items-center">
            <div>
                <h2 class="text-3xl md:text-4xl font-bold text-slate-900 mb-6 relative inline-block">
                    {{ $settings['about_title']->value ?? 'Tentang papandayan_id' }}
                    <span class="absolute -bottom-2 left-0 w-2/3 h-1.5 bg-yellow-500 rounded-full"></span>
                </h2>
                <p class="text-slate-600 mb-6 leading-relaxed text-lg whitespace-pre-line">
                    {{ $settings['about_description']->value ?? 'papandayan_id adalah penyedia layanan operator trip resmi dan terpercaya untuk kawasan Gunung Papandayan.' }}
                </p>
                
                <div class="space-y-6 mt-8">
                    <!-- Visi -->
                    <div class="bg-slate-50 p-6 rounded-2xl border border-slate-100 shadow-sm">
                        <div class="flex items-start">
                            <div class="flex-shrink-0 mt-1">
                                <div class="w-10 h-10 rounded-full bg-yellow-100 flex items-center justify-center text-yellow-600">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <h4 class="text-lg font-bold text-slate-900 mb-2">Visi Kami</h4>
                                <p class="text-slate-600 leading-relaxed text-sm whitespace-pre-line">{{ $settings['vision_description']->value ?? 'Menjadi operator wisata alam terkemuka.' }}</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Misi -->
                    <div class="bg-slate-50 p-6 rounded-2xl border border-slate-100 shadow-sm">
                        <div class="flex items-start">
                            <div class="flex-shrink-0 mt-1">
                                <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-600">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <h4 class="text-lg font-bold text-slate-900 mb-2">Misi Kami</h4>
                                <ul class="text-slate-600 text-sm space-y-2 list-disc list-outside ml-4">
                                    @php
                                        $missionText = strip_tags(str_replace(['<ul>', '</ul>', '<li>', '</li>'], ['', '', '', "\n"], $settings['mission_description']->value ?? 'Memberikan pelayanan terbaik.'));
                                        $missions = array_filter(array_map('trim', explode("\n", $missionText)));
                                    @endphp
                                    @foreach($missions as $misi)
                                        <li>{{ $misi }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="relative">
                <div class="absolute inset-0 bg-yellow-500 transform translate-x-6 translate-y-6 rounded-3xl"></div>
                @php
                    $aboutImg = $settings['about_image']->value ?? 'https://images.unsplash.com/photo-1522163182402-834f871fd851?q=80&w=1000&auto=format&fit=crop';
                    if (strpos($aboutImg, 'http') !== 0) $aboutImg = asset($aboutImg);
                @endphp
                <img src="{{ $aboutImg }}" alt="Tim papandayan_id" class="relative z-10 rounded-3xl w-full h-auto object-cover shadow-2xl">
            </div>
        </div>
    </div>
</section>

<!-- Mengapa Memilih Kami -->
<section class="py-20 bg-slate-900 text-white relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold mb-4">Kenapa Memilih Kami?</h2>
            <p class="text-slate-400 max-w-2xl mx-auto text-lg">Alasan mengapa ribuan pendaki mempercayakan perjalanan mereka kepada papandayan_id.</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <div class="bg-slate-800/50 backdrop-blur border border-slate-700 p-8 rounded-2xl text-center hover:-translate-y-2 transition-transform duration-300">
                <div class="w-16 h-16 bg-yellow-500/20 text-yellow-500 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                </div>
                <h3 class="text-xl font-bold mb-3">Keamanan Terjamin</h3>
                <p class="text-slate-400 text-sm">Dilengkapi dengan SOP keselamatan ketat dan peralatan P3K di setiap perjalanan.</p>
            </div>
            
            <div class="bg-slate-800/50 backdrop-blur border border-slate-700 p-8 rounded-2xl text-center hover:-translate-y-2 transition-transform duration-300">
                <div class="w-16 h-16 bg-blue-500/20 text-blue-400 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                </div>
                <h3 class="text-xl font-bold mb-3">Guide Bersertifikat</h3>
                <p class="text-slate-400 text-sm">Pemandu lokal profesional, ramah, dan sangat berpengalaman di medan Gunung Papandayan.</p>
            </div>
            
            <div class="bg-slate-800/50 backdrop-blur border border-slate-700 p-8 rounded-2xl text-center hover:-translate-y-2 transition-transform duration-300">
                <div class="w-16 h-16 bg-green-500/20 text-green-400 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                </div>
                <h3 class="text-xl font-bold mb-3">Harga Transparan</h3>
                <p class="text-slate-400 text-sm">Tidak ada biaya tersembunyi. Harga yang Anda bayar sudah mencakup semua fasilitas yang dijanjikan.</p>
            </div>
            
            <div class="bg-slate-800/50 backdrop-blur border border-slate-700 p-8 rounded-2xl text-center hover:-translate-y-2 transition-transform duration-300">
                <div class="w-16 h-16 bg-purple-500/20 text-purple-400 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5"></path></svg>
                </div>
                <h3 class="text-xl font-bold mb-3">Fasilitas Premium</h3>
                <p class="text-slate-400 text-sm">Tenda nyaman, perlengkapan tidur higienis, hingga menu makanan gunung yang lezat dan bergizi.</p>
            </div>
        </div>
    </div>
</section>

<!-- Packages Section (Categorized) -->
<section id="packages" class="py-24 bg-slate-50" x-data="{ activeTab: 'Private Trip' }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-slate-900 mb-4">Layanan & Paket Kami</h2>
            <p class="text-slate-600 max-w-2xl mx-auto text-lg">Pilih layanan yang paling sesuai dengan kebutuhan grup Anda.</p>
        </div>

        <!-- Tabs -->
        <div class="flex flex-wrap justify-center gap-2 sm:gap-4 mb-16">
            <button @click="activeTab = 'Private Trip'" 
                    :class="activeTab === 'Private Trip' ? 'bg-slate-900 text-white shadow-lg' : 'bg-white text-slate-600 hover:bg-slate-100 border border-slate-200'"
                    class="px-6 py-3 rounded-full font-semibold transition-all duration-300">
                Paket Private Trip
            </button>
            <button @click="activeTab = 'Outbound'" 
                    :class="activeTab === 'Outbound' ? 'bg-slate-900 text-white shadow-lg' : 'bg-white text-slate-600 hover:bg-slate-100 border border-slate-200'"
                    class="px-6 py-3 rounded-full font-semibold transition-all duration-300">
                Paket Outbound
            </button>
            <button @click="activeTab = 'Other Services'" 
                    :class="activeTab === 'Other Services' ? 'bg-slate-900 text-white shadow-lg' : 'bg-white text-slate-600 hover:bg-slate-100 border border-slate-200'"
                    class="px-6 py-3 rounded-full font-semibold transition-all duration-300">
                Other Services
            </button>
        </div>

        <!-- Tab Contents -->
        @php
            $categories = ['Private Trip', 'Outbound', 'Other Services'];
        @endphp

        @foreach($categories as $category)
            @php
                $categoryPackages = $packages->where('category', $category);
            @endphp
            <div x-show="activeTab === '{{ $category }}'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" style="display: none;">
                
                @if($categoryPackages->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($categoryPackages as $package)
                    <div class="bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-2xl border border-slate-100 transition-all duration-300 group flex flex-col h-full">
                        <div class="relative h-64 overflow-hidden">
                            @if($package->cover_image)
                                <img src="{{ url('storage/' . $package->cover_image) }}" alt="{{ $package->name }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                            @else
                                <div class="w-full h-full bg-slate-200 flex items-center justify-center text-slate-400">No Image</div>
                            @endif
                            <div class="absolute top-4 right-4 bg-yellow-500 text-slate-900 text-xs font-bold px-3 py-1.5 rounded-full uppercase tracking-wide shadow-md">
                                {{ $package->difficulty }}
                            </div>
                        </div>
                        <div class="p-8 flex flex-col flex-grow">
                            <h3 class="text-2xl font-bold text-slate-900 mb-3">{{ $package->name }}</h3>
                            
                            <div class="flex items-center text-sm text-slate-600 mb-5 space-x-4 bg-slate-50 p-3 rounded-lg">
                                <span class="flex items-center font-medium">
                                    <svg class="w-5 h-5 mr-1.5 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    {{ $package->duration }}
                                </span>
                                <span class="flex items-center font-medium">
                                    <svg class="w-5 h-5 mr-1.5 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                    Max {{ $package->max_people }} pax
                                </span>
                            </div>
                            
                            <p class="text-slate-600 text-sm mb-6 line-clamp-3">
                                {{ $package->description }}
                            </p>
                            
                            <div class="mt-auto pt-6 border-t border-slate-100 flex items-center justify-between">
                                <div>
                                    <p class="text-xs text-slate-400 font-medium uppercase tracking-wider mb-1">Mulai dari</p>
                                    <p class="text-xl font-bold text-slate-900">Rp {{ number_format($package->price, 0, ',', '.') }}</p>
                                </div>
                                <a href="https://wa.me/6281234567890?text=Halo%20Admin,%20saya%20tertarik%20dengan%20{{ urlencode($package->name) }}" target="_blank" class="px-5 py-2.5 bg-slate-900 hover:bg-yellow-500 hover:text-slate-900 text-white text-sm font-bold rounded-xl transition-all shadow-md">
                                    Booking
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <div class="text-center p-16 bg-white rounded-2xl shadow-sm border border-slate-100">
                    <svg class="w-16 h-16 text-slate-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                    <p class="text-slate-500 text-lg">Paket untuk kategori <strong>{{ $category }}</strong> belum tersedia.</p>
                </div>
                @endif
            </div>
        @endforeach
    </div>
</section>

<!-- Gallery / Dokumentasi Trip -->
<section id="gallery" class="py-20 bg-white overflow-hidden">
    <style>
        @keyframes marquee {
            0% { transform: translateX(0); }
            100% { transform: translateX(-50%); }
        }
        .animate-marquee {
            animation: marquee 40s linear infinite;
        }
        .animate-marquee:hover {
            animation-play-state: paused;
        }
    </style>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-slate-900 mb-4">Dokumentasi Trip</h2>
            <p class="text-slate-600 max-w-2xl mx-auto">Momen-momen tak terlupakan yang berhasil diabadikan bersama klien kami.</p>
        </div>
    </div>
        
    @if($documentations->count() > 0)
    <div class="relative w-full py-4 max-w-[100vw]">
        <!-- Gradient edges for smooth fade effect -->
        <div class="absolute top-0 bottom-0 left-0 w-16 md:w-48 bg-gradient-to-r from-white to-transparent z-10 pointer-events-none"></div>
        <div class="absolute top-0 bottom-0 right-0 w-16 md:w-48 bg-gradient-to-l from-white to-transparent z-10 pointer-events-none"></div>
        
        <div class="flex gap-4 md:gap-6 w-max animate-marquee hover:cursor-grab items-center">
            <!-- Original set -->
            @foreach($documentations as $doc)
            <div class="relative h-64 md:h-80 rounded-3xl overflow-hidden group flex-shrink-0 shadow-sm hover:shadow-xl border border-slate-100 transition-all duration-300 bg-slate-50">
                <img src="{{ url('storage/' . $doc->image_path) }}" class="h-full w-auto max-w-none group-hover:scale-105 transition-transform duration-700 ease-out" alt="{{ $doc->caption ?? 'Dokumentasi Papandayan' }}">
                @if($doc->caption)
                <div class="absolute inset-x-0 bottom-0 bg-gradient-to-t from-slate-900/90 via-slate-900/40 to-transparent p-6 opacity-0 group-hover:opacity-100 transition-opacity duration-300 translate-y-4 group-hover:translate-y-0">
                    <p class="text-white text-sm md:text-base font-bold drop-shadow-md">{{ $doc->caption }}</p>
                </div>
                @endif
            </div>
            @endforeach
            
            <!-- Duplicated set for seamless scroll -->
            @foreach($documentations as $doc)
            <div class="relative h-64 md:h-80 rounded-3xl overflow-hidden group flex-shrink-0 shadow-sm hover:shadow-xl border border-slate-100 transition-all duration-300 bg-slate-50" aria-hidden="true">
                <img src="{{ url('storage/' . $doc->image_path) }}" class="h-full w-auto max-w-none group-hover:scale-105 transition-transform duration-700 ease-out" alt="{{ $doc->caption ?? 'Dokumentasi Papandayan' }}">
                @if($doc->caption)
                <div class="absolute inset-x-0 bottom-0 bg-gradient-to-t from-slate-900/90 via-slate-900/40 to-transparent p-6 opacity-0 group-hover:opacity-100 transition-opacity duration-300 translate-y-4 group-hover:translate-y-0">
                    <p class="text-white text-sm md:text-base font-bold drop-shadow-md">{{ $doc->caption }}</p>
                </div>
                @endif
            </div>
            @endforeach
        </div>
    </div>
    @else
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center p-10 bg-slate-50 rounded-2xl border border-slate-100">
            <p class="text-slate-500">Belum ada dokumentasi trip.</p>
        </div>
    </div>
    @endif
</section>

<!-- Informasi Pembayaran -->
<section class="py-24 bg-slate-50 border-y border-slate-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-3xl p-8 md:p-12 shadow-sm border border-slate-100 grid grid-cols-1 lg:grid-cols-12 gap-12 items-start relative overflow-hidden">
            <!-- Dekoratif latar -->
            <div class="absolute top-0 right-0 w-64 h-64 bg-slate-50 rounded-full blur-3xl -mr-32 -mt-32 pointer-events-none"></div>
            
            <!-- Bagian Kiri: Info & Rekening -->
            <div class="lg:col-span-5 text-center lg:text-left relative z-10">
                <div class="w-16 h-16 bg-green-100 text-green-600 rounded-2xl flex items-center justify-center mx-auto lg:mx-0 mb-6 shadow-sm border border-green-200">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                </div>
                <h3 class="text-3xl font-bold text-slate-900 mb-3 tracking-tight">Informasi Pembayaran</h3>
                <p class="text-slate-500 mb-8 text-lg">Panduan booking dan pelunasan perjalanan pendakian Anda.</p>
                
                <div class="bg-slate-900 rounded-2xl p-6 text-left relative overflow-hidden shadow-xl border border-slate-800 transform hover:scale-[1.02] transition-transform duration-300">
                    <div class="absolute top-0 right-0 -mt-8 -mr-8 w-32 h-32 bg-white opacity-5 rounded-full blur-2xl"></div>
                    <div class="absolute bottom-0 right-0 p-4 opacity-20">
                        <svg class="w-16 h-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                    </div>
                    <p class="text-slate-400 text-xs font-bold mb-1 uppercase tracking-widest">Transfer Bank BCA</p>
                    <div class="text-3xl font-bold text-white tracking-wider mb-2 font-mono drop-shadow-md">123-456-7890</div>
                    <p class="text-slate-300 text-sm font-medium">a.n PT Papandayan Alam Nusantara</p>
                </div>
            </div>
            
            <!-- Bagian Kanan: Timeline (Booking & Pelunasan) -->
            <div class="lg:col-span-7 bg-slate-50/80 rounded-2xl p-6 md:p-8 border border-slate-100 relative z-10">
                <div class="space-y-8 relative">
                    <!-- Garis penghubung vertikal (hanya desktop) -->
                    <div class="absolute left-6 top-10 bottom-10 w-0.5 bg-slate-200 hidden md:block"></div>
                    
                    <!-- Step 1 -->
                    <div class="relative flex flex-col md:flex-row gap-5 md:gap-6 items-start z-10 group">
                        <div class="w-12 h-12 rounded-full bg-slate-900 text-white flex-shrink-0 flex items-center justify-center font-bold text-lg shadow-md md:z-10 group-hover:scale-110 transition-transform duration-300 border-4 border-slate-50/80">1</div>
                        <div class="bg-white p-5 rounded-xl border border-slate-100 shadow-sm w-full group-hover:shadow-md transition-shadow duration-300">
                            <h4 class="text-lg font-bold text-slate-900 mb-2">Booking (Down Payment)</h4>
                            <p class="text-slate-600 leading-relaxed text-sm">
                                Pemesanan dianggap sah (<i class="text-slate-500">booked</i>) setelah melakukan pembayaran DP minimal <strong class="text-slate-900">30% dari total biaya trip</strong>. DP tidak dapat dikembalikan jika ada pembatalan sepihak.
                            </p>
                        </div>
                    </div>
                    
                    <!-- Step 2 -->
                    <div class="relative flex flex-col md:flex-row gap-5 md:gap-6 items-start z-10 group">
                        <div class="w-12 h-12 rounded-full bg-yellow-500 text-slate-900 flex-shrink-0 flex items-center justify-center font-bold text-lg shadow-md md:z-10 group-hover:scale-110 transition-transform duration-300 border-4 border-slate-50/80">2</div>
                        <div class="bg-white p-5 rounded-xl border border-slate-100 shadow-sm w-full group-hover:shadow-md transition-shadow duration-300">
                            <h4 class="text-lg font-bold text-slate-900 mb-2">Pelunasan Pembayaran</h4>
                            <p class="text-slate-600 leading-relaxed text-sm">
                                Pelunasan biaya trip dilakukan maksimal <strong class="text-slate-900">H-1 sebelum keberangkatan</strong> via transfer, atau dibayarkan tunai (<i class="text-slate-500">cash</i>) di Basecamp sebelum pendakian dimulai.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</section>

<!-- Testimonials Section -->
<section id="testimonials" class="py-24 bg-slate-900 relative overflow-hidden">
    <!-- Decorative background elements -->
    <div class="absolute top-0 right-0 -mr-20 -mt-20 w-80 h-80 rounded-full bg-yellow-500/10 blur-3xl"></div>
    <div class="absolute bottom-0 left-0 -ml-20 -mb-20 w-96 h-96 rounded-full bg-blue-500/10 blur-3xl"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">Apa Kata Mereka</h2>
            <p class="text-slate-400 max-w-2xl mx-auto text-lg">Lebih dari 5000+ pendaki telah mempercayakan perjalanan mereka kepada kami.</p>
        </div>

        @if($testimonials->count() > 0)
        <div class="flex flex-wrap justify-center gap-6 lg:gap-8">
            @foreach($testimonials as $testimonial)
            <div class="w-full md:w-[calc(50%-1.5rem)] lg:w-[calc(33.333%-2rem)] max-w-md bg-slate-800/80 backdrop-blur-xl rounded-3xl p-8 shadow-2xl border border-slate-700 hover:border-yellow-500/30 hover:shadow-yellow-500/10 transition-all duration-300 flex flex-col relative overflow-hidden group">
                
                <!-- Decorative Glow -->
                <div class="absolute top-0 right-0 w-32 h-32 bg-yellow-500/5 rounded-full blur-3xl group-hover:bg-yellow-500/10 transition-colors pointer-events-none"></div>
                
                <!-- Quote Icon -->
                <svg class="absolute top-6 right-6 w-12 h-12 text-slate-700/50 group-hover:text-yellow-500/20 transition-colors pointer-events-none" fill="currentColor" viewBox="0 0 24 24"><path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/></svg>

                <!-- Stars -->
                <div class="flex items-center space-x-1.5 mb-6 relative z-10">
                    @for($i=1; $i<=5; $i++)
                        <svg class="w-6 h-6 {{ $i <= $testimonial->rating ? 'text-yellow-400 drop-shadow-sm' : 'text-slate-600' }}" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                    @endfor
                </div>
                
                <!-- Text -->
                <p class="text-slate-200 text-base lg:text-lg mb-8 leading-relaxed flex-grow font-light relative z-10">
                    "{{ $testimonial->message }}"
                </p>
                
                <!-- User Info -->
                <div class="flex items-center mt-auto border-t border-slate-700/80 pt-5 relative z-10">
                    @if($testimonial->avatar_path)
                        <img src="{{ url('storage/' . $testimonial->avatar_path) }}" alt="{{ $testimonial->customer_name }}" class="w-14 h-14 rounded-full object-cover mr-4 border-2 border-slate-600 shadow-md">
                    @else
                        <div class="w-14 h-14 rounded-full bg-slate-700 flex items-center justify-center text-white font-bold text-xl mr-4 border-2 border-slate-600 shadow-md">
                            {{ substr($testimonial->customer_name, 0, 1) }}
                        </div>
                    @endif
                    <div class="flex-1 min-w-0">
                        <p class="text-white font-bold text-base truncate">{{ $testimonial->customer_name }}</p>
                        @if($testimonial->package)
                            <p class="text-yellow-400 text-sm mt-0.5 truncate">{{ $testimonial->package->name }}</p>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="text-center p-10 bg-slate-800/50 rounded-2xl border border-slate-700">
            <p class="text-slate-400">Belum ada testimoni klien.</p>
        </div>
        @endif
    </div>
</section>

<!-- Artikel / Jurnal Section -->
<section id="articles" class="py-24 bg-white relative">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-slate-900 mb-4">Jurnal & Panduan</h2>
            <p class="text-slate-600 max-w-2xl mx-auto text-lg">Tips pendakian, informasi terbaru, dan cerita petualangan seru dari Papandayan.</p>
        </div>

        @if($articles->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($articles as $article)
            <div class="bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-xl border border-slate-100 transition-all duration-300 group flex flex-col h-full">
                <!-- Thumbnail -->
                <div class="relative h-56 overflow-hidden bg-slate-100">
                    @if($article->thumbnail_path)
                        <img src="{{ url('storage/' . $article->thumbnail_path) }}" alt="{{ $article->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                    @else
                        <div class="w-full h-full flex items-center justify-center">
                            <svg class="w-12 h-12 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                        </div>
                    @endif
                    @if($article->category)
                        <div class="absolute top-4 left-4">
                            <span class="px-3 py-1 bg-yellow-500 text-slate-900 text-xs font-bold uppercase tracking-wider rounded-full shadow-md">{{ $article->category }}</span>
                        </div>
                    @endif
                </div>

                <!-- Content -->
                <div class="p-6 md:p-8 flex flex-col flex-grow relative">
                    <div class="flex items-center text-xs text-slate-400 font-semibold uppercase tracking-wider mb-3 gap-3">
                        <span class="flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            {{ $article->created_at->translatedFormat('d M Y') }}
                        </span>
                    </div>
                    
                    <h3 class="text-xl font-bold text-slate-900 mb-4 line-clamp-2 leading-tight group-hover:text-yellow-600 transition-colors">
                        <a href="#" class="focus:outline-none">
                            <span class="absolute inset-0" aria-hidden="true"></span>
                            {{ $article->title }}
                        </a>
                    </h3>
                    
                    <div class="text-slate-600 text-sm line-clamp-3 mb-6 flex-grow">
                        {!! strip_tags($article->content) !!}
                    </div>

                    <div class="mt-auto pt-4 border-t border-slate-100">
                        <span class="inline-flex items-center text-sm font-bold text-slate-900 group-hover:text-yellow-600 transition-colors">
                            Baca Selengkapnya
                            <svg class="w-4 h-4 ml-1.5 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                        </span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="text-center p-12 bg-slate-50 rounded-3xl border border-slate-100 max-w-2xl mx-auto">
            <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center mx-auto mb-4 shadow-sm border border-slate-200">
                <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
            </div>
            <p class="text-slate-500 font-medium">Belum ada artikel yang dipublikasikan saat ini. Silakan kembali lagi nanti!</p>
        </div>
        @endif
    </div>
</section>

<!-- CTA Section -->
<section class="py-20 bg-yellow-500 relative">
    <div class="absolute inset-0 opacity-10 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')]"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
        <h2 class="text-3xl md:text-5xl font-bold text-slate-900 mb-6 tracking-tight">Siap Memulai Petualangan Anda?</h2>
        <p class="text-slate-800 text-lg md:text-xl mb-10 max-w-2xl mx-auto font-medium">Jangan tunda lagi. Hubungi tim admin kami sekarang untuk merencanakan perjalanan impian Anda ke Gunung Papandayan.</p>
        <a href="https://wa.me/6281234567890?text=Halo%20Min,%20mau%20tanya-tanya%20info%20pricelist%20dan%20detail%20trip%20Gunung%20Papandayan." target="_blank" class="inline-flex items-center px-10 py-5 bg-slate-900 hover:bg-slate-800 text-white font-bold rounded-full text-lg transition-transform hover:scale-105 shadow-2xl">
            <svg class="w-7 h-7 mr-3 text-green-400" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
            Konsultasi via WhatsApp
        </a>
    </div>
</section>
@endsection

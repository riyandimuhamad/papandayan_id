<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@hasSection('title')@yield('title') - @endif Trip Organizer {{ config('app.name', 'papandayan_id') }}</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- AlpineJS -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Scripts & Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .glass-nav {
            background: rgba(15, 23, 42, 0.85); /* slate-900 with opacity */
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
        .hide-scrollbar::-webkit-scrollbar { display: none; }
        .hide-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
</head>
<body class="font-sans antialiased text-slate-800 bg-slate-50 relative">

    <!-- Navbar -->
    <nav x-data="{ mobileMenuOpen: false, scrolled: false }" 
         @scroll.window="scrolled = (window.pageYOffset > 20) ? true : false"
         :class="{ 'glass-nav py-3': scrolled, 'bg-transparent py-5': !scrolled }" 
         class="fixed w-full top-0 z-50 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ url('/') }}" class="flex items-center transition-transform hover:scale-105">
                        <img src="{{ asset('images/logo_wide.png') }}" alt="Papandayan Indonesia" class="h-10 md:h-12 w-auto object-contain">
                    </a>
                </div>

                <!-- Desktop Menu -->
                <div class="hidden md:flex space-x-8 items-center">
                    <a href="{{ url('/') }}" class="text-slate-200 hover:text-yellow-400 font-medium transition-colors">Beranda</a>
                    <a href="#about" class="text-slate-200 hover:text-yellow-400 font-medium transition-colors">Tentang Kami</a>
                    <a href="#packages" class="text-slate-200 hover:text-yellow-400 font-medium transition-colors">Paket Trip</a>
                    <a href="#gallery" class="text-slate-200 hover:text-yellow-400 font-medium transition-colors">Galeri</a>
                    <a href="#testimonials" class="text-slate-200 hover:text-yellow-400 font-medium transition-colors">Testimoni</a>
                    <a href="#articles" class="text-slate-200 hover:text-yellow-400 font-medium transition-colors">Jurnal</a>
                    
                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings['contact_whatsapp']->value ?? '6281234567890') }}" target="_blank" class="px-5 py-2.5 bg-yellow-500 hover:bg-yellow-400 text-slate-900 rounded-full font-bold transition-all shadow-[0_0_15px_rgba(234,179,8,0.4)] hover:shadow-[0_0_25px_rgba(234,179,8,0.6)] hover:-translate-y-0.5">
                        Pesan Sekarang
                    </a>
                </div>

            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="min-h-screen">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-slate-900 text-slate-300 pt-16 pb-24 md:pb-8 border-t border-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-12">
                <div class="col-span-1 md:col-span-2">
                    <a href="{{ url('/') }}" class="flex items-center mb-6">
                        <img src="{{ asset('images/logo_wide.png') }}" alt="Papandayan Indonesia" class="h-14 w-auto object-contain opacity-90">
                    </a>
                    <p class="text-slate-400 text-sm leading-relaxed max-w-md mb-6 whitespace-pre-line">
                        {{ $settings['footer_description']->value ?? 'Penyedia layanan open trip, private trip, dan pemandu profesional bersertifikat.' }}
                    </p>
                    <div class="flex space-x-4 text-slate-400">
                        <a href="{{ $settings['social_instagram']->value ?? 'https://instagram.com/papandayan_id' }}" target="_blank" class="hover:text-yellow-500 transition-colors" title="Follow Instagram Kami">
                            <span class="sr-only">Instagram</span>
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z" clip-rule="evenodd" />
                            </svg>
                        </a>
                    </div>
                </div>
                
                <div>
                    <h4 class="text-white font-semibold mb-4 uppercase tracking-wider text-sm">Tautan Cepat</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="{{ url('/') }}" class="hover:text-yellow-500 transition-colors">Beranda</a></li>
                        <li><a href="#about" class="hover:text-yellow-500 transition-colors">Tentang Tim Kami</a></li>
                        <li><a href="#packages" class="hover:text-yellow-500 transition-colors">Paket Pendakian</a></li>
                        <li><a href="#gallery" class="hover:text-yellow-500 transition-colors">Galeri Perjalanan</a></li>
                        <li><a href="#testimonials" class="hover:text-yellow-500 transition-colors">Testimoni Klien</a></li>
                        <li><a href="#articles" class="hover:text-yellow-500 transition-colors">Jurnal & Panduan</a></li>
                    </ul>
                </div>
                
                <div>
                    <h4 class="text-white font-semibold mb-4 uppercase tracking-wider text-sm">Hubungi Kami</h4>
                    <ul class="space-y-3 text-sm">
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-yellow-500 mr-2 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            <span class="whitespace-pre-line">{{ $settings['contact_address']->value ?? 'Basecamp Gn. Papandayan, Garut, Jawa Barat' }}</span>
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-yellow-500 mr-2 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                            <span>{{ $settings['contact_whatsapp']->value ?? '+62 812-3456-7890' }}</span>
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-yellow-500 mr-2 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            <span>{{ $settings['contact_email']->value ?? 'info@papandayan.id' }}</span>
                        </li>
                    </ul>
                </div>
            </div>
            
            <div class="border-t border-slate-800 pt-8 flex flex-col items-center justify-center">
                <p class="text-sm text-slate-500 text-center">
                    &copy; {{ date('Y') }} papandayan_id. All rights reserved.
                </p>
            </div>
        </div>
    </footer>
    </footer>

    <!-- Bottom Navigation (Mobile Only) -->
    <div class="md:hidden fixed bottom-4 left-1/2 -translate-x-1/2 w-[95%] bg-white/95 backdrop-blur-xl border border-slate-200 rounded-full shadow-2xl z-[60] flex items-center justify-between px-2 py-2 overflow-x-auto hide-scrollbar">
        
        <a href="{{ url('/') }}" class="flex flex-col items-center justify-center min-w-[64px] text-slate-500 hover:text-slate-900 transition-colors">
            <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
            <span class="text-[9px] font-medium tracking-wide">Beranda</span>
        </a>
        
        <a href="#about" class="flex flex-col items-center justify-center min-w-[64px] text-slate-500 hover:text-slate-900 transition-colors">
            <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            <span class="text-[9px] font-medium tracking-wide">Tentang</span>
        </a>

        <a href="#packages" class="flex flex-col items-center justify-center min-w-[64px] text-slate-500 hover:text-slate-900 transition-colors">
            <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
            <span class="text-[9px] font-medium tracking-wide">Paket</span>
        </a>

        <a href="#gallery" class="flex flex-col items-center justify-center min-w-[64px] text-slate-500 hover:text-slate-900 transition-colors">
            <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
            <span class="text-[9px] font-medium tracking-wide">Galeri</span>
        </a>

        <a href="#testimonials" class="flex flex-col items-center justify-center min-w-[64px] text-slate-500 hover:text-slate-900 transition-colors">
            <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path></svg>
            <span class="text-[9px] font-medium tracking-wide">Ulasan</span>
        </a>

        <a href="#articles" class="flex flex-col items-center justify-center min-w-[64px] text-slate-500 hover:text-slate-900 transition-colors">
            <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
            <span class="text-[9px] font-medium tracking-wide">Jurnal</span>
        </a>

        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings['contact_whatsapp']->value ?? '6281234567890') }}" target="_blank" class="flex flex-col items-center justify-center min-w-[64px] text-yellow-600 hover:text-yellow-500 transition-colors">
            <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z"></path></svg>
            <span class="text-[9px] font-bold tracking-wide">Pesan</span>
        </a>
    </div>
</body>
</html>

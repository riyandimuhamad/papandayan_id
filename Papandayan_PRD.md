# Product Requirements Document (PRD) & Implementation Plan
**Unified Hiking & Adventure Platform**

---

## Document Information
- **Document Version:** 2.0 (Unified)
- **Last Updated:** 2026
- **Scope:** Generic Hiking Website Template + Papandayan_id Implementation
- **Target Deployment:** 
  - **Development:** Laragon (Localhost)
  - **Production:** cPanel (Shared Hosting) + Cloudflare

---

## Table of Contents
1. [Product Overview](#1-product-overview)
2. [Tech Stack & Infrastructure](#2-tech-stack--infrastructure)
3. [Frontend Features (Public)](#3-frontend-features-public)
4. [Backend Features (Admin CMS)](#4-backend-features-admin-cms)
5. [Database Schema](#5-database-schema)
6. [Technical Engineering Solutions](#6-technical-engineering-solutions)
7. [Implementation Plan](#7-implementation-plan)
8. [Project-Specific Details](#8-project-specific-details)

---

## 1. Product Overview

### 1.1 General Concept
Sistem ini adalah website **profil bisnis (Company Profile)** dan **katalog reservasi dinamis** untuk layanan pendakian gunung/ekspedisi petualangan. Website dirancang menggunakan arsitektur **Monolith (Laravel + Blade)** agar:
- ✅ Ramah terhadap **Shared Hosting konvensional (cPanel)**
- ✅ Tidak mengorbankan kualitas **UI/UX premium**
- ✅ Mudah dikelola oleh tim internal dengan **CMS Admin Dashboard**

### 1.2 Arsitektur Sistem
Website terbagi menjadi **2 bagian utama**:

| Bagian | Deskripsi | Akses |
|--------|-----------|-------|
| **Frontend Publik** | Halaman estetik yang interaktif untuk calon pendaki | Public / Anonymous |
| **Backend CMS** | Panel manajemen konten untuk admin | Admin Only (Login Required) |

### 1.3 Scope Fitur
Sistem ini dapat digunakan sebagai:
1. **Template generik** untuk berbagai perusahaan pendakian/adventure
2. **Implementasi spesifik** untuk Papandayan_id atau proyek serupa

---

## 2. Tech Stack & Infrastructure

### 2.1 Technology Stack
| Komponen | Teknologi | Catatan |
|----------|-----------|---------|
| **Backend Framework** | Laravel 11 (PHP) | PHP 8.2+ |
| **Database** | MySQL / MariaDB | Via Laragon (dev) / cPanel (prod) |
| **Frontend Templating** | Blade Templating Engine | Laravel native |
| **CSS Framework** | Tailwind CSS | Dikompilasi via Vite |
| **Asset Bundler** | Vite | Built-in Laravel modern setup |
| **Media Storage** | Local Storage (storage/app/public) | Symlink bypass untuk cPanel |
| **Authentication** | Laravel Breeze / Sanctum | Simple Auth system |
| **Rich Text Editor** | TinyMCE / CKEditor | Untuk modul artikel |
| **Email Infrastructure** | Cloudflare Email Routing + Gmail SMTP | Zero-cost enterprise email |

### 2.2 Infrastructure Overview
```
┌─────────────────────────────────────────────────────┐
│                   Frontend (Public)                  │
│          Blade Templates + Tailwind CSS              │
│         (Homepage, Guides, Packages, Blog)          │
└────────────────────┬────────────────────────────────┘
                     │
┌────────────────────▼────────────────────────────────┐
│              Laravel Application Core                │
│  (Routes, Controllers, Models, Migrations, Seeding) │
└────────────────────┬────────────────────────────────┘
                     │
┌────────────────────▼────────────────────────────────┐
│          Database Layer (MySQL/MariaDB)             │
│  (users, guides, packages, articles, testimonials)  │
└─────────────────────────────────────────────────────┘

External Services:
├─ Cloudflare Email Routing (Email Forwarding)
├─ Gmail SMTP (Email Sending)
├─ Cloudflare DNS (Domain Management)
└─ cPanel File Manager (Shared Hosting)
```

### 2.3 Deployment Configuration
- **Development Environment:** Laragon (Apache/Nginx + MySQL)
- **Production Environment:** cPanel Shared Hosting + Cloudflare
- **Domain Management:** Cloudflare DNS
- **CDN:** Cloudflare (Optional)

---

## 3. Frontend Features (Public)

### 3.1 Halaman Utama (Homepage)
**Deskripsi:** Landing page pertama yang menarik calon klien
**Elemen Utama:**
- ✅ **Hero Section** - Cinematic dengan background image/video dan CTA Booking
- ✅ **Ringkasan Layanan** - Penjelasan singkat tentang perusahaan
- ✅ **Alasan Memilih** - USP (Unique Selling Points)
- ✅ **Testimoni Pelanggan** - Carousel atau grid testimoni
- ✅ **Galeri Infinite Marquee** - Galeri foto ekspedisi yang bergerak
- ✅ **Call-to-Action (CTA)** - Button "Booking Sekarang" atau "Hubungi Kami"

### 3.2 Halaman Tim Pemandu (Guides)
**Deskripsi:** Profil tim guide/porter bersertifikat
**Fitur:**
- ✅ Daftar lengkap guide beserta foto profil
- ✅ Nama, jabatan, spesialisasi, dan deskripsi singkat
- ✅ Badge sertifikasi atau pengalaman
- ✅ Link social media (opsional)

### 3.3 Katalog Paket / Ekspedisi (Packages)
**Deskripsi:** Daftar lengkap paket pendakian/trip
**Fitur:**
- ✅ Informasi lengkap per paket:
  - Nama gunung/destinasi
  - Durasi trip (misal: 2D1N, 3D2N)
  - Harga per orang
  - Fasilitas included
  - Difficulty level
  - Max participants
- ✅ Gambar cover paket
- ✅ Detail page per paket dengan informasi lengkap
- ✅ Itinerary dan meet point

### 3.4 Jurnal Pendakian / Blog (Articles)
**Deskripsi:** Blog untuk berbagi cerita ekspedisi dan tips
**Fitur:**
- ✅ List artikel dengan pagination
- ✅ Kategori artikel (Tips, Story, News, dll)
- ✅ Search & filter berdasarkan kategori
- ✅ Detail page artikel dengan:
  - Judul dan deskripsi
  - Gambar thumbnail
  - Konten rich text (HTML formatting)
  - Author info
  - Publish date
  - Meta SEO (title, description, keywords)
- ✅ Related articles section
- ✅ Comment section (opsional)

### 3.5 Halaman Kontak & Kebijakan
**Deskripsi:** Informasi kontak dan kebijakan bisnis
**Fitur:**
- ✅ Alamat basecamp/kantor
- ✅ Nomor WhatsApp admin
- ✅ Email kontak
- ✅ Jam operasional
- ✅ Form kontak (Name, Email, Message, Phone)
- ✅ Kebijakan pembatalan/refund
- ✅ Terms & conditions

### 3.6 Form Reservasi / Booking (Optional Advanced Feature)
**Deskripsi:** Form multi-step untuk pemesanan paket
**Fitur:**
- ✅ Step 1: Pilih paket & tanggal
- ✅ Step 2: Input data peserta
- ✅ Step 3: Tambahan layanan (optional)
- ✅ Step 4: Konfirmasi & total biaya
- ✅ Redirect ke WhatsApp Admin dengan summary booking
- ✅ Automatic cost calculation

---

## 4. Backend Features (Admin CMS)

### 4.1 Admin Dashboard
**Deskripsi:** Panel kontrol untuk mengelola seluruh konten website
**Akses:** Login required (Admin/Staff only)

#### 4.1.1 Manajemen Multi-Admin
**Fitur:**
- ✅ Sistem **Login/Logout** dengan session management
- ✅ **CRUD Admin/Staff Account:**
  - Create: Tambah akun admin baru
  - Read: Lihat daftar semua admin
  - Update: Edit role, email, password
  - Delete: Hapus akun admin
- ✅ **Proteksi Super Admin:**
  - Akun dengan ID 1 (Pemilik/Super Admin) **tidak boleh dihapus** sistem
  - Implementasi hardcode untuk mencegah lockout
  - Only super admin dapat menghapus admin lain
- ✅ **Role-based Access Control (RBAC) - Optional:**
  - Super Admin (Full access)
  - Editor (Manage articles, guides, packages)
  - Viewer (Read-only access)

#### 4.1.2 Modul Tim Pemandu (Guides Module)
**Fitur:**
- ✅ **CRUD Guides:**
  - Nama lengkap
  - Jabatan (Guide, Porter, Manager, dll)
  - Spesialisasi/keahlian
  - Deskripsi singkat
  - Nomor kontak (opsional)
  - Social media links (opsional)
- ✅ **Image Management:**
  - Upload foto profil
  - **Image Preview** langsung (bukan hanya menampilkan path teks)
  - Delete gambar
  - Max file size: 5MB

#### 4.1.3 Modul Paket Trip (Packages Module)
**Fitur:**
- ✅ **CRUD Packages:**
  - Nama paket / gunung
  - Durasi (misal: "2D1N")
  - Harga per orang (dalam IDR)
  - Difficulty level (Easy, Medium, Hard, Expert)
  - Max participants
  - Deskripsi detail
  - Fasilitas included (list items)
  - Meeting point / basecamp
  - Itinerary (day by day)
- ✅ **Image Management:**
  - Upload cover image
  - **Image Preview** langsung
  - Multiple gallery images (opsional)
  - Delete gambar
  - Max file size: 10MB

#### 4.1.4 Modul Jurnal / Artikel (Articles Module)
**Fitur:**
- ✅ **CRUD Articles:**
  - Judul artikel
  - Slug (auto-generated dari judul)
  - Kategori (Tips, Story, News, Review, dll)
  - Konten lengkap dengan **Rich Text Editor**
    - Supported: TinyMCE 6 atau CKEditor 5
    - Formatting: Bold, Italic, Heading, List, Link, Image, dll
  - Publish status (Draft, Published, Scheduled)
  - Publish date & time
- ✅ **SEO Metadata Management:**
  - Meta Title
  - Meta Description
  - Meta Keywords (comma-separated)
  - Open Graph image (opsional)
- ✅ **Image Management:**
  - Upload thumbnail/featured image
  - **Image Preview** langsung
  - Auto-resize images untuk performance
  - Max file size: 10MB
- ✅ **Author & Tracking:**
  - Author info (auto-filled dari logged-in admin)
  - Created/Updated timestamps
  - View count (opsional)

#### 4.1.5 Modul Testimoni (Testimonials Module - Optional)
**Fitur:**
- ✅ **CRUD Testimonials:**
  - Nama peserta
  - Rating (1-5 stars)
  - Teks testimoni
  - Foto profil (opsional)
  - Status approval (Pending, Approved, Rejected)
- ✅ **Display Settings:**
  - Show on homepage
  - Featured testimonial

### 4.2 Admin Dashboard Interface
**Layout:**
```
┌─────────────────────────────────────────────────┐
│  Logo           Admin Dashboard    Logout User  │
├──────────┬──────────────────────────────────────┤
│ Sidebar  │                                       │
│ • Home   │       Main Content Area               │
│ • Guides │     (CRUD Tables, Forms, etc)        │
│ • Packages                                      │
│ • Articles                                      │
│ • Admins                                        │
│ • Settings                                      │
└──────────┴──────────────────────────────────────┘
```

---

## 5. Database Schema

### 5.1 Entity Relationship Diagram (ERD)
```
┌─────────────┐         ┌──────────────┐
│   users     │◄────────│   articles   │
├─────────────┤         ├──────────────┤
│ id (PK)     │         │ id (PK)      │
│ email       │         │ title        │
│ password    │         │ slug         │
│ name        │         │ content      │
│ role        │         │ category     │
│ created_at  │         │ author_id(FK)│
│ updated_at  │         │ published_at │
└─────────────┘         │ created_at   │
      △                 │ updated_at   │
      │                 └──────────────┘
      │
   manages
      │
┌─────────────────┐  ┌──────────────┐  ┌──────────────┐
│     guides      │  │   packages   │  │ testimonials │
├─────────────────┤  ├──────────────┤  ├──────────────┤
│ id (PK)         │  │ id (PK)      │  │ id (PK)      │
│ name            │  │ name         │  │ name         │
│ position        │  │ price        │  │ rating       │
│ specialization  │  │ duration     │  │ content      │
│ description     │  │ difficulty   │  │ status       │
│ photo_path      │  │ max_people   │  │ photo_path   │
│ created_at      │  │ description  │  │ created_at   │
│ updated_at      │  │ cover_image  │  │ updated_at   │
└─────────────────┘  │ created_at   │  └──────────────┘
                     │ updated_at   │
                     └──────────────┘
```

### 5.2 Database Tables Detail

#### Table: users
```sql
CREATE TABLE users (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    name VARCHAR(255) NOT NULL,
    role ENUM('super_admin', 'admin', 'editor', 'viewer') DEFAULT 'viewer',
    is_active BOOLEAN DEFAULT TRUE,
    last_login_at TIMESTAMP NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
```

#### Table: guides
```sql
CREATE TABLE guides (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    position VARCHAR(100) NOT NULL,
    specialization VARCHAR(255),
    description TEXT,
    photo_path VARCHAR(255),
    phone VARCHAR(20),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
```

#### Table: packages
```sql
CREATE TABLE packages (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    slug VARCHAR(255) UNIQUE NOT NULL,
    price DECIMAL(12, 2) NOT NULL,
    duration VARCHAR(50) NOT NULL,
    difficulty ENUM('easy', 'medium', 'hard', 'expert') DEFAULT 'medium',
    max_people INT DEFAULT 20,
    description LONGTEXT,
    itinerary LONGTEXT,
    meeting_point VARCHAR(255),
    facilities LONGTEXT,
    cover_image VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
```

#### Table: articles
```sql
CREATE TABLE articles (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    slug VARCHAR(255) UNIQUE NOT NULL,
    content LONGTEXT NOT NULL,
    category VARCHAR(50),
    thumbnail_path VARCHAR(255),
    meta_title VARCHAR(255),
    meta_description TEXT,
    meta_keywords VARCHAR(255),
    author_id BIGINT NOT NULL,
    status ENUM('draft', 'published', 'scheduled') DEFAULT 'draft',
    published_at TIMESTAMP NULL,
    view_count INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (author_id) REFERENCES users(id) ON DELETE CASCADE
);
```

#### Table: testimonials
```sql
CREATE TABLE testimonials (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    rating TINYINT CHECK (rating >= 1 AND rating <= 5),
    content TEXT NOT NULL,
    photo_path VARCHAR(255),
    status ENUM('pending', 'approved', 'rejected') DEFAULT 'pending',
    is_featured BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
```

---

## 6. Technical Engineering Solutions

### 6.1 Solusi Gambar Rusak di Shared Hosting (Storage Symlink Bypass)

**Problem:** Shared hosting (cPanel) sering memblokir fungsi `php artisan storage:link`, mengakibatkan gambar yang di-upload tidak dapat ditampilkan.

**Solusi:** Implementasi rute fallback dinamis di `routes/web.php` untuk memanggil gambar melewati direktori `public` secara paksa.

**Implementation:**
```php
// routes/web.php

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;

// Fallback untuk melayani gambar dari storage
Route::get('/storage/{folder}/{filename}', function ($folder, $filename) {
    $path = storage_path('app/public/' . $folder . '/' . $filename);
    
    // Validasi path (prevent directory traversal)
    $realPath = realpath($path);
    $storagePath = realpath(storage_path('app/public'));
    
    if (!$realPath || strpos($realPath, $storagePath) !== 0) {
        abort(404);
    }
    
    if (!File::exists($path)) {
        abort(404);
    }
    
    return response()->file($path);
})->where('filename', '.*');
```

**Usage di Blade:**
```blade
<!-- Gambar dari storage akan automatic fallback ke route di atas -->
<img src="/storage/guides/photo_1.jpg" alt="Guide Photo">
<img src="/storage/packages/cover_mountain.jpg" alt="Package Cover">
<img src="/storage/articles/thumbnail_hiking.jpg" alt="Article Thumbnail">
```

**Helper Function (Optional):**
```php
// app/Helpers/ImageHelper.php
class ImageHelper {
    public static function getStoragePath($folder, $filename) {
        return "/storage/{$folder}/{$filename}";
    }
}

// Usage: <img src="{{ ImageHelper::getStoragePath('guides', 'photo.jpg') }}" alt="...">
```

### 6.2 Infrastruktur Email Bisnis Zero-Cost (Enterprise Email tanpa biaya)

**Problem:** Email hosting di cPanel memakan storage. Kami ingin email profesional tanpa biaya tambahan.

**Solusi:** Skema email terpadu menggunakan Cloudflare Email Routing + Gmail SMTP.

#### A. Penerimaan Email (Email Routing)
**Setup Cloudflare Email Routing:**
1. Login ke Cloudflare Dashboard
2. Pilih domain
3. Go to **Email > Email Routing > Custom Addresses**
4. Add routing rule:
   ```
   From: catch-all (@yourdomain.com)
   To: info.yourdomain@gmail.com
   ```
5. Verifikasi email di Gmail

**Hasil:** Semua email ke `info@yourdomain.com` langsung masuk ke `info.yourdomain@gmail.com`

#### B. Pengiriman Email (SMTP Configuration)
**Setup di Laravel (.env):**
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=info.yourdomain@gmail.com
MAIL_PASSWORD=xxxx xxxx xxxx xxxx  # Gmail App Password (16 char)
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=info@yourdomain.com
MAIL_FROM_NAME="Papandayan_id"
```

**Setup Gmail App Passwords:**
1. Login ke akun Gmail: `info.yourdomain@gmail.com`
2. Go to **Google Account > Security > App Passwords**
3. Select: Mail + Windows Computer (atau sesuai)
4. Generate App Password (16 karakter)
5. Copy paste ke MAIL_PASSWORD di `.env`

**Setup "Send As" di Gmail:**
1. Di Gmail, klik Settings
2. Go to **Accounts and Import > Send mail as**
3. Add other email address: `info@yourdomain.com`
4. Use: `smtp.gmail.com` + App Password
5. Set sebagai default send address

**Hasil:** Email dari Laravel akan terkirim dari `info@yourdomain.com` (verified by Gmail)

#### C. Pembebasan DNS (Remove Conflicting MX Records)
**Di Cloudflare DNS:**
1. Delete seluruh MX record bawaan cPanel (jika ada)
2. Pastikan hanya Cloudflare Email Routing yang aktif
3. Verify DNS records clean

**Cloudflare Email Routing akan otomatis handle routing tanpa MX conflict**

#### D. Laravel Email Configuration Files

**config/mail.php:**
```php
return [
    'default' => env('MAIL_MAILER', 'smtp'),
    'mailers' => [
        'smtp' => [
            'transport' => 'smtp',
            'host' => env('MAIL_HOST'),
            'port' => env('MAIL_PORT'),
            'encryption' => env('MAIL_ENCRYPTION'),
            'username' => env('MAIL_USERNAME'),
            'password' => env('MAIL_PASSWORD'),
            'timeout' => null,
            'auth_mode' => null,
        ],
    ],
    'from' => [
        'address' => env('MAIL_FROM_ADDRESS', 'hello@example.com'),
        'name' => env('MAIL_FROM_NAME', 'Example'),
    ],
];
```

### 6.3 Image Handling Best Practices

**Upload Directory Structure:**
```
storage/app/public/
├── guides/
│   ├── photo_1.jpg
│   ├── photo_2.jpg
│   └── ...
├── packages/
│   ├── cover_mountain_1.jpg
│   ├── cover_mountain_2.jpg
│   └── ...
└── articles/
    ├── thumbnail_1.jpg
    ├── thumbnail_2.jpg
    └── ...
```

**Image Upload Validation (in Controller):**
```php
$validated = $request->validate([
    'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120', // 5MB
    'cover_image' => 'required|image|mimes:jpeg,png,jpg|max:10240', // 10MB
    'thumbnail' => 'required|image|mimes:jpeg,png,jpg|max:5120', // 5MB
]);
```

**Image Storage (in Controller):**
```php
if ($request->hasFile('photo')) {
    $file = $request->file('photo');
    $filename = uniqid('guide_') . '.' . $file->getClientOriginalExtension();
    $file->storeAs('public/guides', $filename);
    $guide->photo_path = 'guides/' . $filename;
}
```

### 6.4 Performance Optimization

**1. Database Indexing:**
```sql
CREATE INDEX idx_articles_slug ON articles(slug);
CREATE INDEX idx_articles_category ON articles(category);
CREATE INDEX idx_articles_status_published ON articles(status, published_at);
CREATE INDEX idx_packages_slug ON packages(slug);
```

**2. Caching Strategy:**
```php
// Cache homepage data (24 hours)
$packages = Cache::remember('packages_all', 86400, function () {
    return Package::all();
});
```

**3. Image Optimization:**
- Use WebP format (PHP: `intervention/image`)
- Compress before upload
- Generate thumbnails

---

## 7. Implementation Plan

### 7.1 Project Phases

#### **Phase 1: Persiapan & Setup Lingkungan (Saat Ini)**

**Tujuan:** Menyiapkan environment dan dependencies

**Client/User Tasks:**
- [ ] Buat folder baru di komputer Anda (misal: `f:\KAMPUS\Project\Papandayan_Laravel`)
- [ ] Buka folder tersebut di VS Code
- [ ] Buka Laragon → Click "Start All" (Apache/Nginx + MySQL harus berjalan)
- [ ] Buka HeidiSQL / phpMyAdmin Laragon
- [ ] Buat database baru bernama `papandayan_db`
- [ ] Verifikasi MySQL berjalan dengan baik

**AI/Developer Tasks:**
- [ ] Install Laravel 11 menggunakan `composer create-project laravel/laravel`
- [ ] Setup `.env` file dengan database credentials
- [ ] Install Laravel Breeze untuk authentication
- [ ] Setup Tailwind CSS + Vite
- [ ] Verify aplikasi berjalan di `http://localhost:8000`

**Deliverable:**
- ✅ Fresh Laravel project dengan Breeze installed
- ✅ Database connection successful
- ✅ Development server running

---

#### **Phase 2: Database & Backend Core (1-2 minggu)**

**Tujuan:** Setup database structure dan admin authentication

**Tasks:**
- [ ] Create migrations untuk semua tables (users, guides, packages, articles, testimonials)
- [ ] Seed dummy data untuk testing
- [ ] Setup Laravel Breeze authentication
- [ ] Create admin controllers (GuideController, PackageController, ArticleController)
- [ ] Create admin routes
- [ ] Setup image storage routes (symlink bypass)

**Deliverable:**
- ✅ Database fully migrated
- ✅ Admin login functional
- ✅ All CRUD operations coded (but UI pending)

---

#### **Phase 3: Backend CMS UI (Admin Dashboard) (2-3 minggu)**

**Tujuan:** Membuat antarmuka admin untuk manajemen konten

**Tasks:**
- [ ] Create admin layout/template (navbar, sidebar, main area)
- [ ] Build Guide management pages:
  - [ ] List guides table
  - [ ] Create/Edit form with image upload & preview
  - [ ] Delete function with confirmation
- [ ] Build Package management pages:
  - [ ] List packages table
  - [ ] Create/Edit form with rich content
  - [ ] Image upload & preview
- [ ] Build Article management pages:
  - [ ] List articles table
  - [ ] Create/Edit form with Rich Text Editor (TinyMCE)
  - [ ] Thumbnail upload & preview
  - [ ] SEO metadata input
- [ ] Build Admin user management pages
- [ ] Add form validation & error messages

**Deliverable:**
- ✅ Full functional admin dashboard
- ✅ All CRUD operations with UI
- ✅ Image upload with preview working

---

#### **Phase 4: Frontend Development (Blade + Tailwind) (2-3 minggu)**

**Tujuan:** Membangun website publik yang menarik

**Tasks:**
- [ ] Create main layout/master template
- [ ] Build Homepage:
  - [ ] Hero section dengan animasi
  - [ ] Services summary
  - [ ] Testimonials carousel
  - [ ] CTA button
- [ ] Build Guides page:
  - [ ] Display guides from database
  - [ ] Grid/card layout
- [ ] Build Packages page:
  - [ ] List packages with filters
  - [ ] Package detail page
  - [ ] Itinerary display
- [ ] Build Articles page:
  - [ ] Article list with pagination
  - [ ] Article detail page
  - [ ] Related articles
- [ ] Build Contact page:
  - [ ] Contact form
  - [ ] Map & info
- [ ] SEO optimization (meta tags, structured data)

**Deliverable:**
- ✅ Complete frontend website
- ✅ Connected to database (no more dummy data)
- ✅ Responsive design (mobile-friendly)
- ✅ SEO optimized

---

#### **Phase 5: Testing & Deployment (1 minggu)**

**Tujuan:** QA dan siap untuk production

**Tasks:**
- [ ] Functional testing (semua fitur)
- [ ] Cross-browser testing
- [ ] Mobile responsiveness testing
- [ ] Performance optimization
- [ ] Security audit (SQL injection, XSS, etc)
- [ ] Setup production server on cPanel
- [ ] Database migration to production
- [ ] Email configuration on production
- [ ] DNS & Cloudflare setup
- [ ] Final testing on live server

**Deliverable:**
- ✅ Production-ready application
- ✅ Live on domain

---

### 7.2 Development Workflow

**Daily Workflow:**
```
1. Client opens folder in VS Code
2. Terminal: laragon start (if not already running)
3. Terminal: cd project && php artisan serve
4. Access: http://localhost:8000
5. Make changes → Save → Browser refresh (with hot reload via Vite)
6. Test changes locally
7. Commit to git if using version control
```

**Git Workflow (Recommended):**
```bash
# Initial setup
git init
git add .
git commit -m "Initial Laravel setup"

# Daily commits
git add .
git commit -m "Feature: Add guide management"

# Push to GitHub (optional)
git push origin main
```

---

## 8. Project-Specific Details

### 8.1 Papandayan_id Implementation

**Project Context:**
- **Company:** Papandayan Adventure / Pendakian Gunung Papandayan
- **Destination:** Gunung Papandayan (West Java, Indonesia)
- **Business Model:** Tour operator + guide service
- **Target Users:** Casual trekkers, experienced hikers, groups/corporate

**Customizations for Papandayan_id:**

#### 8.1.1 Package Types (Khusus Papandayan)
```
1. Private Trip
   - Durasi: 1D atau 2D1N
   - Harga: Mulai dari Rp X
   - Group kecil (2-6 orang)

2. Camping 2D1N
   - Durasi: 2 hari 1 malam
   - Fasilitas: Tenda, sleeping bag, guide
   - Harga: Mulai dari Rp Y

3. Outbound/Corporate
   - Customizable duration
   - Special pricing untuk grup besar
   - Team building activities included

4. Photography Tour
   - Focus pada foto sunrise/landscape
   - Professional guide + photography tips
   - Durasi: 1D or 2D1N
```

#### 8.1.2 Guides for Papandayan
**Contoh Guide yang akan ditampilkan:**
- Budi Santoso (Guide Head) - Bersertifikat, 10+ tahun pengalaman
- Rina Sari (Porter) - Ahli navigasi trail
- Dwi Handoko (Manager/Coordinator)
- ... (dan guide lainnya)

#### 8.1.3 Featured Content
**Homepage Highlights:**
- Best time to visit Papandayan
- Sunrise view showcase
- Volcanic crater lake
- Testimonials dari climbers
- Booking CTA → WhatsApp Admin

#### 8.1.4 SEO Keywords (Papandayan-specific)
```
- Pendakian Gunung Papandayan
- Gunung Papandayan 2D1N
- Guide Papandayan termurah
- Trip Papandayan di Bandung
- Crater lake Papandayan
- etc
```

### 8.2 Generic Hiking Website Template

Dokumen ini juga dapat digunakan sebagai **template generik** untuk perusahaan pendakian lainnya. Hanya perlu mengganti:
- Nama gunung/destinasi
- Guide profiles
- Package details
- Brand colors & logo
- Contact info

---

## Appendix: Important Notes

### A. File Structure (Laravel Project)
```
papandayan-laravel/
├── app/
│   ├── Models/
│   │   ├── User.php
│   │   ├── Guide.php
│   │   ├── Package.php
│   │   ├── Article.php
│   │   └── Testimonial.php
│   └── Http/Controllers/
│       ├── Admin/
│       │   ├── GuideController.php
│       │   ├── PackageController.php
│       │   └── ArticleController.php
│       └── FrontendController.php
├── database/
│   └── migrations/
│       ├── 2024_01_01_create_users_table.php
│       ├── 2024_01_02_create_guides_table.php
│       ├── 2024_01_03_create_packages_table.php
│       ├── 2024_01_04_create_articles_table.php
│       └── 2024_01_05_create_testimonials_table.php
├── resources/
│   ├── views/
│   │   ├── layouts/
│   │   │   ├── app.blade.php (Frontend master)
│   │   │   └── admin.blade.php (Admin master)
│   │   ├── admin/
│   │   │   ├── guides/
│   │   │   ├── packages/
│   │   │   └── articles/
│   │   └── frontend/
│   │       ├── homepage.blade.php
│   │       ├── guides.blade.php
│   │       ├── packages.blade.php
│   │       ├── articles.blade.php
│   │       └── contact.blade.php
│   └── css/
│       └── app.css (Tailwind)
├── routes/
│   └── web.php (Frontend + Admin routes)
├── storage/
│   └── app/
│       └── public/
│           ├── guides/
│           ├── packages/
│           └── articles/
├── .env (Database & Email config)
├── artisan (CLI)
└── package.json (Vite, Tailwind)
```

### B. Checklist Sebelum Production
- [ ] Database backed up
- [ ] .env production configured
- [ ] Email testing (send test email to admin)
- [ ] Image storage verified (all images showing)
- [ ] Contact form working
- [ ] Mobile responsive checked
- [ ] Performance optimized (Lighthouse >80)
- [ ] Security headers configured
- [ ] SSL certificate installed
- [ ] DNS pointing correctly
- [ ] Cloudflare Email Routing active
- [ ] Analytics setup (GA4, etc)

### C. Troubleshooting Common Issues

**Q: Images not showing on cPanel**
A: Check if symlink bypass route is working. Verify storage folder permissions (755).

**Q: Email not sending**
A: Check MAIL_PASSWORD is correct (copy from Gmail App Passwords exactly). Verify SMTP settings in .env

**Q: Database connection error**
A: Verify MYSQL credentials in .env match phpMyAdmin. Check if MySQL service is running in Laragon.

**Q: "php artisan" command not working**
A: Ensure you're in project root directory. Check PHP path in VS Code terminal.

---

## Document Status
✅ **Ready for Implementation**

**Last Review:** 2026
**Next Review:** After Phase 2 completion

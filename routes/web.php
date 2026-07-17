<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\GuideController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\DocumentationController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;

Route::get('/', function () {
    $packages = \App\Models\Package::take(6)->get(); // Membatasi data agar memori tidak penuh
    $testimonials = \App\Models\Testimonial::with('package')->where('rating', '>=', 4)->orderByRaw('CASE WHEN `order` = 0 THEN 1 ELSE 0 END ASC')->orderBy('order', 'asc')->orderBy('created_at', 'desc')->take(8)->get();
    $documentations = \App\Models\Documentation::orderByRaw('CASE WHEN `order` = 0 THEN 1 ELSE 0 END ASC')->orderBy('order', 'asc')->orderBy('created_at', 'desc')->get();
    $articles = \App\Models\Article::where('status', 'published')->orderByRaw('CASE WHEN `order` = 0 THEN 1 ELSE 0 END ASC')->orderBy('order', 'asc')->orderBy('created_at', 'desc')->take(3)->get();
    $heroSlides = \App\Models\HeroSlide::where('is_active', true)->orderBy('order')->get();
    return view('welcome', compact('packages', 'testimonials', 'documentations', 'articles', 'heroSlides'));
});

Route::get('/dashboard', function () {
    $countPackages = \App\Models\Package::count();
    $countGuides = \App\Models\Guide::count();
    $countArticles = \App\Models\Article::count();
    $countTestimonials = \App\Models\Testimonial::count();
    $countDocumentations = \App\Models\Documentation::count();
    
    return view('dashboard', compact(
        'countPackages', 
        'countGuides', 
        'countArticles', 
        'countTestimonials', 
        'countDocumentations'
    ));
})->middleware(['auth', 'verified'])->name('dashboard');

// Storage Symlink Bypass Route (Diamankan dari Directory Traversal)
Route::get('/storage/{folder}/{filename}', function ($folder, $filename) {
    // Whitelist folder yang diizinkan untuk diakses publik
    $allowedFolders = ['hero', 'packages', 'guides', 'articles', 'documentations', 'settings', 'testimonials'];
    if (!in_array($folder, $allowedFolders)) {
        abort(404);
    }

    $path = storage_path('app/public/' . $folder . '/' . $filename);
    $realPath = realpath($path);
    $storagePath = realpath(storage_path('app/public'));
    
    if (!$realPath || strpos($realPath, $storagePath) !== 0 || !File::exists($path)) {
        abort(404);
    }
    return response()->file($path);
})->where('filename', '.*');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Admin CMS Routes
    Route::resource('admin/guides', GuideController::class)->names('admin.guides');
    Route::resource('admin/packages', PackageController::class)->names('admin.packages');
    Route::resource('admin/articles', ArticleController::class)->names('admin.articles');
    Route::resource('admin/testimonials', TestimonialController::class)->names('admin.testimonials');
    Route::resource('admin/documentations', DocumentationController::class)->names('admin.documentations');
    
    // Settings & Hero Slides
    Route::get('admin/settings', [\App\Http\Controllers\SettingController::class, 'index'])->name('admin.settings.index');
    Route::put('admin/settings', [\App\Http\Controllers\SettingController::class, 'update'])->name('admin.settings.update');
    Route::resource('admin/hero-slides', \App\Http\Controllers\HeroSlideController::class)->names('admin.hero-slides')->except(['show']);
});

require __DIR__.'/auth.php';

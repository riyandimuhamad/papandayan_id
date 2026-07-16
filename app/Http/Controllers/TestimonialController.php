<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class TestimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $testimonials = Testimonial::with('package')->orderByRaw('CASE WHEN `order` = 0 THEN 1 ELSE 0 END ASC')->orderBy('order', 'asc')->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.testimonials.index', compact('testimonials'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $packages = Package::all();
        return view('admin.testimonials.create', compact('packages'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'trip_date' => 'required|date',
            'rating' => 'required|integer|min:1|max:5',
            'message' => 'required|string',
            'package_id' => 'nullable|exists:packages,id',
            'avatar' => 'nullable|image|max:2048',
            'order' => 'required|integer|min:0',
        ]);

        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $filename = uniqid('avatar_') . '.webp';
            
            // Create directory if not exists
            if (!file_exists(storage_path('app/public/testimonials'))) {
                mkdir(storage_path('app/public/testimonials'), 0755, true);
            }

            // Create manager instance
            $manager = new ImageManager(new Driver());
            
            // Read, crop to square and convert to WebP
            $image = $manager->decode($file);
            $image->cover(250, 250); // crop jadi kotak sempurna (center by default)
            $image->save(storage_path('app/public/testimonials/' . $filename), quality: 80);

            $validated['avatar_path'] = 'testimonials/' . $filename;
        }

        Testimonial::create($validated);

        return redirect()->route('admin.testimonials.index')->with('success', 'Testimoni berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Testimonial $testimonial)
    {
        return view('admin.testimonials.show', compact('testimonial'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Testimonial $testimonial)
    {
        $packages = Package::all();
        return view('admin.testimonials.edit', compact('testimonial', 'packages'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Testimonial $testimonial)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'trip_date' => 'required|date',
            'rating' => 'required|integer|min:1|max:5',
            'message' => 'required|string',
            'package_id' => 'nullable|exists:packages,id',
            'avatar' => 'nullable|image|max:2048',
            'order' => 'required|integer|min:0',
        ]);

        if ($request->hasFile('avatar')) {
            // Delete old photo if exists
            if ($testimonial->avatar_path && file_exists(storage_path('app/public/' . $testimonial->avatar_path))) {
                unlink(storage_path('app/public/' . $testimonial->avatar_path));
            }

            $file = $request->file('avatar');
            $filename = uniqid('avatar_') . '.webp';
            
            // Create directory if not exists
            if (!file_exists(storage_path('app/public/testimonials'))) {
                mkdir(storage_path('app/public/testimonials'), 0755, true);
            }

            // Create manager instance
            $manager = new ImageManager(new Driver());
            
            // Read, crop to square and convert to WebP
            $image = $manager->decode($file);
            $image->cover(250, 250); // crop jadi kotak sempurna
            $image->save(storage_path('app/public/testimonials/' . $filename), quality: 80);

            $validated['avatar_path'] = 'testimonials/' . $filename;
        }

        $testimonial->update($validated);

        return redirect()->route('admin.testimonials.index')->with('success', 'Testimoni berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Testimonial $testimonial)
    {
        if ($testimonial->avatar_path) {
            Storage::delete('public/' . $testimonial->avatar_path);
        }
        $testimonial->delete();

        return redirect()->route('admin.testimonials.index')->with('success', 'Testimoni berhasil dihapus.');
    }
}

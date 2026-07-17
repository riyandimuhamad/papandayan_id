<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HeroSlideController extends Controller
{
    public function index()
    {
        $slides = \App\Models\HeroSlide::orderBy('order')->get();
        return view('admin.hero-slides.index', compact('slides'));
    }

    public function create()
    {
        return view('admin.hero-slides.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'image' => 'required|mimes:jpeg,png,jpg,webp|max:2048',
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string',
            'is_active' => 'boolean',
            'order' => 'integer',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('hero', 'public');
            $validated['image'] = '/storage/' . $path;
        }

        $validated['is_active'] = $request->boolean('is_active');

        \App\Models\HeroSlide::create($validated);
        return redirect()->route('admin.hero-slides.index')->with('success', 'Slide berhasil ditambahkan.');
    }

    public function edit(\App\Models\HeroSlide $heroSlide)
    {
        return view('admin.hero-slides.edit', compact('heroSlide'));
    }

    public function update(Request $request, \App\Models\HeroSlide $heroSlide)
    {
        $validated = $request->validate([
            'image' => 'nullable|mimes:jpeg,png,jpg,webp|max:2048',
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string',
            'is_active' => 'boolean',
            'order' => 'integer',
        ]);

        if ($request->hasFile('image')) {
            // Delete old image
            if ($heroSlide->image) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete(str_replace('/storage/', '', $heroSlide->image));
            }
            $path = $request->file('image')->store('hero', 'public');
            $validated['image'] = '/storage/' . $path;
        }

        $validated['is_active'] = $request->boolean('is_active');

        $heroSlide->update($validated);
        return redirect()->route('admin.hero-slides.index')->with('success', 'Slide berhasil diperbarui.');
    }

    public function destroy(\App\Models\HeroSlide $heroSlide)
    {
        if ($heroSlide->image) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete(str_replace('/storage/', '', $heroSlide->image));
        }
        $heroSlide->delete();
        return redirect()->route('admin.hero-slides.index')->with('success', 'Slide berhasil dihapus.');
    }
}

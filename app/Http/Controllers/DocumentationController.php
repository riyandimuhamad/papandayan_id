<?php

namespace App\Http\Controllers;

use App\Models\Documentation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class DocumentationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $documentations = Documentation::orderByRaw('CASE WHEN `order` = 0 THEN 1 ELSE 0 END ASC')
            ->orderBy('order', 'asc')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return view('admin.documentations.index', compact('documentations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.documentations.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'image_path' => 'required|image|mimes:jpeg,png,jpg,webp|max:5120',
            'caption' => 'nullable|string|max:255',
            'order' => 'required|integer|min:0',
        ]);

        if ($request->hasFile('image_path')) {
            $file = $request->file('image_path');
            $filename = uniqid('doc_') . '.webp';
            
            // Ensure directory exists
            $dir = storage_path('app/public/documentations');
            if (!is_dir($dir)) {
                mkdir($dir, 0755, true);
            }

            // Create manager instance
            $manager = new ImageManager(new Driver());
            
            // Read and convert to WebP
            $image = $manager->decode($file);
            $image->save(storage_path('app/public/documentations/' . $filename), quality: 80);

            $validated['image_path'] = 'documentations/' . $filename;
        }

        Documentation::create($validated);

        return redirect()->route('admin.documentations.index')->with('success', 'Dokumentasi berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Documentation $documentation)
    {
        return view('admin.documentations.edit', compact('documentation'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Documentation $documentation)
    {
        $validated = $request->validate([
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'caption' => 'nullable|string|max:255',
            'order' => 'required|integer|min:0',
        ]);

        if ($request->hasFile('image_path')) {
            // Delete old
            if ($documentation->image_path) {
                Storage::delete('public/' . $documentation->image_path);
            }

            $file = $request->file('image_path');
            $filename = uniqid('doc_') . '.webp';
            
            $dir = storage_path('app/public/documentations');
            if (!is_dir($dir)) {
                mkdir($dir, 0755, true);
            }

            $manager = new ImageManager(new Driver());
            $image = $manager->decode($file);
            $image->save(storage_path('app/public/documentations/' . $filename), quality: 80);

            $validated['image_path'] = 'documentations/' . $filename;
        }

        $documentation->update($validated);

        return redirect()->route('admin.documentations.index')->with('success', 'Dokumentasi berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Documentation $documentation)
    {
        if ($documentation->image_path) {
            Storage::delete('public/' . $documentation->image_path);
        }
        $documentation->delete();

        return redirect()->route('admin.documentations.index')->with('success', 'Dokumentasi berhasil dihapus.');
    }
}

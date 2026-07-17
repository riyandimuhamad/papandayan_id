<?php

namespace App\Http\Controllers;

use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $packages = Package::latest()->paginate(10);
        return view('admin.packages.index', compact('packages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.packages.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|in:Private Trip,Outbound,Other Services',
            'price' => 'required|numeric|min:0',
            'duration' => 'required|string|max:255',
            'difficulty' => 'required|in:easy,medium,hard,expert',
            'max_people' => 'required|integer|min:1',
            'description' => 'nullable|string',
            'itinerary' => 'nullable|string',
            'meeting_point' => 'nullable|string|max:255',
            'facilities' => 'nullable|string',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        // Ensure unique slug
        $originalSlug = $validated['slug'];
        $counter = 1;
        while (Package::where('slug', $validated['slug'])->exists()) {
            $validated['slug'] = $originalSlug . '-' . $counter;
            $counter++;
        }

        if ($request->hasFile('cover_image')) {
            $file = $request->file('cover_image');
            $filename = uniqid('package_') . '.' . $file->getClientOriginalExtension();
            $file->storeAs('packages', $filename, 'public');
            $validated['cover_image'] = 'packages/' . $filename;
        }

        Package::create($validated);

        return redirect()->route('admin.packages.index')->with('success', 'Data Paket Pendakian berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Package $package)
    {
        return view('admin.packages.show', compact('package'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Package $package)
    {
        return view('admin.packages.edit', compact('package'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Package $package)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|in:Private Trip,Outbound,Other Services',
            'price' => 'required|numeric|min:0',
            'duration' => 'required|string|max:255',
            'difficulty' => 'required|in:easy,medium,hard,expert',
            'max_people' => 'required|integer|min:1',
            'description' => 'nullable|string',
            'itinerary' => 'nullable|string',
            'meeting_point' => 'nullable|string|max:255',
            'facilities' => 'nullable|string',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
        ]);

        // Only update slug if name changed
        if ($package->name !== $validated['name']) {
            $validated['slug'] = Str::slug($validated['name']);
            
            // Ensure unique slug
            $originalSlug = $validated['slug'];
            $counter = 1;
            while (Package::where('slug', $validated['slug'])->where('id', '!=', $package->id)->exists()) {
                $validated['slug'] = $originalSlug . '-' . $counter;
                $counter++;
            }
        }

        if ($request->hasFile('cover_image')) {
            // Delete old photo if exists
            if ($package->cover_image) {
                Storage::disk('public')->delete($package->cover_image);
            }

            $file = $request->file('cover_image');
            $filename = uniqid('package_') . '.' . $file->getClientOriginalExtension();
            $file->storeAs('packages', $filename, 'public');
            $validated['cover_image'] = 'packages/' . $filename;
        }

        $package->update($validated);

        return redirect()->route('admin.packages.index')->with('success', 'Data Paket Pendakian berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Package $package)
    {
        if ($package->cover_image) {
            Storage::disk('public')->delete($package->cover_image);
        }
        $package->delete();

        return redirect()->route('admin.packages.index')->with('success', 'Data Paket Pendakian berhasil dihapus.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Guide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GuideController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $guides = Guide::orderBy('order', 'asc')->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.guides.index', compact('guides'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.guides.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:100',
            'specialization' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'phone' => 'nullable|string|max:20',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'order' => 'required|integer|min:0',
        ]);

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = uniqid('guide_') . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/guides', $filename);
            $validated['photo_path'] = 'guides/' . $filename;
        }

        Guide::create($validated);

        return redirect()->route('admin.guides.index')->with('success', 'Data Pemandu berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Guide $guide)
    {
        return view('admin.guides.show', compact('guide'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Guide $guide)
    {
        return view('admin.guides.edit', compact('guide'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Guide $guide)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:100',
            'specialization' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'phone' => 'nullable|string|max:20',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'order' => 'required|integer|min:0',
        ]);

        if ($request->hasFile('photo')) {
            // Delete old photo if exists
            if ($guide->photo_path) {
                Storage::delete('public/' . $guide->photo_path);
            }

            $file = $request->file('photo');
            $filename = uniqid('guide_') . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/guides', $filename);
            $validated['photo_path'] = 'guides/' . $filename;
        }

        $guide->update($validated);

        return redirect()->route('admin.guides.index')->with('success', 'Data Pemandu berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Guide $guide)
    {
        if ($guide->photo_path) {
            Storage::delete('public/' . $guide->photo_path);
        }
        $guide->delete();

        return redirect()->route('admin.guides.index')->with('success', 'Data Pemandu berhasil dihapus.');
    }
}

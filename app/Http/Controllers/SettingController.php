<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $settings = \App\Models\Setting::all()->keyBy('key');
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'about_image_file' => 'nullable|mimes:jpeg,png,jpg,webp|max:2048'
        ]);

        $data = $request->except('_token', '_method', 'about_image_file');
        
        foreach ($data as $key => $value) {
            $setting = \App\Models\Setting::where('key', $key)->first();
            if ($setting) {
                $setting->update(['value' => $value]);
            }
        }

        // Handle image upload specifically for about_image
        if ($request->hasFile('about_image_file')) {
            $setting = \App\Models\Setting::where('key', 'about_image')->first();
            if ($setting && $setting->value) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete(str_replace('/storage/', '', $setting->value));
            }
            
            $path = $request->file('about_image_file')->store('settings', 'public');
            \App\Models\Setting::updateOrCreate(
                ['key' => 'about_image'],
                ['value' => '/storage/' . $path, 'type' => 'image']
            );
        }

        return redirect()->route('admin.settings.index')->with('success', 'Pengaturan berhasil diperbarui!');
    }
}

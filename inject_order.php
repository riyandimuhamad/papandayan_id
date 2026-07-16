<?php

$files = [
    'resources/views/admin/guides/create.blade.php' => 'guide',
    'resources/views/admin/guides/edit.blade.php' => 'guide',
    'resources/views/admin/articles/create.blade.php' => 'article',
    'resources/views/admin/articles/edit.blade.php' => 'article',
    'resources/views/admin/testimonials/create.blade.php' => 'testimonial',
    'resources/views/admin/testimonials/edit.blade.php' => 'testimonial',
];

foreach ($files as $file => $varName) {
    if (!file_exists($file)) continue;

    $content = file_get_contents($file);
    
    // Check if order already exists
    if (strpos($content, 'name="order"') !== false) continue;

    $val = strpos($file, 'create') !== false ? "0" : "\$$varName->order";

    $snippet = <<<HTML
            <!-- Order -->
            <div>
                <label for="order" class="block text-sm font-semibold text-gray-700 mb-1">Urutan Tampil <span class="text-red-500">*</span></label>
                <input type="number" name="order" id="order" value="{{ old('order', $val) }}" required min="0" class="w-24 rounded-md border-gray-300 shadow-sm focus:border-yellow-500 focus:ring focus:ring-yellow-500 focus:ring-opacity-50">
                <p class="text-xs text-gray-500 mt-1">Angka terkecil (contoh: 1) akan ditampilkan paling awal. Jika 0, akan diurutkan berdasarkan tanggal terbaru.</p>
                @error('order')
                    <p class="mt-1 text-sm text-red-600">{{ \$message }}</p>
                @enderror
            </div>

            <!-- Buttons -->
HTML;

    $content = str_replace('<!-- Buttons -->', $snippet, $content);
    file_put_contents($file, $content);
    echo "Updated $file\n";
}

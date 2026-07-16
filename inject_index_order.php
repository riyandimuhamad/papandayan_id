<?php

$files = [
    'resources/views/admin/guides/index.blade.php' => 'guide',
    'resources/views/admin/articles/index.blade.php' => 'article',
    'resources/views/admin/testimonials/index.blade.php' => 'testimonial',
];

foreach ($files as $file => $var) {
    if (!file_exists($file)) continue;

    $content = file_get_contents($file);
    
    // Header
    if (strpos($content, '>Urutan<') === false) {
        $content = preg_replace(
            '/<thead class="bg-gray-50">\s*<tr>/',
            '<thead class="bg-gray-50">' . "\n" . '                <tr>' . "\n" . '                    <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Urutan</th>',
            $content
        );
    }

    // Row Data
    if (strpos($content, 'bg-yellow-100 text-yellow-800') === false) {
        $td = <<<HTML
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="inline-flex items-center justify-center h-8 w-8 rounded-full bg-yellow-100 text-yellow-800 font-bold text-sm">
                            {{ \$$var->order }}
                        </span>
                    </td>
HTML;
        $content = preg_replace(
            '/<tr class="hover:bg-gray-50 transition-colors">\s*(<td)/',
            '<tr class="hover:bg-gray-50 transition-colors">' . "\n" . $td . "\n" . '                    $1',
            $content
        );
    }

    // colspan adjustment for empty state
    $content = preg_replace('/<td colspan="(\d+)"/', function($matches) {
        return '<td colspan="' . ((int)$matches[1] + 1) . '"';
    }, $content);

    file_put_contents($file, $content);
    echo "Updated $file\n";
}

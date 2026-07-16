<?php
function processDir($dir) {
    $files = scandir($dir);
    foreach ($files as $file) {
        if ($file === '.' || $file === '..') continue;
        $path = $dir . DIRECTORY_SEPARATOR . $file;
        if (is_dir($path)) {
            processDir($path);
        } else if (pathinfo($path, PATHINFO_EXTENSION) === 'php') {
            $content = file_get_contents($path);
            
            // Replaces Papandayan_id, PAPANDAYAN_ID, etc. with papandayan_id
            $newContent = str_ireplace('Papandayan_id', 'papandayan_id', $content);
            $newContent = str_ireplace('PAPANDAYAN_ID', 'papandayan_id', $newContent);
            
            if ($content !== $newContent) {
                file_put_contents($path, $newContent);
                echo "Updated: $path\n";
            }
        }
    }
}

processDir('resources/views');
echo "Done views.\n";

$envPath = '.env';
if (file_exists($envPath)) {
    $content = file_get_contents($envPath);
    $newContent = str_ireplace('Papandayan_id', 'papandayan_id', $content);
    $newContent = str_ireplace('PAPANDAYAN_ID', 'papandayan_id', $newContent);
    if ($content !== $newContent) {
        file_put_contents($envPath, $newContent);
        echo "Updated .env\n";
    }
}

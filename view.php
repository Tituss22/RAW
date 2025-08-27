<?php
// view.php

// Ambil UUID dari parameter 'id' di URL
$uuid = $_GET['id'] ?? '';

// Validasi format UUID untuk keamanan
if (!preg_match('/^[a-f0-9]{8}-[a-f0-9]{4}-[a-f0-9]{4}-[a-f0-9]{4}-[a-f0-9]{12}$/i', $uuid)) {
    http_response_code(400);
    die('ERROR: Format UUID tidak valid.');
}

$raw_dir = 'raw';
// Cari file yang cocok dengan UUID (apapun ekstensinya)
$files = glob($raw_dir . '/' . $uuid . '.*');

// Jika tidak ada file yang cocok, tampilkan 404
if (empty($files)) {
    http_response_code(404);
    die('ERROR 404: Paste tidak ditemukan atau sudah dihapus.');
}

$file_path = $files[0];
$extension = pathinfo($file_path, PATHINFO_EXTENSION);

// Tentukan Content-Type berdasarkan ekstensi file
$content_types = [
    'txt' => 'text/plain',
    'md' => 'text/plain; charset=utf-8',
    'html' => 'text/plain; charset=utf-8', // Sengaja text/plain untuk keamanan
    'css' => 'text/css; charset=utf-8',
    'js' => 'application/javascript; charset=utf-8',
    'php' => 'text/plain; charset=utf-8', // Sengaja text/plain untuk keamanan
    'py' => 'text/plain; charset=utf-8',
    'sql' => 'text/plain; charset=utf-8'
];
$content_type = $content_types[$extension] ?? 'text/plain';

// Set header dan tampilkan konten
header('Content-Type: ' . $content_type);
header('X-Content-Type-Options: nosniff'); // Header keamanan tambahan
readfile($file_path);
exit;
?>
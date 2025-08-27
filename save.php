<?php
// save.php
header('Content-Type: application/json');

// Fungsi untuk membuat UUID v4 yang aman
function generate_uuid_v4() {
    $data = random_bytes(16);
    $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
    $data[8] = chr(ord($data[8]) & 0x3f | 0x80);
    return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
}

// Hanya izinkan metode POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'error' => 'Metode tidak diizinkan']);
    exit;
}

// Ambil data dari form
$content = $_POST['content'] ?? '';
$language = $_POST['language'] ?? 'txt';

// Validasi
if (empty(trim($content))) {
    echo json_encode(['success' => false, 'error' => 'Konten tidak boleh kosong']);
    exit;
}

// Keamanan: Whitelist untuk ekstensi file
$allowed_extensions = ['txt', 'md', 'html', 'css', 'js', 'php', 'py', 'sql'];
if (!in_array($language, $allowed_extensions)) {
    echo json_encode(['success' => false, 'error' => 'Tipe konten tidak valid']);
    exit;
}

$raw_dir = 'raw';
// Buat folder 'raw' jika belum ada
if (!is_dir($raw_dir)) {
    if (!mkdir($raw_dir, 0755, true)) {
        echo json_encode(['success' => false, 'error' => 'Gagal membuat direktori penyimpanan']);
        exit;
    }
}

// Buat nama file dengan UUID
$uuid = generate_uuid_v4();
$file_path = $raw_dir . '/' . $uuid . '.' . $language;

// Simpan file
if (file_put_contents($file_path, $content) === false) {
    echo json_encode(['success' => false, 'error' => 'Gagal menyimpan file']);
    exit;
}

// Buat URL lengkap untuk dikembalikan ke user
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? "https" : "http";
$host = $_SERVER['HTTP_HOST'];
$url = "{$protocol}://{$host}/raw/{$uuid}";

// Kirim respons sukses
echo json_encode(['success' => true, 'url' => $url]);
?>
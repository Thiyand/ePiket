<?php
require_once 'koneksi.php';

$nisn = $_POST['nisn'] ?? '';
$nama = $_POST['nama'] ?? '';
$kelas = $_POST['kelas'] ?? '';

if ($nisn && $nama && $kelas) {
    // Cek apakah nisn sudah ada
    $check = $conn->prepare("SELECT id FROM siswa WHERE nisn = ?");
    $check->bind_param("s", $nisn);
    $check->execute();
    $check->store_result();

    if ($check->num_rows === 0) {
        // Insert siswa baru
        $stmt = $conn->prepare("INSERT INTO siswa (nisn, nama, kelas) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $nisn, $nama, $kelas);
        if ($stmt->execute()) {
            // Redirect ke data_siswa.php dengan notif success
            header("Location: data_siswa.php?kelas=" . urlencode($kelas) . "&success=1");
            exit;
        } else {
            echo "Gagal menyimpan data.";
        }
    } else {
        echo "NISN sudah terdaftar!";
    }
} else {
    echo "Semua data wajib diisi.";
}
?>

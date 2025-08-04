<?php
$koneksi = new mysqli("localhost", "root", "", "epikett");

// Ambil data jurusan
$jurusan = $koneksi->query("SELECT * FROM jurusan");

$selectedId = $_GET['jurusan'] ?? null;
$kelas = [];

if ($selectedId) {
  $stmt = $koneksi->prepare("SELECT * FROM kelas WHERE jurusan_id = ?");
  $stmt->bind_param("i", $selectedId);
  $stmt->execute();
  $result = $stmt->get_result();
  while ($row = $result->fetch_assoc()) {
    $kelas[] = $row;
  }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard Piket Kelas</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-r from-blue-50 via-white to-purple-100 min-h-screen font-sans">
  <header class="bg-blue-700 text-white p-4 shadow-lg">
    <h1 class="text-2xl font-bold">Dashboard Piket Kelas</h1>
    <p class="text-sm">Selamat datang, Admin <span class="font-semibold text-yellow-300">
    </span></p>
  </header>

  <main class="p-6 max-w-6xl mx-auto">
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

<div class="bg-white p-6 rounded-xl shadow-lg border-t-4 border-indigo-600 mb-6">
  <form method="GET">
    <label for="jurusan" class="block mb-2 font-semibold text-gray-700">Data Siwa:</label>
    <select name="jurusan" id="jurusan" onchange="this.form.submit()" class="w-full p-2 border rounded-lg">
      <option value="">-- Pilih Jurusan --</option>
      <?php while ($row = $jurusan->fetch_assoc()): ?>
        <option value="<?= $row['id'] ?>" <?= ($selectedId == $row['id']) ? 'selected' : '' ?>>
          <?= htmlspecialchars($row['nama_jurusan']) ?>
        </option>
      <?php endwhile; ?>
    </select>
  </form>

  <?php if ($selectedId): ?>
    <div class="mt-4">
      <h3 class="text-lg font-semibold text-gray-800">Daftar Kelas:</h3>
      <ul class="list-disc pl-5 text-gray-600 mt-2">
        <?php foreach ($kelas as $k): ?>
          <li><a href="data_siswa.php?kelas=<?= urlencode($k['nama_kelas']) ?>" class="text-blue-700 hover:underline"><?= htmlspecialchars($k['nama_kelas']) ?></a></li>
        <?php endforeach; ?>
      </ul>
    </div>
  <?php endif; ?>
</div>

      <!-- Lihat Jadwal Piket -->
      <a href="lihat_jadwal.php" class="bg-white shadow-lg rounded-xl p-6 hover:scale-105 transition transform duration-300 border-t-4 border-blue-600">
        <h2 class="text-xl font-semibold text-blue-700 mb-2">Lihat Jadwal Piket</h2>
        <p class="text-gray-600 text-sm">Tampilkan jadwal piket berdasarkan hari dan nama siswa.</p>
      </a>

      <!-- Tambah Data Piket -->
      <a href="tambah_piket.php" class="bg-white shadow-lg rounded-xl p-6 hover:scale-105 transition transform duration-300 border-t-4 border-green-600">
        <h2 class="text-xl font-semibold text-green-700 mb-2">Tambah Data Piket</h2>
        <p class="text-gray-600 text-sm">Input nama, kelas, dan nisn siswa.</p>
      </a>

      <!-- Lihat Rekap Piket -->
      <a href="rekap_piket.php" class="bg-white shadow-lg rounded-xl p-6 hover:scale-105 transition transform duration-300 border-t-4 border-purple-600">
        <h2 class="text-xl font-semibold text-purple-700 mb-2">Lihat Rekap Piket</h2>
        <p class="text-gray-600 text-sm">Lihat rekap harian dan grafik bulanan siswa piket.</p>
      </a>

      <!-- Grafik Bulanan -->
      <a href="grafik.php" class="bg-white shadow-lg rounded-xl p-6 hover:scale-105 transition transform duration-300 border-t-4 border-yellow-600">
        <h2 class="text-xl font-semibold text-yellow-600 mb-2">Grafik Bulanan</h2>
        <p class="text-gray-600 text-sm">Visualisasi grafik piket siswa tiap bulan.</p>
      </a>

      <!-- Logout -->
      <a href="logout.php" class="bg-white shadow-lg rounded-xl p-6 hover:scale-105 transition transform duration-300 border-t-4 border-red-600">
        <h2 class="text-xl font-semibold text-red-600 mb-2">Logout</h2>
        <p class="text-gray-600 text-sm">Keluar dari dashboard dan kembali ke halaman login.</p>
      </a>
    </div>
  </main>

  <footer class="text-center text-gray-500 text-sm mt-10 mb-4">
    &copy; 2025 Aplikasi Piket Kelas. Dibuat oleh Admin.
  </footer>
</body>
</html>

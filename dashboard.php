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
      <!-- Lihat Jadwal Piket -->
  
      <a href="lihat_jadwal.php" class="bg-white shadow-lg rounded-xl p-6 hover:scale-105 transition transform duration-300 border-t-4 border-blue-600">
        <h2 class="text-xl font-semibold text-blue-700 mb-2">Lihat Jadwal Piket</h2>
        <p class="text-gray-600 text-sm">Tampilkan jadwal piket berdasarkan hari dan nama siswa.</p>
      </a>

      <!-- Tambah Data Piket -->
      <a href="tambah_piket.php" class="bg-white shadow-lg rounded-xl p-6 hover:scale-105 transition transform duration-300 border-t-4 border-green-600">
        <h2 class="text-xl font-semibold text-green-700 mb-2">Tambah Data Piket</h2>
        <p class="text-gray-600 text-sm">Input nama siswa, tanggal, dan tugas piket. Bisa edit dan hapus data.</p>
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

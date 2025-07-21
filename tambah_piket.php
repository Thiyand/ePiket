<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <title>Tambah Data Piket</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-green-50 min-h-screen p-6">
  <div class="max-w-xl mx-auto bg-white p-6 rounded-xl shadow-md">
    <h1 class="text-2xl font-bold text-green-700 mb-4">Tambah Data Piket</h1>

    <form action="#" method="POST" class="space-y-4">
      <div>
        <label class="block text-sm font-medium text-gray-700">Nama Siswa</label>
        <input type="text" name="nama" required class="w-full px-4 py-2 border rounded-xl" />
      </div>

      <div>
        <label class="block text-sm font-medium text-gray-700">Tanggal</label>
        <input type="date" name="tanggal" required class="w-full px-4 py-2 border rounded-xl" />
      </div>

      <div>
        <label class="block text-sm font-medium text-gray-700">Keterangan</label>
        <textarea name="keterangan" rows="3" class="w-full px-4 py-2 border rounded-xl"></textarea>
      </div>

      <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded-xl hover:bg-green-700">
        Simpan
      </button>
    </form>
    <a href="dashboard.php" class="mt-6 inline-block text-blue-600 hover:underline">
      <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-xl hover:bg-blue-700">
              Kembali
      </button> 
    </a>
  </div>
</body>
</html>

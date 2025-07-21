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
  <title>Lihat Jadwal Piket</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-blue-50 min-h-screen p-6">
  <div class="max-w-4xl mx-auto bg-white p-6 rounded-xl shadow-md">
    <h1 class="text-2xl font-bold text-blue-700 mb-4">Jadwal Piket Kelas</h1>

    <!-- Tabel Jadwal -->
    <table class="min-w-full text-sm border border-gray-300">
      <thead class="bg-blue-100 text-blue-700">
        <tr>
          <th class="border px-4 py-2">Hari</th>
          <th class="border px-4 py-2">Nama Siswa</th>
        </tr>
      </thead>
      <tbody class="text-gray-700">
        <tr>
          <td class="border px-4 py-2">Senin</td>
          <td class="border px-4 py-2">Gilang, Ilham, Ade</td>
        </tr>
        <tr>
          <td class="border px-4 py-2">Selasa</td>
          <td class="border px-4 py-2">Andi, Suarez, Yoga</td>
        </tr>
        <tr>
          <td class="border px-4 py-2">Rabu</td>
          <td class="border px-4 py-2">Soraya, Mail, Siti</td>
        </tr>
        <tr>
          <td class="border px-4 py-2">Kamis</td>
          <td class="border px-4 py-2">Sahrul, Ahmad, Asep</td>
        </tr>
        <tr>
          <td class="border px-4 py-2">Jum'at</td>
          <td class="border px-4 py-2">Eel, Riska, Edo</td>
        </tr>
        <!-- Tambahkan baris sesuai jadwal -->
      </tbody>
    </table>
    <br>
    <a href="dashboard.php" class="mt-6 inline-block text-blue-600 hover:underline">
      <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-xl hover:bg-red-700">
              Kembali ke Dashboard  
      </button>
    </a>
  </div>
</body>
</html>

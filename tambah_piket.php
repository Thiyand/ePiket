<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <title>Tambah Data Piket</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-green-50 min-h-screen flex">

  <!-- Kolom Kiri: Form -->
  <div class="w-full lg:w-1/2 bg-white p-8 lg:p-12 shadow-lg">
    <h1 class="text-2xl font-bold text-green-700 mb-4 text-center">Tambah Data Piket</h1>
    <h5 class="text-md text-red-700 mb-6 text-center">Inputkan NISN, Nama dan Kelas Siswa :</h5>

    <?php
    require_once 'koneksi.php';

    // Ambil data kelas
    $kelasOptions = [];
    $result = $conn->query("SELECT DISTINCT kelas FROM siswa ORDER BY kelas ASC");
    while ($row = $result->fetch_assoc()) {
        $kelasOptions[] = $row['kelas'];
    }

    // Tampilkan notifikasi jika sukses
    if (isset($_GET['success']) && $_GET['success'] == 1): ?>
      <div class="mb-4 p-3 bg-green-100 text-green-800 rounded text-center font-medium">
        Data siswa berhasil disimpan!
      </div>
    <?php endif; ?>

    <form action="proses.php" method="POST" class="space-y-5">
      <div>
        <label class="block text-sm font-medium text-gray-700">NISN</label>
        <input type="text" name="nisn" required class="w-full px-4 py-2 border rounded-xl" />
      </div>

      <div>
        <label class="block text-sm font-medium text-gray-700">Nama</label>
        <input type="text" name="nama" required class="w-full px-4 py-2 border rounded-xl" />
      </div>

      <div>
        <label class="block text-sm font-medium text-gray-700">Kelas</label>
        <select name="kelas" required class="w-full px-4 py-2 border rounded-xl">
          <option value="">-- Pilih Kelas --</option>
          <?php foreach ($kelasOptions as $kelas): ?>
            <option value="<?= htmlspecialchars($kelas) ?>"><?= htmlspecialchars($kelas) ?></option>
          <?php endforeach; ?>
        </select>
      </div>

      <div class="flex space-x-4 mt-4">
        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded-xl hover:bg-green-700">
          Simpan
        </button>
        <a href="index.php">
          <button type="button" class="bg-blue-600 text-white px-4 py-2 rounded-xl hover:bg-red-700">
            Kembali
          </button>
        </a>
      </div>
    </form>
  </div>

  <!-- Kolom Kanan: Gambar -->
  <div class="hidden lg:block lg:w-1/2">
    <div class="h-full w-full bg-cover bg-center" style="background-image: url('bg1.jpeg');"></div>
  </div>
</body>
</html>

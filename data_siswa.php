<?php
require_once 'koneksi.php';

$kelas = $_GET['kelas'] ?? '';
$search = $_GET['search'] ?? '';
$page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
$limit = 25;
$offset = ($page - 1) * $limit;

// Ambil data siswa
if ($search) {
    $stmt = $conn->prepare("SELECT nisn, nama, kelas FROM siswa WHERE nama LIKE ? ORDER BY nama LIMIT ? OFFSET ?");
    $searchTerm = '%' . $search . '%';
    $stmt->bind_param("sii", $searchTerm, $limit, $offset);
}
 elseif ($kelas) {
    $stmt = $conn->prepare("SELECT nisn, nama, kelas FROM siswa WHERE kelas = ? ORDER BY nama LIMIT ? OFFSET ?");

    $stmt->bind_param("sii", $kelas, $limit, $offset);
} else {
    echo "<h2>Data tidak ditemukan.</h2>";
    exit;
}

$stmt->execute();
$result = $stmt->get_result();

// Hitung total
if ($search) {
    $count = $conn->prepare("SELECT COUNT(*) FROM siswa WHERE nama LIKE ?");
    $count->bind_param("s", $searchTerm);
} else {
    $count = $conn->prepare("SELECT COUNT(*) FROM siswa WHERE kelas = ?");
    $count->bind_param("s", $kelas);
}
$count->execute();
$count->bind_result($totalRows);
$count->fetch();
$count->close();
$totalPages = ceil($totalRows / $limit);
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Data Siswa</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
  // Sembunyikan notifikasi otomatis setelah 3 detik
  window.addEventListener('DOMContentLoaded', () => {
    const notif = document.getElementById('notif-success');
    if (notif) {
      setTimeout(() => {
        notif.style.display = 'none';
      }, 2000); // 3000ms = 3 detik
    }
  });
</script>

</head>
<body class="bg-gray-50 text-gray-800">
  <!-- Navbar Pencarian -->
  <nav class="bg-white shadow p-4 flex justify-between items-center">
    <h1 class="text-xl font-bold text-blue-600">Data Siswa</h1>
    <form method="GET" class="flex gap-2">
  <?php if (!empty($_GET['kelas'])): ?>
    <input type="hidden" name="kelas" value="<?= htmlspecialchars($_GET['kelas']) ?>">
  <?php endif; ?>
  
  <input type="text" name="search" placeholder="Cari nama siswa..." value="<?= htmlspecialchars($_GET['search'] ?? '') ?>" class="px-3 py-1 border border-gray-300 rounded-lg" />
  <button type="submit" class="bg-blue-600 text-white px-4 py-1 rounded hover:bg-blue-700">Cari</button>
</form>

  </nav>

  <!-- Konten Utama -->
  <div class="max-w-5xl mx-auto bg-white mt-6 p-6 rounded-lg shadow-lg">
    <h2 class="text-2xl font-semibold text-center mb-4">
      <?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
  <div id="notif-success" class="mb-4 p-3 bg-green-100 text-green-800 rounded text-center font-medium">
    Data siswa berhasil ditambahkan!
  </div>
<?php endif; ?>


      <?= $search ? "Hasil Pencarian: " . htmlspecialchars($search) : "Daftar Siswa Kelas " . htmlspecialchars($kelas) ?>
    </h2>

    <?php
$siswaList = [];
while ($row = $result->fetch_assoc()) {
    $siswaList[] = $row;
}
?>

<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
  <?php if (count($siswaList) > 0): ?>
    <?php foreach ($siswaList as $row): ?>
      <div class="border p-4 rounded-lg shadow hover:shadow-md bg-gray-100">
        <p class="font-bold"><?= htmlspecialchars($row['nama']) ?></p>
<p class="text-sm text-gray-600">NISN: <?= htmlspecialchars($row['nisn']) ?></p>
<p class="text-sm text-gray-500">Kelas: <?= htmlspecialchars($row['kelas']) ?></p>

      </div>
    <?php endforeach; ?>
  <?php else: ?>
    <div class="col-span-full text-center text-red-600 font-semibold">
      <?= $search ? "Siswa dengan nama '<strong>" . htmlspecialchars($search) . "</strong>' tidak ditemukan." : "Tidak ada data siswa." ?>
    </div>
  <?php endif; ?>
</div>


    <!-- Pagination -->
    <div class="mt-6 text-center">
      <?php if ($page > 1): ?>
        <a href="?<?= $search ? "search=$search" : "kelas=$kelas" ?>&page=<?= $page - 1 ?>" class="px-3 py-1 bg-gray-200 rounded hover:bg-gray-300 mx-1">← Sebelumnya</a>
      <?php endif; ?>
      <?php if ($page < $totalPages): ?>
        <a href="?<?= $search ? "search=$search" : "kelas=$kelas" ?>&page=<?= $page + 1 ?>" class="px-3 py-1 bg-gray-200 rounded hover:bg-gray-300 mx-1">Berikutnya →</a>
      <?php endif; ?>
    </div>

    <!-- Tombol Kembali -->
<div class="text-center mt-6 space-x-2">
  <?php if ($search && $kelas): ?>
    <a href="?kelas=<?= urlencode($kelas) ?>" class="inline-block bg-green-300 text-black-800 px-4 py-2 rounded hover:bg-gray-400">
       Kembali ke Kelas <?= htmlspecialchars($kelas) ?>
    </a>

    <a href="index.php" class="inline-block bg-blue-300 text-black-800 px-4 py-2 rounded hover:bg-gray-400">
   Kembali ke Dashboard
</a>

  <?php else: ?>
    <a href="index.php" class="inline-block text-blue-600 hover:underline">
       Kembali ke Dashboard
    </a>
  <?php endif; ?>
</div>

  </div>
</body>
</html>

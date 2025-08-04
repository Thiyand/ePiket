<?php
require_once 'koneksi.php';

$kelasQuery = $conn->query("SELECT DISTINCT kelas FROM siswa ORDER BY kelas");
$hari = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'];

?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Jadwal Piket Semua Kelas</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 p-6">
  <h1 class="text-3xl font-bold text-center text-blue-700 mb-8">Jadwal Piket Tiap Kelas</h1>

  <div class="max-w-6xl mx-auto space-y-12">
    <?php while ($kls = $kelasQuery->fetch_assoc()): 
      $kelas = $kls['kelas'];
      $stmt = $conn->prepare("SELECT nama FROM siswa WHERE kelas = ? ORDER BY nama ASC");
      $stmt->bind_param("s", $kelas);
      $stmt->execute();
      $result = $stmt->get_result();
      $siswa = [];
      while ($row = $result->fetch_assoc()) {
        $siswa[] = $row['nama'];
      }

      // Bagi siswa ke dalam 5 hari
      $piket = array_fill_keys($hari, []);
      $index = 0;
      foreach ($siswa as $nama) {
        $piket[$hari[$index % 5]][] = $nama;
        $index++;
      }
    ?>

    <div class="bg-white rounded-xl shadow-md p-6">
      <h2 class="text-xl font-bold text-purple-700 mb-4">Kelas <?= htmlspecialchars($kelas) ?></h2>
      <div class="overflow-x-auto">
        <table class="min-w-full border border-gray-300 text-sm">
          <thead class="bg-purple-100 text-purple-800">
            <tr>
              <?php foreach ($hari as $h): ?>
                <th class="border px-4 py-2"><?= $h ?></th>
              <?php endforeach; ?>
            </tr>
          </thead>
          <tbody class="text-gray-700">
            <?php
              $max = max(array_map('count', $piket));
              for ($i = 0; $i < $max; $i++) {
                echo "<tr>";
                foreach ($hari as $h) {
                  echo "<td class='border px-4 py-2'>" . ($piket[$h][$i] ?? '') . "</td>";
                }
                echo "</tr>";
              }
            ?>
          </tbody>
        </table>
      </div>
    </div>

    <?php endwhile; ?>
  </div>

  <div class="text-center mt-10">
    <a href="index.php" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-800"> Kembali ke Dashboard</a>
  </div>
</body>
</html>

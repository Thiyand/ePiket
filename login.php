<?php
session_start();
require_once 'koneksi.php'; // file koneksi database

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    // Gunakan prepared statement untuk keamanan
    $stmt = $conn->prepare("SELECT password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($hashed_password);

    if ($stmt->fetch()) {
        if (password_verify($password, $hashed_password)) {
            $_SESSION['user'] = $username;
            header('Location: dashboard.php');
            exit;
        } else {
            $error = 'Password salah.';
        }
    } else {
        $error = 'Username tidak ditemukan.';
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login Piket Kelas</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-blue-100 to-blue-300 min-h-screen flex items-center justify-center">

  <div class="bg-white p-8 rounded-2xl shadow-lg w-full max-w-sm">
    <h2 class="text-2xl font-bold text-center text-blue-700 mb-6">Login Piket Kelas</h2>

    <?php if ($error): ?>
      <div class="bg-red-100 text-red-700 p-3 mb-4 rounded-lg text-sm"><?= $error ?></div>
    <?php endif; ?>

    <form action="" method="POST" class="space-y-4">
      <div>
        <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
        <input type="text" id="username" name="username" required
               class="mt-1 w-full px-4 py-2 border rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-400" />
      </div>

      <div>
        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
        <input type="password" id="password" name="password" required
               class="mt-1 w-full px-4 py-2 border rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-400" />
      </div>

      <button type="submit"
              class="w-full bg-blue-600 text-white py-2 rounded-xl hover:bg-blue-700 transition">Login</button>
    </form>

    <p class="text-center text-sm text-gray-500 mt-4">© 2025 Piket Kelas. All rights reserved.</p>
  </div>

</body>
</html>

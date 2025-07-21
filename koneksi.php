<?php
$host = 'localhost';
$db = 'epikett';
$user = 'root'; // ganti jika berbeda
$pass = '';     // ganti sesuai password database

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die('Koneksi database gagal: ' . $conn->connect_error);
}
?>
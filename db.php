<?php
$host = 'localhost'; // atau alamat server MySQL Anda
$user = 'root'; // ganti dengan username MySQL Anda
$password = ''; // ganti dengan password MySQL Anda
$dbname = 'php_auth'; // nama database Anda

// Koneksi ke MySQL
$conn = new mysqli($host, $user, $password, $dbname);

// Cek apakah ada error dalam koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

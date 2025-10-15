<?php
session_start();
include "../database/koneksi.php";

// Pastikan user login
if (!isset($_SESSION['ID'])) {
    echo "<script>
            alert('Silakan login terlebih dahulu.');
            window.location='../home/login.php';
          </script>";
    exit;
}

// Ambil data dari session dan form
$id_user   = $_SESSION['ID']; // kolom ID di tabel user
$id_produk = $_POST['id'];    // kolom id di tabel produk
$jumlah    = isset($_POST['jumlah']) ? $_POST['jumlah'] : 1;

// Masukkan ke tabel pesanan
$sql = "INSERT INTO pesanan (id_user, id_produk, jumlah, status, created_at)
        VALUES ('$id_user', '$id_produk', '$jumlah', 'Menunggu Konfirmasi', NOW())";

if ($conn->query($sql)) {
    echo "<script>
            alert('Pesanan berhasil dibuat! Menunggu konfirmasi admin.');
            window.location='index.php';
          </script>";
} else {
    echo 'Error: ' . $conn->error;
}
?>

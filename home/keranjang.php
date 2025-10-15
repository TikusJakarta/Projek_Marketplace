<?php
session_start();
include '../database/koneksi.php';

// Cek login
if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth/login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Keranjang Saya</title>
  <link rel="stylesheet" href="../css/index.css">
</head>
<body>
  <header class="topbar">
    <div class="logo">⚡ Flash</div>
    <div class="icons">
      <a href="keranjang.php" class="icon">🛒</a>
      <img src="https://via.placeholder.com/35" alt="User" class="profile-pic">
    </div>
  </header>

  <main class="content">
    <h2>Keranjang Belanja</h2>
    <p>Halo, <?= $_SESSION['email']; ?> 👋</p>

    <div class="cart-items">
      <?php
      // ambil pesanan user
      $sql = "SELECT p.nama, p.harga, ps.jumlah, (p.harga * ps.jumlah) AS total
              FROM pesanan ps
              JOIN produk p ON p.id = ps.id_produk
              WHERE ps.id_user = '$user_id' AND ps.status = 'keranjang'";
      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
              echo "
              <div class='cart-item'>
                <h3>{$row['nama']}</h3>
                <p>Harga: Rp " . number_format($row['harga'], 0, ',', '.') . "</p>
                <p>Jumlah: {$row['jumlah']}</p>
                <p>Total: Rp " . number_format($row['total'], 0, ',', '.') . "</p>
              </div>
              ";
          }
      } else {
          echo "<p>Keranjang kamu masih kosong.</p>";
      }
      ?>
    </div>
  </main>
</body>
</html>

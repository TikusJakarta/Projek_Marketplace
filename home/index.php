<?php
ini_set('session.cookie_path', '/');
include "../database/koneksi.php";
session_start();
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Flash Store</title>
  <link rel="stylesheet" href="../css/index.css">
</head>
<body>
  <header class="topbar">
    <div class="logo">⚡ Flash</div>

    <div class="search-bar">
      <input type="text" id="search" placeholder="Cari produk...">
    </div>

    <div class="icons">
      <i class="icon notif" title="Notifikasi">🔔</i>
      <i class="icon" title="Keranjang">🛒</i>
      <img src="https://via.placeholder.com/35" alt="User" class="profile-pic" title="Profil">
 <a href="logout.php" class="logout-btn">🚪 Logout</a>
 <a href="cek_pesanan.php" class="pemesan-btn">Cek Pemesanan</a>

    </div>
  </header>

  <aside class="sidebar">
    <ul>
      <li><a href="#">Menu</a></li>
      <p>-----------------------------------</p>
      <li><a href="#">Home</a></li>
      <li><a href="#">Profile</a></li>
      <li><a href="#">Credit</a></li>
    </ul>
  </aside>

  <main class="content">
    <div class="product-list" id="productList">

      <?php
      $sql = "SELECT * FROM produk";
      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
              echo "
              <div class='product-card'>
                <img src='{$row['foto']}' alt='produk'>
                <div class='product-info'>
                  <h3>{$row['nama']}</h3>
                  <p>{$row['deskripsi']}</p>
                  <p><b>Rp " . number_format($row['harga'], 0, ',', '.') . "</b></p>
                  <p>Stok: {$row['stok']}</p>
                </div>
              ";

              // kalau stok masih ada
              if ($row['stok'] > 0) {
                  echo "
                  <form action='aksi_beli.php' method='POST' style='display:flex; align-items:center; gap:8px;'>
                      <input type='hidden' name='id' value='{$row['id']}'>
                      <input type='number' name='jumlah' value='1' min='1' max='{$row['stok']}' 
                             style='width:60px; text-align:center; border:1px solid #ccc; border-radius:5px;'>
                      <button type='submit' class='buy-btn'>🛒 Beli</button>
                  </form>
                  ";
              } else {
                  echo "<button class='buy-btn' disabled style='background:#ccc;'>Stok Habis</button>";
              }

              echo "</div>";
          }
      } else {
          echo "<p>Tidak ada produk tersedia.</p>";
      }
      ?>
    </div>
  </main>

  <footer class="footer">
    <p>@ Tip 1 Kel 1</p>
  </footer>
</body>
</html>

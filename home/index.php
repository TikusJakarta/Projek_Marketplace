<?php
 include "../database/koneksi.php"
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
                <button class='buy-btn'>Beli</button>
              </div>
              ";
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
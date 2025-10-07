<?php
include "../database/koneksi.php";
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard Admin - Flash Store</title>
  <link rel="stylesheet" href="../css/admin.css">
</head>
<body>

  <h1>🛍️ Dashboard Admin</h1>
  <a href="tambah_produk.php" class="btn">+ Tambah Produk</a>

  <table border="1" cellpadding="10" cellspacing="0">
    <tr>
      <th>No</th>
      <th>Nama Produk</th>
      <th>Harga</th>
      <th>Stok</th>
      <th>Foto</th>
      <th>Aksi</th>
    </tr>

    <?php
    $no = 1;
    $sql = "SELECT * FROM produk ORDER BY id DESC";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "
            <tr>
              <td>$no</td>
              <td>{$row['nama']}</td>
              <td>Rp " . number_format($row['harga'], 0, ',', '.') . "</td>
              <td>{$row['stok']}</td>
              <td><img src='{$row['foto']}' width='70'></td>
              <td>
                <a href='edit_produk.php?id={$row['id']}'>Edit</a> |
                <a href='hapus_produk.php?id={$row['id']}' onclick='return confirm(\"Yakin ingin hapus?\")'>Hapus</a>
              </td>
            </tr>
            ";
            $no++;
        }
    } else {
        echo "<tr><td colspan='6'>Belum ada produk.</td></tr>";
    }
    ?>
  </table>

</body>
</html>

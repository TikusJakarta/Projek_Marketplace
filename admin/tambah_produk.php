<?php include "../database/koneksi.php"; ?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tambah Produk</title>
  <link rel="stylesheet" href="../css/tambah_produk.css">
</head>
<body>

  <h2>Tambah Produk</h2>
  <form action="aksi_tambah_produk.php" method="POST" enctype="multipart/form-data">
    <label>Nama Produk:</label><br>
    <input type="text" name="nama" required><br><br>

    <label>Deskripsi:</label><br>
    <textarea name="deskripsi" required></textarea><br><br>

    <label>Harga:</label><br>
    <input type="number" name="harga" required><br><br>

    <label>Stok:</label><br>
    <input type="number" name="stok" required><br><br>

    <label>Foto:</label><br>
    <input type="file" name="foto" accept="image/*" required><br><br>

    <button type="submit">Simpan</button>
  </form>

</body>
</html>

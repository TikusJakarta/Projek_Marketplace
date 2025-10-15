<?php
session_start();
include "../database/koneksi.php";

// Pastikan user sudah login
if (!isset($_SESSION['ID'])) {
    echo "<script>
            alert('Silakan login terlebih dahulu!');
            window.location='../login/login.php';
          </script>";
    exit;
}

$id_user = $_SESSION['ID'];

// Ambil semua pesanan milik user
$query = "SELECT p.id, pr.nama AS nama_produk, p.jumlah, p.status, p.created_at
          FROM pesanan p
          JOIN produk pr ON p.id_produk = pr.id
          WHERE p.id_user = '$id_user'
          ORDER BY p.created_at DESC";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pesanan Saya</title>
  <link rel="stylesheet" href="../css/cek_pesanan.css">
</head>
<body>
  <h2>🧾 Pesanan Saya</h2>
  <a href="index.php" class="btn">⬅ Kembali ke Beranda</a>

  <table>
    <tr>
      <th>No</th>
      <th>Produk</th>
      <th>Jumlah</th>
      <th>Status</th>
      <th>Tanggal</th>
    </tr>

    <?php
    $no = 1;
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $status_class = '';
            if (strtolower($row['status']) == 'menunggu konfirmasi') {
                $status_class = 'status-menunggu';
            } elseif (strtolower($row['status']) == 'dikonfirmasi') {
                $status_class = 'status-dikonfirmasi';
            }

            echo "
            <tr>
              <td>{$no}</td>
              <td>{$row['nama_produk']}</td>
              <td>{$row['jumlah']}</td>
              <td class='{$status_class}'>{$row['status']}</td>
              <td>{$row['created_at']}</td>
            </tr>";
            $no++;
        }
    } else {
        echo "<tr><td colspan='5'>Belum ada pesanan.</td></tr>";
    }
    ?>
  </table>
</body>
</html>

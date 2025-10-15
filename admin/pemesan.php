<?php
session_start();
include "../database/koneksi.php";

// Pastikan admin sudah login
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../home/login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Daftar Pesanan</title>
  <link rel="stylesheet" href="../css/pesanan.css">
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f9f9f9;
      padding: 20px;
    }
    h1 { color: #333; }
    table {
      border-collapse: collapse;
      width: 100%;
      background: white;
      box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }
    th, td {
      border: 1px solid #ddd;
      padding: 10px;
      text-align: center;
    }
    th { background-color: #eee; }
    a.btn {
      display: inline-block;
      padding: 6px 10px;
      background: #007bff;
      color: white;
      border-radius: 5px;
      text-decoration: none;
    }
    a.btn:hover { background: #0056b3; }
  </style>
</head>
<body>
  <h1>📦 Daftar Pesanan</h1>
  <a href="index.php" class="btn">⬅ Kembali ke Dashboard</a>
  <br><br>

  <table>
    <tr>
      <th>No</th>
      <th>Nama User</th>
      <th>Produk</th>
      <th>Jumlah</th>
      <th>Status</th>
      <th>Tanggal</th>
      <th>Aksi</th>
    </tr>

    <?php
    $no = 1;
    $sql = "SELECT 
                p.id, 
                u.email AS nama_user, 
                pr.nama AS nama_produk, 
                p.jumlah, 
                p.status, 
                p.created_at
            FROM pesanan p
            JOIN user u ON p.id_user = u.ID
            JOIN produk pr ON p.id_produk = pr.id
            ORDER BY p.created_at DESC";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>{$no}</td>";
            echo "<td>{$row['nama_user']}</td>";
            echo "<td>{$row['nama_produk']}</td>";
            echo "<td>{$row['jumlah']}</td>";
            echo "<td>{$row['status']}</td>";
            echo "<td>{$row['created_at']}</td>";
            echo "<td>";

            // Ubah status jadi lowercase biar nggak case-sensitive
            $status = strtolower(trim($row['status']));

            // Kalau status masih menunggu, baru tampil tombol konfirmasi
            if (in_array($status, ['menunggu dikonfirmasi', 'menunggu konfirmasi', 'pending'])) {
                echo "<a href='konfirmasi_pesanan.php?id={$row['id']}' class='btn'>Konfirmasi</a>";
            } else {
                echo "<span style='color:green;'>✔️ Sudah Dikonfirmasi</span>";
            }

            echo "</td>";
            echo "</tr>";
            $no++;
        }
    } else {
        echo "<tr><td colspan='7'>Belum ada pesanan.</td></tr>";
    }
    ?>
  </table>
</body>
</html>

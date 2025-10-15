<?php
include "../database/koneksi.php";
session_start();

if (isset($_GET['id'])) {
    $id_pesanan = $_GET['id'];

    // ambil data pesanan
    $query = mysqli_query($conn, "SELECT id_produk, jumlah FROM pesanan WHERE id = '$id_pesanan'");
    $data = mysqli_fetch_assoc($query);

    if ($data) {
        $id_produk = $data['id_produk'];
        $jumlah = $data['jumlah'];

        // kurangi stok produk
        mysqli_query($conn, "UPDATE produk SET stok = GREATEST(stok - $jumlah, 0) WHERE id = '$id_produk'");

        // ubah status pesanan
        mysqli_query($conn, "UPDATE pesanan SET status = 'Dikonfirmasi' WHERE id = '$id_pesanan'");

        echo "<script>
                alert('Pesanan berhasil dikonfirmasi!');
                window.location='pemesan.php';
              </script>";
    } else {
        echo "<script>
                alert('Pesanan tidak ditemukan!');
                window.location='pemesan.php.php';
              </script>";
    }
}
?>

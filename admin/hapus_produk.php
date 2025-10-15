<?php
session_start();
include "../database/koneksi.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Ambil data produk dulu untuk hapus foto dari folder
    $query = "SELECT foto FROM produk WHERE id = $id";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $foto_path = $row['foto'];

        // Hapus file foto jika ada
        if (file_exists($foto_path)) {
            unlink($foto_path);
        }
    }

    // Hapus data dari database
    $sql = "DELETE FROM produk WHERE id = $id";

    if ($conn->query($sql)) {
        $_SESSION['pesan'] = "Produk berhasil dihapus!";
        header("Location: index.php");
        exit;
    } else {
        echo "Error: " . $conn->error;
    }
} else {
    echo "ID produk tidak ditemukan.";
}
?>

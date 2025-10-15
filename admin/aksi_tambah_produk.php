<?php
include "../database/koneksi.php";

$nama = $_POST['nama'];
$deskripsi = $_POST['deskripsi'];
$harga = $_POST['harga'];
$stok = $_POST['stok'];

$target_dir = "../uploads/";
$foto_name = basename($_FILES["foto"]["name"]);
$target_file = $target_dir . time() . "_" . $foto_name;

// Pastikan folder upload ada
if (!is_dir($target_dir)) {
    mkdir($target_dir, 0777, true);
}

if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file)) {
    $sql = "INSERT INTO produk (nama, deskripsi, harga, stok, foto)
            VALUES ('$nama', '$deskripsi', '$harga', '$stok', '$target_file')";

    if ($conn->query($sql)) {
        header("Location: index.php");
        exit;
    } else {
        echo "Error: " . $conn->error;
    }
} else {
    echo "Gagal upload foto.";
}

$conn->close();
?>

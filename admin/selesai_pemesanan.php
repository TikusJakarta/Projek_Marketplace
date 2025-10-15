<?php
include "../database/koneksi.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "UPDATE pesanan SET status = 'Selesai' WHERE id = $id";
    if ($conn->query($sql)) {
        echo "<script>alert('Pesanan telah diselesaikan!'); window.location='pesanan.php';</script>";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

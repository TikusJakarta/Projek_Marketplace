<?php
include 'koneksi.php'; 

if (isset($_POST['register'])) {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    $cek = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
    if (mysqli_num_rows($cek) > 0) {
        echo "<script>
                alert('Email sudah digunakan! Silakan gunakan email lain.');
                window.location='register.php';
              </script>";
        exit;
    }

    $hashed = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (email, password, created_at) VALUES ('$email', '$hashed', NOW())";

    if (mysqli_query($conn, $sql)) {
        echo "<script>
                alert('Registrasi berhasil! Silakan login.');
                window.location='login.php';
              </script>";
    } else {
        echo "<script>
                alert('Gagal registrasi: " . mysqli_error($conn) . "');
                window.location='register.php';
              </script>";
    }
} else {
    header('Location: login.php');
    exit;
}
?>

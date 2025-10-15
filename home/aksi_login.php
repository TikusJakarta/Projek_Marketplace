<?php
ini_set('session.cookie_path', '/');
session_start();
include '../database/koneksi.php';

if (isset($_POST['login'])) {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // Cek user berdasarkan email
    $query = mysqli_query($conn, "SELECT * FROM user WHERE email='$email'");
    
    if (mysqli_num_rows($query) > 0) {
        $user = mysqli_fetch_assoc($query);

        // Cek password
        if (password_verify($password, $user['password'])) {
            // ✅ Simpan session dengan field yang benar
            $_SESSION['ID'] = $user['ID'];  // <- penting! huruf besar kecil sama dengan field di database
            $_SESSION['email'] = $user['email'];
            $_SESSION['role'] = $user['role'];

            // Arahkan sesuai role
            if ($user['role'] === 'admin') {
                header("Location: ../admin/index.php");
            } else {
                header("Location: ../home/index.php");
            }
            exit;
        } else {
            echo "<script>
                    alert('Password salah!');
                    window.location='login.php';
                  </script>";
        }
    } else {
        echo "<script>
                alert('Email tidak ditemukan!');
                window.location='login.php';
              </script>";
    }
} else {
    header("Location: login.php");
    exit;
}
?>

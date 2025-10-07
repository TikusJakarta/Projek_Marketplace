<?php
session_start();
include 'koneksi.php';

if (isset($_POST['login'])) {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    $query = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
    $data = mysqli_fetch_assoc($query);

    if ($data) {
        if (password_verify($password, $data['password'])) {
            // Login sukses → buat session
            $_SESSION['user_id'] = $data['id'];
            $_SESSION['email'] = $data['email'];
            $_SESSION['login_time'] = date('Y-m-d H:i:s');

            echo "<script>
                    alert('Login berhasil!');
                    window.location='dashboard.php';
                  </script>";
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
    header('Location: index.php');
    exit;
}
?>

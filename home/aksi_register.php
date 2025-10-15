<?php
include '../database/koneksi.php';

if (isset($_POST['register'])) {
    $email = trim($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = 'user';

    // Cek apakah email sudah digunakan
    $cek = mysqli_query($conn, "SELECT * FROM user WHERE email='$email'");
    if (mysqli_num_rows($cek) > 0) {
        echo "<script>
                alert('Email sudah digunakan!');
                window.location='register.php';
              </script>";
    } else {
        $query = "INSERT INTO user (email, password, role) VALUES ('$email', '$password', '$role')";
        if (mysqli_query($conn, $query)) {
            echo "<script>
                    alert('Registrasi berhasil! Silakan login.');
                    window.location='login.php';
                  </script>";
        } else {
            echo "<script>
                    alert('Terjadi kesalahan saat registrasi.');
                    window.location='register.php';
                  </script>";
        }
    }
} else {
    header("Location: register.php");
    exit;
}
?>

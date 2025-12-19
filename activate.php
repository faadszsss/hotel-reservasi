<?php
require_once "../config/database.php";

if (!isset($_GET['token'])) {
    die("Token tidak ditemukan");
}

$token = mysqli_real_escape_string($conn, $_GET['token']);

$cek = mysqli_query($conn, "
    SELECT * FROM users 
    WHERE activation_token='$token' 
    AND activation_expired > NOW()
");

if (mysqli_num_rows($cek) == 1) {

    mysqli_query($conn, "
        UPDATE users SET
        status='active',
        activation_token=NULL,
        activation_expired=NULL
        WHERE activation_token='$token'
    ");

    echo "Akun berhasil diaktifkan. Silakan login.";
} else {
    echo "Token tidak valid atau sudah kedaluwarsa.";
}


<?php
require_once "../config/database.php";

$message = "";

if (isset($_POST['register'])) {

    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // generate token
    $token = bin2hex(random_bytes(16));
    $expired = date("Y-m-d H:i:s", strtotime("+1 day"));

    // cek email
    $cek = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
    if (mysqli_num_rows($cek) > 0) {
        $message = "Email sudah terdaftar!";
    } else {

        $query = mysqli_query($conn, "
            INSERT INTO users (email, password, role, status, activation_token, activation_expired)
            VALUES ('$email', '$password', 'manager', 'inactive', '$token', '$expired')
        ");

        if ($query) {
            $message = "Registrasi berhasil! <br>
            <a href='activate.php?token=$token'>Klik di sini untuk aktivasi akun</a>";
        } else {
            $message = "Registrasi gagal!";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register Manager Hotel</title>
</head>
<body>

<h2>Register Manager Hotel</h2>

<?php if ($message != "") echo "<p>$message</p>"; ?>

<form method="post">
    <label>Email</label><br>
    <input type="email" name="email" required><br><br>

    <label>Password</label><br>
    <input type="password" name="password" required><br><br>

    <button type="submit" name="register">Register</button>
</form>

</body>
</html>

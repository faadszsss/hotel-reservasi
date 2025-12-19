<?php
session_start();
require_once "../config/database.php";

$message = "";

if (isset($_POST['login'])) {

    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    $query = mysqli_query($conn, "
        SELECT * FROM users 
        WHERE email='$email' AND status='active'
    ");

    if (mysqli_num_rows($query) == 1) {
        $user = mysqli_fetch_assoc($query);

        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['email']   = $user['email'];
            $_SESSION['role']    = $user['role'];

            header("Location: ../dashboard/index.php");
            exit;
        } else {
            $message = "Password salah!";
        }
    } else {
        $message = "Akun belum aktif atau tidak ditemukan!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login Manager Hotel</title>
</head>
<body>

<h2>Login Manager Hotel</h2>

<?php if ($message != "") echo "<p>$message</p>"; ?>

<form method="post">
    <label>Email</label><br>
    <input type="email" name="email" required><br><br>

    <label>Password</label><br>
    <input type="password" name="password" required><br><br>

    <button type="submit" name="login">Login</button>
</form>

</body>
</html>

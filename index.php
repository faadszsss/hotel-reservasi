<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth/login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Manager</title>
</head>
<body>

<h2>Dashboard Manager Hotel</h2>
<p>Selamat datang, <?php echo $_SESSION['email']; ?></p>

<a href="logout.php">Logout</a>

</body>
</html>

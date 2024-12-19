<?php
session_start();

// Periksa apakah pengguna sudah login (gunakan session jika perlu)
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <div class="text-center">
        <h3>Welcome to your Dashboard</h3>
        <p>Hello, <?php echo $_SESSION['username']; ?>!</p>
        <a href="logout.php" class="btn btn-danger">Logout</a>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
</body>
</html>

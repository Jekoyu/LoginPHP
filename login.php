<?php
include('db.php'); // koneksi database

// Cek apakah form disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validasi input
    if (empty($username) || empty($password)) {
        echo "<script>alert('Both fields are required!');</script>";
    } else {
        // Cek apakah username ada di database
        $stmt = $conn->prepare("SELECT id, username, password FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($id, $username, $hashed_password);
            $stmt->fetch();

            // Verifikasi password
            if (password_verify($password, $hashed_password)) {
                // Login berhasil, set session dan redirect ke dashboard
                session_start();
                $_SESSION['username'] = $username;
                echo "<script>
                    alert('Login successful!');
                    window.location.href = 'dashboard.php';
                </script>";
            } else {
                echo "<script>alert('Invalid username or password.');</script>";
            }
        } else {
            echo "<script>alert('No user found with that username.');</script>";
        }

        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center">
                    <h3>Login</h3>
                </div>
                <div class="card-body">
                    <form method="POST">
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" name="username" id="username" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" name="password" id="password" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Login</button>
                    </form>
                    <div class="text-center mt-3">
                        <a href="register.php">Don't have an account? Register</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS (needed for responsive design) -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>

</body>
</html>

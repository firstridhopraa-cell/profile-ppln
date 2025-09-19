<?php
session_start();
include 'koneksi.php';
$error = '';

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    header('location: admin.php');
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT id, username, password FROM admin_users WHERE username = ?";
    if ($stmt = mysqli_prepare($koneksi, $sql)) {
        mysqli_stmt_bind_param($stmt, "s", $username);
        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_store_result($stmt);
            if (mysqli_stmt_num_rows($stmt) == 1) {
                mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                if (mysqli_stmt_fetch($stmt)) {
                    if (password_verify($password, $hashed_password)) {
                        session_start();
                        $_SESSION["loggedin"] = true;
                        $_SESSION["id"] = $id;
                        $_SESSION["username"] = $username;
                        header("location: admin.php");
                    } else {
                        $error = 'Password yang Anda masukkan salah.';
                    }
                }
            } else {
                $error = 'Username tidak ditemukan.';
            }
        }
        mysqli_stmt_close($stmt);
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Admin</title>
    <link rel="stylesheet" href="admin_style.css">
</head>
<body class="login-body">
    <div class="login-wrapper">
        <h2>Login Admin Panel</h2>
        <p>Silakan masukkan username dan password Anda.</p>
        <?php if(!empty($error)){ echo '<div class="alert-error">' . $error . '</div>'; } ?>
        <form action="login.php" method="post">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" required>
            </div>    
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" required>
            </div>
            <div class="form-group">
                <input type="submit" class="btn" value="Login">
            </div>
        </form>
    </div>
</body>
</html>
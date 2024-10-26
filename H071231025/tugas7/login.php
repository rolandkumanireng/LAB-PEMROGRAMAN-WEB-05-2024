<?php
session_start();
include 'config.php';

if (isset($_SESSION['user_id'])) {
    session_unset(); 
    session_destroy(); 
    header('Location: login.php'); 
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['role'] = $user['role'];
        header('Location: index.php');
        exit;
    } else {
        $error = 'Invalid username or password';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #121212;
            color: #ffffff;
            font-family: Arial, sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            margin: 0;
        }
        .login-container {
            background-color: #1e1e1e;
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.4);
            max-width: 400px;
            width: 100%;
        }
        .login-title {
            font-size: 1.75rem;
            color: #e74c3c;
            font-weight: 700;
            text-align: center;
            margin-bottom: 1.5rem;
        }
        .form-control {
            background-color: #2c2c2e;
            color: #ffffff;
            border: 1px solid #444;
            border-radius: 6px;
        }
        .btn-primary {
            background-color: #e74c3c;
            border: none;
            font-weight: bold;
            border-radius: 6px;
            padding: 0.6rem;
        }
        .btn-primary:hover {
            background-color: #c0392b;
        }
        .link-text {
            color: #e74c3c;
            text-align: center;
            display: block;
            margin-top: 1.5rem;
            font-weight: bold;
            text-decoration: none;
        }
        .link-text:hover {
            color: #c0392b;
        }
        .alert {
            text-align: center;
            padding: 0.5rem;
        }
    </style>
</head>
<body>

    <div class="login-container">
        <h2 class="login-title">Login</h2>

        <?php if (isset($_SESSION['success_message'])): ?>
            <div class="alert alert-success">
                <?= $_SESSION['success_message']; unset($_SESSION['success_message']); ?>
            </div>
        <?php endif; ?>

        <?php if (isset($error)): ?>
            <div class="alert alert-danger">
                <?= $error ?>
            </div>
        <?php endif; ?>

        <form method="POST">
            <div class="mb-3">
                <input type="text" name="username" class="form-control" placeholder="Username" required>
            </div>
            <div class="mb-3">
                <input type="password" name="password" class="form-control" placeholder="Password" required>
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>

        <a href="register.php" class="link-text">daftar dan akun kamu aman(rill)</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

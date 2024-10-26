<?php
session_start();
include 'config.php';

$success_message = '';
$error_message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = 'mahasiswa';

    $stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $count = $stmt->fetchColumn();

    if ($count > 0) {
        $error_message = 'Username sudah terdaftar. Silakan pilih username lain.';
    } else {
        $stmt = $pdo->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, ?)");
        if ($stmt->execute([$username, $password, $role])) {
            $success_message = 'Akun Berhasil Dibuat. Silahkan <a href="login.php">Login di sini</a>.';
        } else {
            $error_message = 'Gagal Membuat akun. Silakan coba lagi.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Mahasiswa</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css">
    <style>
        body {
            background-color: #212529;
            color: #ffffff;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .register-card {
            background: #343a40;
            border-radius: 15px;
            padding: 2rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            max-width: 400px;
            width: 100%;
        }
        .form-control {
            border-radius: 10px;
            background-color: #495057;
            color: #ff0000;
        }
        .form-control:focus {
            background-color: #6c757d;
            border-color: #ff0000;
        }
        .register-title {
            font-weight: 700;
            font-size: 1.5rem;
            color: #e74c3c;
            text-align: center;
        }
        .btn-primary {
            border-radius: 10px;
            background-image: linear-gradient(45deg, #e74c3c, #000000);
            border: none;
            font-weight: 600;
        }
        .btn-link {
            color: #e74c3c;
            font-weight: bold;
        }
        .btn-link:hover {
            color: #ffffff;
        }
        .alert {
            border-radius: 10px;
            color: #ff0000;
        }
        .alert-success {
            background-color: #d4edda;
            color: #155724;
        }
        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
        }
    </style>
</head>
<body>

    <div class="register-card">
        <h2 class="register-title mb-4">Buat Akun</h2>

        <?php if (!empty($success_message)): ?>
            <div class="alert alert-success">
                <?= $success_message ?>
            </div>
        <?php elseif (!empty($error_message)): ?>
            <div class="alert alert-danger">
                <?= $error_message ?>
            </div>
        <?php endif; ?>

        <form method="POST">
            <div class="mb-3">
                <input type="text" name="username" class="form-control" placeholder="Username" required>
            </div>
            <div class="mb-3">
                <input type="password" name="password" class="form-control" placeholder="Password" required>
            </div>
            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Daftar</button>
            </div>
        </form>
        
        <div class="text-center mt-3">
            <a href="login.php" class="btn-link">Sudah punya akun? Login di sini</a>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

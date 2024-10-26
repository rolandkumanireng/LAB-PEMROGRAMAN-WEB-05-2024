<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$role = $_SESSION['role'];
$search = isset($_GET['search']) ? $_GET['search'] : '';
$error_message = '';

$editData = null;
if (isset($_GET['edit']) && $role === 'admin') {
    $id = $_GET['edit'];
    $stmt = $pdo->prepare("SELECT * FROM mahasiswa WHERE id = ?");
    $stmt->execute([$id]);
    $editData = $stmt->fetch();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'];
    $nim = $_POST['nim'];
    $prodi = $_POST['prodi'];

    // Check if NIM already exists 
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM mahasiswa WHERE nim = ? AND id != ?");
    $stmt->execute([$nim, $_POST['id'] ?? 0]);
    $nimExists = $stmt->fetchColumn() > 0;

    if ($nimExists) {
        $error_message = 'NIM sudah terdaftar. Silakan gunakan NIM lain.';
    } else {
        if (isset($_POST['id']) && !empty($_POST['id'])) {
            $id = $_POST['id'];
            $stmt = $pdo->prepare("UPDATE mahasiswa SET nama = ?, nim = ?, prodi = ? WHERE id = ?");
            $stmt->execute([$nama, $nim, $prodi, $id]);
        } else {
            $stmt = $pdo->prepare("INSERT INTO mahasiswa (nama, nim, prodi) VALUES (?, ?, ?)");
            $stmt->execute([$nama, $nim, $prodi]);
        }
        
        header("Location: index.php");
        exit();
    }
}

// Delete 
if (isset($_GET['delete']) && $role === 'admin') {
    $id = $_GET['delete'];
    $stmt = $pdo->prepare("DELETE FROM mahasiswa WHERE id = ?");
    $stmt->execute([$id]);
}

// Fetch
if ($search) {
    $stmt = $pdo->prepare("SELECT * FROM mahasiswa WHERE nama LIKE ? OR nim LIKE ? OR prodi LIKE ?");
    $stmt->execute(["%$search%", "%$search%", "%$search%"]);
} else {
    $stmt = $pdo->prepare("SELECT * FROM mahasiswa");
    $stmt->execute();
}

$mahasiswa = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Data Mahasiswa</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css">
    <style>
        body {
            background-color: #121212; /* Dark background */
            color: #ffffff;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .container {
            max-width: 800px;
            margin: 2rem auto;
            padding: 1.5rem;
            background-color: #1e1e1e; /* Slightly lighter dark for contrast */
            border-radius: 8px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.5);
        }
        .header-title {
            font-size: 2rem;
            font-weight: bold;
            color: #e0e0e0;
            text-align: center;
            margin-bottom: 1.5rem;
        }
        .error-message {
            color: #ff4d4d; /* Red for error messages */
            text-align: center;
            margin-bottom: 10px;
        }
        .logout-btn {
            color: #ffcc00; /* Bright color for logout */
            font-weight: bold;
            text-decoration: none;
        }
        .btn-primary, .btn-success, .btn-danger {
            border-radius: 5px;
        }
        .table th, .table td {
            vertical-align: middle;
        }
        .table-dark th {
            background-color: #2a2a2a; /* Darker header */
        }
        .form-control {
            background-color: #333333; /* Dark input fields */
            border: 1px solid #555555;
            color: #ffffff;
        }
        .form-control:focus {
            background-color: #444444; /* Darker focus */
            border-color: #ffcc00; /* Highlight border */
        }
        .btn-outline-light {
            color: #ffffff;
            border-color: #ffffff;
        }
        .btn-outline-light:hover {
            background-color: #ffffff;
            color: #212529;
        }
        .table-hover tbody tr:hover {
            background-color: #444444; /* Highlight on hover */
        }
    </style>
</head>
<body>

<div class="container">
    <h1 class="header-title">Data Mahasiswa</h1>

    <!-- Error Message -->
    <?php if (!empty($error_message)): ?>
        <div class="error-message"><?= $error_message ?></div>
    <?php endif; ?>

    <!-- Search -->
    <form method="GET" action="index.php" class="d-flex justify-content-center mb-4">
        <input type="text" name="search" class="form-control" placeholder="Cari nama" value="<?= htmlspecialchars($search) ?>">
        <button type="submit" class="btn btn-primary ms-2">Cari</button>
    </form>

    <!-- Add/Edit Form -->
    <?php if ($role === 'admin'): ?>
        <form method="POST" class="border rounded p-3 mb-4">
            <input type="hidden" name="id" value="<?= $editData['id'] ?? '' ?>">
            <div class="row">
                <div class="col mb-3">
                    <input type="text" name="nama" class="form-control" placeholder="Nama" required value="<?= $editData['nama'] ?? '' ?>">
                </div>
                <div class="col mb-3">
                    <input type="text" name="nim" class="form-control" placeholder="NIM" required value="<?= $editData['nim'] ?? '' ?>">
                </div>
                <div class="col mb-3">
                    <input type="text" name="prodi" class="form-control" placeholder="Prodi" required value="<?= $editData['prodi'] ?? '' ?>">
                </div>
            </div>
            <button type="submit" class="btn btn-success"><?= isset($editData) ? 'Update' : 'Simpan' ?></button>
            <?php if (isset($editData)): ?>
                <a href="index.php" class="btn btn-secondary ms-2">Batal</a>
            <?php endif; ?>
        </form>
    <?php endif; ?>

    <!-- Tabel -->
    <table class="table table-striped table-hover table-dark">
        <thead>
            <tr>
                <th>Nama</th>
                <th>NIM</th>
                <th>Prodi</th>
                <?php if ($role === 'admin'): ?><th>Aksi</th><?php endif; ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($mahasiswa as $mhs): ?>
                <tr>
                    <td><?= htmlspecialchars($mhs['nama']) ?></td>
                    <td><?= htmlspecialchars($mhs['nim']) ?></td>
                    <td><?= htmlspecialchars($mhs['prodi']) ?></td>
                    <?php if ($role === 'admin'): ?>
                        <td>
                            <a href="?edit=<?= $mhs['id'] ?>" class="btn btn-sm btn-outline-light">Edit</a>
                            <a href="?delete=<?= $mhs['id'] ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</a>
                        </td>
                    <?php endif; ?>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="text-center mt-3">
        <a href="logout.php" class="logout-btn">Logout</a>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
session_start();
require_once 'users.php';

if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit();
}

$currentUser = $_SESSION['user'];
$isAdmin = ($currentUser['username'] == 'adminxxx');

if (isset($_POST['logout'])) {
    session_destroy();
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Welcome, <?php echo $currentUser['name']; ?>!</h2>
        <form method="POST" class="logout-form">
            <button type="submit" name="logout">Logout</button>
        </form>
        <div class="user-data">
            <?php if ($isAdmin): ?>
                <h3>All Users Data</h3>
                <?php foreach ($users as $user): ?>
                    <div class="user-card">
                        <h4><?php echo $user['name']; ?></h4>
                        <p>Email: <?php echo $user['email']; ?></p>
                        <p>Username: <?php echo $user['username']; ?></p>
                        <?php if (isset($user['gender'])): ?>
                            <p>Gender: <?php echo $user['gender']; ?></p>
                            <p>Faculty: <?php echo $user['faculty']; ?></p>
                            <p>Batch: <?php echo $user['batch']; ?></p>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <h3>Your Data</h3>
                <div class="user-card">
                    <h4><?php echo $currentUser['name']; ?></h4>
                    <p>Email: <?php echo $currentUser['email']; ?></p>
                    <p>Username: <?php echo $currentUser['username']; ?></p>
                    <p>Gender: <?php echo $currentUser['gender']; ?></p>
                    <p>Faculty: <?php echo $currentUser['faculty']; ?></p>
                    <p>Batch: <?php echo $currentUser['batch']; ?></p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
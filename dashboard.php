<?php
session_start();
if (!isset($_SESSION['user_id'])) { header("Location: login.php"); exit; }
require_once 'db_connect.php';

$total = $pdo->query("SELECT COUNT(*) FROM users")->fetchColumn();
$users = $pdo->query("SELECT * FROM users ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <style>
        body { font-family: sans-serif; margin: 0; display: flex; background: #f1f5f9; }
        .sidebar { width: 250px; height: 100vh; background: #1e293b; color: white; padding: 20px; position: fixed; }
        .sidebar a { display: block; color: #94a3b8; padding: 10px; text-decoration: none; margin-bottom: 5px; }
        .sidebar a:hover { color: white; background: #334155; border-radius: 8px; }
        .main { margin-left: 250px; padding: 40px; width: 100%; }
        .stat-card { background: #3b82f6; color: white; padding: 20px; border-radius: 12px; display: inline-block; min-width: 200px; }
        table { width: 100%; background: white; border-collapse: collapse; margin-top: 20px; border-radius: 12px; overflow: hidden; }
        th, td { padding: 15px; text-align: left; border-bottom: 1px solid #eee; }
        th { background: #f8fafc; color: #64748b; }
    </style>
</head>
<body>
    <div class="sidebar">
        <h2>Life Changer</h2>
        <a href="dashboard.php">📊 Dashboard</a>
        <a href="profile.php">👤 View My Profile</a>
        <a href="logout.php" style="color:#f87171; margin-top: 50px;">Logout</a>
    </div>
    <div class="main">
        <div class="stat-card"><h3>Total Members</h3><p style="font-size:32px; margin:0;"><?= $total ?></p></div>
        <h3>Community Members</h3>
        <table>
            <thead><tr><th>ID</th><th>Name</th><th>Username</th><th>Email</th></tr></thead>
            <tbody>
                <?php foreach($users as $u): ?>
                <tr>
                    <td><?= $u['id'] ?></td>
                    <td><?= htmlspecialchars($u['firstname'].' '.$u['lastname']) ?></td>
                    <td>@<?= htmlspecialchars($u['username']) ?></td>
                    <td><?= htmlspecialchars($u['email']) ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
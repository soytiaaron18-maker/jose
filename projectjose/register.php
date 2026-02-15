<?php
require_once 'db_connect.php';
$msg = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $sql = "INSERT INTO users (firstname, lastname, username, password, email) VALUES (?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    try {
        $stmt->execute([$_POST['f'], $_POST['l'], $_POST['u'], $_POST['p'], $_POST['e']]);
        $msg = "<p style='color:#4ade80;'>Success! <a href='login.php'>Login here</a></p>";
    } catch (PDOException $e) { $msg = "<p style='color:#f87171;'>Error: Username taken.</p>"; }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Join Life Changer</title>
    <style>
        body { background: #0f172a; color: white; font-family: sans-serif; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .card { background: rgba(255,255,255,0.05); padding: 40px; border-radius: 20px; border: 1px solid rgba(255,255,255,0.1); width: 350px; }
        input { width: 100%; padding: 12px; margin: 10px 0; border-radius: 8px; border: 1px solid #334155; background: #1e293b; color: white; box-sizing: border-box; }
        button { width: 100%; padding: 12px; background: #3b82f6; border: none; color: white; border-radius: 8px; font-weight: bold; cursor: pointer; }
    </style>
</head>
<body>
    <div class="card">
        <h2>Register</h2>
        <?= $msg ?>
        <form method="POST">
            <input type="text" name="f" placeholder="First Name" required>
            <input type="text" name="l" placeholder="Last Name" required>
            <input type="text" name="u" placeholder="Username" required>
            <input type="email" name="e" placeholder="Email" required>
            <input type="password" name="p" placeholder="Password" required>
            <button type="submit">Create Account</button>
        </form>
    </div>
</body>
</html>
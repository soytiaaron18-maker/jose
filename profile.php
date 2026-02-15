<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
require_once 'db_connect.php';

// Fetch user data
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$_SESSION['user_id']]);
$u = $stmt->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>About Me | <?= htmlspecialchars($u['firstname']) ?></title>
    <style>
        :root { --primary: #0f172a; --accent: #facc15; --gray: #94a3b8; }
        body { margin: 0; display: flex; font-family: 'Inter', sans-serif; height: 100vh; background: #fff; }
        
        /* Left Side: Photo Display */
        .left-side { flex: 1; background: #000; display: flex; align-items: center; justify-content: center; overflow: hidden; }
        .left-side img { width: 100%; height: 100%; object-fit: cover; border-right: 8px solid var(--accent); }
        
        /* Right Side: Information */
        .right-side { flex: 1.2; padding: 60px; display: flex; flex-direction: column; justify-content: center; background: white; }
        
        .header-box { background: var(--gray); padding: 35px; color: white; border-left: 15px solid var(--accent); margin-bottom: 30px; }
        .header-box h1 { margin: 0; font-size: 42px; text-transform: uppercase; }
        
        .signature { border-top: 2px solid #eee; padding-top: 20px; margin-top: 20px; }
        .name-title { font-size: 32px; font-weight: 800; color: #1e293b; text-transform: uppercase; margin: 0; }
        
        /* Gmail Contact Box */
        .contact-box { background: #f8fafc; padding: 25px; border-radius: 15px; margin-top: 35px; border: 1px solid #e2e8f0; }
        input, textarea { width: 100%; padding: 12px; margin-top: 10px; border: 1px solid #cbd5e1; border-radius: 8px; box-sizing: border-box; font-family: inherit; }
        
        .btn-send { background: #3b82f6; color: white; border: none; padding: 15px; border-radius: 8px; width: 100%; cursor: pointer; font-weight: bold; margin-top: 15px; transition: 0.3s; }
        .btn-send:hover { background: #2563eb; }
        
        .nav-links { margin-top: 25px; display: flex; gap: 20px; }
        .nav-links a { color: #64748b; text-decoration: none; font-weight: 600; font-size: 14px; }
    </style>
</head>
<body>

    <div class="left-side">
        <img src="IMG_20260120_221615_202.jpg" alt="Jose Profile Photo">
    </div>

    <div class="right-side">
        <div class="header-box">
            <h1>About Me</h1>
            <p>Life Changer & Community Leader</p>
        </div>

        <p style="font-size: 18px; color: #475569;">
            Hello, I am <strong><?= htmlspecialchars($u['firstname'] . " " . $u['lastname']) ?></strong>. 
            Welcome to my official profile. I'm here to make an impact.
        </p>

        <div class="signature">
            <p class="name-title"><?= htmlspecialchars($u['firstname'] . " " . $u['lastname']) ?></p>
            <p style="color: #64748b; font-style: italic; margin: 5px 0 0;">Lead Life Changer @ Project Jose</p>
        </div>

        <div class="contact-box">
            <h3 style="margin:0; color: #1e293b;">Message Me</h3>
            <form action="mailto:soytijose18@gmail.com" method="GET" enctype="text/plain">
                <input type="text" name="subject" placeholder="Subject" required>
                <textarea name="body" rows="3" placeholder="Write your message here..." required></textarea>
                <button type="submit" class="btn-send">SEND TO soytijose18@gmail.com</button>
            </form>
        </div>

        <div class="nav-links">
            <a href="dashboard.php">← BACK TO DASHBOARD</a>
            <a href="logout.php" style="color: #ef4444;">LOGOUT</a>
        </div>
    </div>

</body>
</html>
<?php
/**
 * SHIFAURA - Admin Login Page
 */
require_once __DIR__ . '/../db/connection.php';

$login_error = '';

// Check if already logged in
if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    header('Location: dashboard.php');
    exit();
}

// Handle login submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'admin_login') {
    $username = trim(filter_input(INPUT_POST, 'username', FILTER_SANITIZE_SPECIAL_CHARS));
    $password = trim(filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS));

    if (!empty($username) && !empty($password)) {
        try {
            $stmt = $pdo->prepare("SELECT * FROM admins WHERE username = :username");
            $stmt->execute([':username' => $username]);
            $admin = $stmt->fetch();

            if ($admin && password_verify($password, $admin['password'])) {
                // Secure login
                $_SESSION['admin_logged_in'] = true;
                $_SESSION['admin_username'] = $admin['username'];
                
                header('Location: dashboard.php');
                exit();
            } else {
                $login_error = 'Invalid username or password.';
            }
        } catch (PDOException $e) {
            $login_error = 'Database connection error: ' . $e->getMessage();
        }
    } else {
        $login_error = 'Please enter both fields.';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Practitioner Login | SHIFAURA</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <!-- Feather Icons -->
    <script src="https://unpkg.com/feather-icons"></script>
</head>
<body class="admin-login-wrapper">

    <div class="admin-login-card">
        <div style="text-align: center; margin-bottom: 2rem;">
            <a href="../index.php" style="display: inline-block;">
                <img src="../assets/images/logo.png" alt="SHIFAURA by Dietitian Shifana" style="height: 64px; width: auto; display: block; margin: 0 auto;">
            </a>
            <p style="font-size: 0.75rem; text-transform: uppercase; color: var(--gold); letter-spacing: 0.15em; font-weight: 600; margin-top: 0.5rem;">Practitioner Console</p>
        </div>

        <?php if (!empty($login_error)): ?>
            <div style="background-color: #FEE2E2; border: 1px solid #EF4444; color: #B91C1C; padding: 0.75rem 1rem; border-radius: var(--radius-sm); margin-bottom: 1.5rem; font-size: 0.85rem; display: flex; align-items: center; gap: 0.5rem;">
                <i data-feather="alert-circle" style="width: 16px; height: 16px;"></i>
                <span><?php echo $login_error; ?></span>
            </div>
        <?php endif; ?>

        <form method="POST" action="login.php">
            <input type="hidden" name="action" value="admin_login">
            
            <div class="form-group">
                <label for="username">Admin Username</label>
                <input type="text" id="username" name="username" required placeholder="e.g. admin" value="admin" style="background-color: #FFFFFF;">
            </div>

            <div class="form-group" style="margin-bottom: 1.75rem;">
                <label for="password">Security Password</label>
                <input type="password" id="password" name="password" required placeholder="Security Password" value="Password123" style="background-color: #FFFFFF;">
            </div>

            <button type="submit" class="btn btn-primary" style="width: 100%; justify-content: center;">Authenticate Access</button>
        </form>

        <div style="margin-top: 1.5rem; text-align: center;">
            <a href="../index.php" style="font-size: 0.8rem; color: var(--text-muted); display: inline-flex; align-items: center; gap: 0.25rem;">
                <i data-feather="arrow-left" style="width: 14px; height: 14px;"></i> Return to Website
            </a>
        </div>
        
        <!-- Notice block for quick testing in local environments -->
        <div style="margin-top: 2rem; background-color: var(--sandal-light); border: 1px dashed var(--sandal-border); padding: 0.75rem; border-radius: var(--radius-sm); font-size: 0.75rem; text-align: center; color: var(--text-muted);">
            <strong>Demo Credentials:</strong><br>
            Username: <code>admin</code> | Password: <code>Password123</code>
        </div>
    </div>

    <script>
        feather.replace();
    </script>
</body>
</html>

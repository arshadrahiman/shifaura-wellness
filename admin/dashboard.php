<?php
/**
 * SHIFAURA - Admin Dashboard Console
 */
require_once __DIR__ . '/../db/connection.php';

// Route Guard: Ensure authenticated access
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: login.php');
    exit();
}

$dashboard_message = '';
$dashboard_error = '';

// Handle Admin Actions (Update / Delete)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    $action = $_POST['action'];
    $target_id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);

    if ($target_id) {
        try {
            if ($action === 'update_booking_status') {
                $new_status = trim(filter_input(INPUT_POST, 'status', FILTER_SANITIZE_SPECIAL_CHARS));
                if (in_array($new_status, ['Pending', 'Contacted', 'Completed'])) {
                    $stmt = $pdo->prepare("UPDATE bookings SET status = :status WHERE id = :id");
                    $stmt->execute([':status' => $new_status, ':id' => $target_id]);
                    $dashboard_message = "Booking #{$target_id} status updated successfully.";
                }
            } elseif ($action === 'delete_booking') {
                $stmt = $pdo->prepare("DELETE FROM bookings WHERE id = :id");
                $stmt->execute([':id' => $target_id]);
                $dashboard_message = "Booking #{$target_id} deleted successfully.";
            } elseif ($action === 'delete_purchase') {
                $stmt = $pdo->prepare("DELETE FROM purchases WHERE id = :id");
                $stmt->execute([':id' => $target_id]);
                $dashboard_message = "Purchase record #{$target_id} deleted successfully.";
            } elseif ($action === 'refund_purchase') {
                $stmt = $pdo->prepare("UPDATE purchases SET payment_status = 'Refunded' WHERE id = :id");
                $stmt->execute([':id' => $target_id]);
                $dashboard_message = "Purchase #{$target_id} status updated to Refunded.";
            }
        } catch (PDOException $e) {
            $dashboard_error = "Operation failed: " . $e->getMessage();
        }
    }
}

// Fetch Stats for Dashboard widgets
try {
    // Total Bookings
    $total_bookings = $pdo->query("SELECT COUNT(*) FROM bookings")->fetchColumn();
    // Pending Bookings
    $pending_bookings = $pdo->query("SELECT COUNT(*) FROM bookings WHERE status = 'Pending'")->fetchColumn();
    // Total Purchases
    $total_purchases = $pdo->query("SELECT COUNT(*) FROM purchases WHERE payment_status = 'Paid'")->fetchColumn();
    // Total Revenue
    $total_revenue = $pdo->query("SELECT SUM(price) FROM purchases WHERE payment_status = 'Paid'")->fetchColumn();
    $total_revenue = $total_revenue ? $total_revenue : 0;

    // Fetch lists
    $bookings_list = $pdo->query("SELECT * FROM bookings ORDER BY id DESC LIMIT 50")->fetchAll();
    $purchases_list = $pdo->query("SELECT * FROM purchases ORDER BY id DESC LIMIT 50")->fetchAll();
} catch (PDOException $e) {
    die("Data loading failed: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wellness Dashboard | SHIFAURA Console</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <!-- Feather Icons -->
    <script src="https://unpkg.com/feather-icons"></script>
</head>
<body class="admin-body">

    <!-- Admin Header Panel -->
    <header class="admin-header">
        <a href="dashboard.php" class="logo-img-link">
            <img src="../assets/images/logo.png" alt="SHIFAURA by Dietitian Shifana" style="height: 48px; width: auto; background: rgba(255,255,255,0.9); padding: 4px 10px; border-radius: var(--radius-sm); display: block;">
        </a>

        <div class="admin-header-nav">
            <span style="font-size: 0.85rem; color: var(--sandal-medium);">Logged in as: <strong><?php echo htmlspecialchars($_SESSION['admin_username']); ?></strong></span>
            <a href="../index.php" target="_blank"><i data-feather="external-link" style="width: 16px; height: 16px; vertical-align: middle;"></i> View Site</a>
            <a href="logout.php" style="color: #EF4444;"><i data-feather="power" style="width: 16px; height: 16px; vertical-align: middle;"></i> Log out</a>
        </div>
    </header>

    <div class="admin-container">
        
        <!-- Alerts Display -->
        <?php if (!empty($dashboard_message)): ?>
            <div style="background-color: #D1FAE5; border: 1px solid #10B981; color: #065F46; padding: 1rem; border-radius: var(--radius-sm); margin-bottom: 2rem; display: flex; align-items: center; gap: 0.5rem; font-size: 0.9rem;">
                <i data-feather="check-circle"></i>
                <span><?php echo $dashboard_message; ?></span>
            </div>
        <?php endif; ?>

        <?php if (!empty($dashboard_error)): ?>
            <div style="background-color: #FEE2E2; border: 1px solid #EF4444; color: #B91C1C; padding: 1rem; border-radius: var(--radius-sm); margin-bottom: 2rem; display: flex; align-items: center; gap: 0.5rem; font-size: 0.9rem;">
                <i data-feather="alert-circle"></i>
                <span><?php echo $dashboard_error; ?></span>
            </div>
        <?php endif; ?>

        <!-- 1. Stats Counter Widgets -->
        <div class="admin-stats-grid">
            <div class="admin-stat-card">
                <div class="admin-stat-label">Total Revenue</div>
                <div class="admin-stat-value"><?php echo CURRENCY_SYMBOL . number_format($total_revenue); ?></div>
            </div>
            <div class="admin-stat-card">
                <div class="admin-stat-label">Diet Sales</div>
                <div class="admin-stat-value"><?php echo $total_purchases; ?></div>
            </div>
            <div class="admin-stat-card">
                <div class="admin-stat-label">Consultation Bookings</div>
                <div class="admin-stat-value"><?php echo $total_bookings; ?></div>
            </div>
            <div class="admin-stat-card">
                <div class="admin-stat-label">Pending Follow Ups</div>
                <div class="admin-stat-value" style="color: #92400E;"><?php echo $pending_bookings; ?></div>
            </div>
        </div>

        <!-- 2. Diet Program purchases Section -->
        <div class="admin-panel-card">
            <div class="admin-panel-header">
                <h3>Plan Registrations & Purchases</h3>
                <span class="badge" style="background-color: var(--green-light); color: var(--green-dark);"><?php echo count($purchases_list); ?> Records</span>
            </div>
            
            <div class="admin-table-container">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Client Info</th>
                            <th>Package details</th>
                            <th>Paid price</th>
                            <th>Transaction hash</th>
                            <th>Status</th>
                            <th>Purchased At</th>
                            <th>Control actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (count($purchases_list) === 0): ?>
                            <tr>
                                <td colspan="8" style="text-align: center; color: var(--text-muted); padding: 3rem;">No purchase records registered in the database yet.</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($purchases_list as $row): ?>
                                <tr>
                                    <td><strong>#<?php echo $row['id']; ?></strong></td>
                                    <td>
                                        <div style="font-weight: 600;"><?php echo htmlspecialchars($row['client_name']); ?></div>
                                        <div style="font-size: 0.75rem; color: var(--text-muted);"><?php echo htmlspecialchars($row['client_email']); ?> | <?php echo htmlspecialchars($row['client_phone']); ?></div>
                                        <div style="font-size: 0.7rem; color: var(--gold-dark);">Age: <?php echo $row['client_age']; ?> | Gender: <?php echo htmlspecialchars($row['client_gender']); ?></div>
                                    </td>
                                    <td>
                                        <div style="font-weight: 500;"><?php echo htmlspecialchars($row['package_name']); ?></div>
                                        <div style="font-size: 0.75rem; color: var(--text-muted);"><?php echo htmlspecialchars($row['package_duration']); ?> plan</div>
                                        <div style="font-size: 0.7rem; color: var(--text-muted); max-width: 250px; text-overflow: ellipsis; overflow: hidden; white-space: nowrap;" title="<?php echo htmlspecialchars($row['health_conditions']); ?>">Clinical: <?php echo htmlspecialchars($row['health_conditions']); ?></div>
                                    </td>
                                    <td><strong><?php echo CURRENCY_SYMBOL . number_format($row['price']); ?></strong></td>
                                    <td><code style="font-size: 0.75rem;"><?php echo htmlspecialchars($row['transaction_id']); ?></code></td>
                                    <td>
                                        <span class="status-badge <?php echo $row['payment_status'] === 'Paid' ? 'completed' : 'pending'; ?>">
                                            <?php echo htmlspecialchars($row['payment_status']); ?>
                                        </span>
                                    </td>
                                    <td style="font-size: 0.75rem; color: var(--text-muted);"><?php echo $row['created_at']; ?></td>
                                    <td>
                                        <div style="display: flex; gap: 0.5rem;">
                                            <?php if ($row['payment_status'] === 'Paid'): ?>
                                                <form method="POST" action="dashboard.php" style="margin: 0;" onsubmit="return confirm('Are you sure you want to refund this transaction?');">
                                                    <input type="hidden" name="action" value="refund_purchase">
                                                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                                    <button type="submit" class="admin-btn">Refund</button>
                                                </form>
                                            <?php endif; ?>
                                            <form method="POST" action="dashboard.php" style="margin: 0;" onsubmit="return confirm('Are you sure you want to delete this purchase record?');">
                                                <input type="hidden" name="action" value="delete_purchase">
                                                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                                <button type="submit" class="admin-btn danger">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- 3. Consultation Bookings Section -->
        <div class="admin-panel-card">
            <div class="admin-panel-header">
                <h3>Consultation Booking Requests</h3>
                <span class="badge" style="background-color: var(--green-light); color: var(--green-dark);"><?php echo count($bookings_list); ?> Enquiries</span>
            </div>

            <div class="admin-table-container">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Applicant info</th>
                            <th>Goal / Message</th>
                            <th>Requested date & time</th>
                            <th>Status</th>
                            <th>Submitted At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (count($bookings_list) === 0): ?>
                            <tr>
                                <td colspan="7" style="text-align: center; color: var(--text-muted); padding: 3rem;">No consultation enquiries in the database yet.</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($bookings_list as $row): ?>
                                <tr>
                                    <td><strong>#<?php echo $row['id']; ?></strong></td>
                                    <td>
                                        <div style="font-weight: 600;"><?php echo htmlspecialchars($row['name']); ?></div>
                                        <div style="font-size: 0.75rem; color: var(--text-muted);"><?php echo htmlspecialchars($row['email']); ?> | <?php echo htmlspecialchars($row['phone']); ?></div>
                                    </td>
                                    <td>
                                        <span class="badge" style="font-size: 0.65rem; margin-bottom: 0.25rem; display: inline-block;"><?php echo htmlspecialchars($row['health_goal']); ?></span>
                                        <div style="font-size: 0.8rem; color: var(--text-muted); max-width: 280px;"><?php echo htmlspecialchars($row['message']); ?></div>
                                    </td>
                                    <td>
                                        <div style="font-weight: 500; font-size: 0.85rem;"><?php echo htmlspecialchars($row['preferred_date']); ?></div>
                                        <div style="font-size: 0.75rem; color: var(--text-muted);"><?php echo htmlspecialchars($row['preferred_time']); ?></div>
                                    </td>
                                    <td>
                                        <span class="status-badge <?php echo strtolower($row['status']); ?>">
                                            <?php echo htmlspecialchars($row['status']); ?>
                                        </span>
                                    </td>
                                    <td style="font-size: 0.75rem; color: var(--text-muted);"><?php echo $row['created_at']; ?></td>
                                    <td>
                                        <div style="display: flex; gap: 0.5rem; flex-wrap: wrap;">
                                            <form method="POST" action="dashboard.php" style="margin: 0;">
                                                <input type="hidden" name="action" value="update_booking_status">
                                                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                                <select name="status" onchange="this.form.submit()" style="font-size: 0.75rem; padding: 0.25rem; border-radius: var(--radius-sm); border: 1px solid var(--sandal-border);">
                                                    <option value="Pending" <?php if ($row['status'] === 'Pending') echo 'selected'; ?>>Pending</option>
                                                    <option value="Contacted" <?php if ($row['status'] === 'Contacted') echo 'selected'; ?>>Contacted</option>
                                                    <option value="Completed" <?php if ($row['status'] === 'Completed') echo 'selected'; ?>>Completed</option>
                                                </select>
                                            </form>
                                            
                                            <form method="POST" action="dashboard.php" style="margin: 0;" onsubmit="return confirm('Are you sure you want to delete this enquiry?');">
                                                <input type="hidden" name="action" value="delete_booking">
                                                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                                <button type="submit" class="admin-btn danger">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <script>
        feather.replace();
    </script>
</body>
</html>

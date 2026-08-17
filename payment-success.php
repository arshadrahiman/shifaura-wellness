<?php
/**
 * SHIFAURA - Payment Success Receipt Page
 */
require_once __DIR__ . '/db/connection.php';

// Check for session-stored purchase ID
$purchase_id = isset($_SESSION['last_purchase_id']) ? $_SESSION['last_purchase_id'] : null;

$purchase = null;
if ($purchase_id) {
    try {
        $stmt = $pdo->prepare("SELECT * FROM purchases WHERE id = :id");
        $stmt->execute([':id' => $purchase_id]);
        $purchase = $stmt->fetch();
    } catch (PDOException $e) {
        // Fail silently and use demo data
    }
}

// Fallback to demo data if accessed directly without session (for demo/testing convenience)
if (!$purchase) {
    $purchase = [
        'client_name' => 'Jane Doe',
        'client_email' => 'jane@example.com',
        'client_phone' => '+91 6381 757 067',
        'package_name' => 'Weight Management',
        'package_duration' => '3 Months',
        'price' => 7499,
        'transaction_id' => 'TXN-DEMO' . strtoupper(bin2hex(random_bytes(3))),
        'created_at' => date('Y-m-d H:i:s')
    ];
}

$page_title = 'Registration Successful!';
include_once __DIR__ . '/includes/header.php';
?>

    <section style="padding: 5rem 0;">
        <div class="container">
            <div class="success-card">
                <div class="success-icon">
                    <i data-feather="check" style="width: 48px; height: 48px;"></i>
                </div>
                
                <h2>Welcome to SHIFAURA!</h2>
                <p style="font-size: 1.1rem; color: var(--text-muted); max-width: 500px; margin: 0 auto;">
                    Thank you for choosing Dietitian Shifana.I to guide you. Your payment was processed successfully.
                </p>

                <!-- Detailed Receipt Box -->
                <div class="success-details">
                    <div style="font-size: 0.8rem; font-weight: 700; text-transform: uppercase; color: var(--gold); border-bottom: 1px solid var(--sandal-border); padding-bottom: 0.5rem; margin-bottom: 1rem; letter-spacing: 0.05em;">Transaction Details</div>
                    
                    <div style="display: flex; justify-content: space-between; margin-bottom: 0.5rem; font-size: 0.85rem;">
                        <span style="color: var(--text-muted);">Client Name:</span>
                        <strong style="color: var(--green-dark);"><?php echo htmlspecialchars($purchase['client_name']); ?></strong>
                    </div>

                    <div style="display: flex; justify-content: space-between; margin-bottom: 0.5rem; font-size: 0.85rem;">
                        <span style="color: var(--text-muted);">Registered Program:</span>
                        <strong style="color: var(--green-dark);"><?php echo htmlspecialchars($purchase['package_name']); ?> (<?php echo htmlspecialchars($purchase['package_duration']); ?>)</strong>
                    </div>

                    <div style="display: flex; justify-content: space-between; margin-bottom: 0.5rem; font-size: 0.85rem;">
                        <span style="color: var(--text-muted);">Email Address:</span>
                        <strong style="color: var(--green-dark);"><?php echo htmlspecialchars($purchase['client_email']); ?></strong>
                    </div>

                    <div style="display: flex; justify-content: space-between; margin-bottom: 0.5rem; font-size: 0.85rem;">
                        <span style="color: var(--text-muted);">Transaction ID:</span>
                        <code style="background-color: var(--sandal-medium); padding: 0.1rem 0.4rem; border-radius: 3px; font-size: 0.75rem; font-weight: 600; color: var(--green-dark);"><?php echo htmlspecialchars($purchase['transaction_id']); ?></code>
                    </div>

                    <div style="display: flex; justify-content: space-between; margin-bottom: 0.5rem; font-size: 0.85rem;">
                        <span style="color: var(--text-muted);">Paid Amount:</span>
                        <strong style="color: var(--green-dark); font-size: 1rem;"><?php echo CURRENCY_SYMBOL . number_format($purchase['price']); ?></strong>
                    </div>

                    <div style="display: flex; justify-content: space-between; font-size: 0.85rem;">
                        <span style="color: var(--text-muted);">Status:</span>
                        <span class="badge" style="background-color: #D1FAE5; color: #065F46; font-size: 0.65rem;">Paid / Approved</span>
                    </div>
                </div>

                <!-- Next Steps Instructions -->
                <div style="text-align: left; margin: 2rem 0; border: 1px dashed var(--sandal-border); padding: 1.5rem; border-radius: var(--radius-md); background-color: var(--sandal-light);">
                    <h4 style="font-size: 1.15rem; color: var(--green-dark); margin-bottom: 0.75rem; display: flex; align-items: center; gap: 0.5rem;">
                        <i data-feather="arrow-right-circle" style="color: var(--gold);"></i> Next Steps to Onboard
                    </h4>
                    <ol style="margin-left: 1.25rem; font-size: 0.85rem; color: var(--text-muted); display: flex; flex-direction: column; gap: 0.5rem;">
                        <li><strong>Download your Onboard Audit Form</strong> below to share your detailed diet-medical history.</li>
                        <li>Check your email inbox for your registration confirmation.</li>
                        <li>Dietitian Shifana.I's coordinator will text or call you on <strong><?php echo htmlspecialchars($purchase['client_phone']); ?></strong> within the next 24 hours to schedule your initial consultation.</li>
                    </ol>
                </div>

                <div style="display: flex; flex-direction: column; gap: 1rem;">
                    <!-- Mock Onboarding PDF Download link -->
                    <a href="javascript:void(0);" onclick="alert('Download started: SHIFAURA_Welcome_Kit.pdf (Mock file)');" class="btn btn-gold" style="justify-content: center;">
                        <i data-feather="download" style="margin-right: 0.5rem;"></i> Download Onboarding welcome kit
                    </a>
                    
                    <a href="index.php" class="btn btn-secondary" style="justify-content: center;">Return to Homepage</a>
                </div>
            </div>
        </div>
    </section>

<?php
include_once __DIR__ . '/includes/footer.php';
?>

<?php
/**
 * SHIFAURA - Checkout & Payment Simulation Page
 */
require_once __DIR__ . '/db/connection.php';

// Fetch package and duration parameters
$pkg_key = filter_input(INPUT_GET, 'package', FILTER_SANITIZE_SPECIAL_CHARS);
$duration = filter_input(INPUT_GET, 'duration', FILTER_VALIDATE_INT);

// Fallbacks
if (!$pkg_key || !isset($diet_packages[$pkg_key])) {
    $pkg_key = 'weight-management';
}
if (!$duration || !in_array($duration, [1, 3, 6])) {
    $duration = 3;
}

$package = $diet_packages[$pkg_key];
$price = $package['prices'][$duration];

$checkout_error = '';

// Handle Checkout Form Submission (POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'complete_purchase') {
    // Collect client details
    $client_name = trim(filter_input(INPUT_POST, 'client_name', FILTER_SANITIZE_SPECIAL_CHARS));
    $client_email = trim(filter_input(INPUT_POST, 'client_email', FILTER_SANITIZE_EMAIL));
    $client_phone = trim(filter_input(INPUT_POST, 'client_phone', FILTER_SANITIZE_SPECIAL_CHARS));
    $client_age = filter_input(INPUT_POST, 'client_age', FILTER_VALIDATE_INT);
    $client_gender = trim(filter_input(INPUT_POST, 'client_gender', FILTER_SANITIZE_SPECIAL_CHARS));
    $conditions = trim(filter_input(INPUT_POST, 'health_conditions', FILTER_SANITIZE_SPECIAL_CHARS));
    $pm = trim(filter_input(INPUT_POST, 'payment_method', FILTER_SANITIZE_SPECIAL_CHARS));

    // Validate details
    if (!empty($client_name) && !empty($client_email) && !empty($client_phone) && $client_age > 0 && !empty($client_gender)) {
        // Payment Simulation logic: always approves if details are supplied
        $txn_id = 'TXN-' . strtoupper(bin2hex(random_bytes(5)));
        
        try {
            $stmt = $pdo->prepare("INSERT INTO purchases (package_name, package_duration, price, client_name, client_email, client_phone, client_age, client_gender, health_conditions, transaction_id, payment_status) VALUES (:pkg_name, :duration, :price, :name, :email, :phone, :age, :gender, :conditions, :txn_id, 'Paid')");
            
            $duration_label = $duration === 1 ? '1 Month' : ($duration === 3 ? '3 Months' : '6 Months');
            
            $stmt->execute([
                ':pkg_name' => $package['title'],
                ':duration' => $duration_label,
                ':price' => $price,
                ':name' => $client_name,
                ':email' => $client_email,
                ':phone' => $client_phone,
                ':age' => $client_age,
                ':gender' => $client_gender,
                ':conditions' => $conditions,
                ':txn_id' => $txn_id
            ]);

            // Save purchase ID to session to display on success page
            $_SESSION['last_purchase_id'] = $pdo->lastInsertId();

            // Send Email Notification to Dietitian Shifana
            $to = "info@dietitianshifana.com";
            $subject = "New Diet Program Registration: " . $package['title'] . " - " . $client_name;
            
            $headers = "From: SHIFAURA Wellness <noreply@dietitianshifana.com>\r\n";
            $headers .= "Reply-To: " . $client_email . "\r\n";
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

            $html_conditions = !empty($conditions) ? nl2br(htmlspecialchars($conditions)) : 'None listed';
            $mail_body = "
            <html>
            <head><title>New Program Registration</title></head>
            <body style='font-family: Arial, sans-serif; background-color: #FAF7F2; padding: 20px;'>
                <div style='background-color: #FFFFFF; border: 1px solid #DCD0B7; padding: 25px; border-radius: 8px; max-width: 600px; margin: 0 auto;'>
                    <h2 style='color: #1E3A2B; border-bottom: 2px solid #BCA374; padding-bottom: 10px; margin-top: 0;'>New Program Registration Received</h2>
                    <p style='margin: 8px 0;'><strong>Program Purchased:</strong> {$package['title']} ({$duration_label})</p>
                    <p style='margin: 8px 0;'><strong>Amount Paid:</strong> ₹" . number_format($price) . "</p>
                    <p style='margin: 8px 0;'><strong>Transaction ID:</strong> {$txn_id}</p>
                    <hr style='border: none; border-top: 1px solid #E6DBC6; margin: 15px 0;'>
                    <p style='margin: 8px 0;'><strong>Client Name:</strong> {$client_name}</p>
                    <p style='margin: 8px 0;'><strong>Email:</strong> <a href='mailto:{$client_email}'>{$client_email}</a></p>
                    <p style='margin: 8px 0;'><strong>Phone:</strong> <a href='tel:{$client_phone}'>{$client_phone}</a></p>
                    <p style='margin: 8px 0;'><strong>Age / Gender:</strong> {$client_age} | {$client_gender}</p>
                    <div style='margin-top: 15px; padding: 12px; background-color: #F3ECE1; border-radius: 6px;'>
                        <strong>Health Conditions / Background:</strong><br>{$html_conditions}
                    </div>
                </div>
            </body>
            </html>
            ";

            @mail($to, $subject, $mail_body, $headers);
            
            header('Location: payment-success.php');
            exit();

        } catch (PDOException $e) {
            $checkout_error = 'Database storage failed. Please check inputs: ' . $e->getMessage();
        }
    } else {
        $checkout_error = 'Please fill out all mandatory customer registration fields.';
    }
}

$page_title = 'Checkout - Register for ' . $package['title'];
include_once __DIR__ . '/includes/header.php';
?>

    <!-- Page Title Header -->
    <header class="page-header">
        <div class="container">
            <span class="badge" style="margin-bottom: 0.75rem;">Secure Checkout</span>
            <h1>Register & Purchase Plan</h1>
            <p>You are registering for the <strong><?php echo $package['title']; ?></strong> Program.</p>
        </div>
    </header>

    <!-- Checkout Form Layout -->
    <section>
        <div class="container">
            <?php if (!empty($checkout_error)): ?>
                <div style="background-color: #FEE2E2; border: 1px solid #EF4444; color: #B91C1C; padding: 1.25rem; border-radius: var(--radius-sm); margin-bottom: 2.5rem; display: flex; align-items: center; gap: 0.75rem;">
                    <i data-feather="alert-circle"></i>
                    <span><?php echo $checkout_error; ?></span>
                </div>
            <?php endif; ?>

            <div class="checkout-grid">
                <!-- Left Form Side -->
                <div class="checkout-card">
                    <form id="checkout-form" method="POST" action="checkout.php?package=<?php echo $pkg_key; ?>&duration=<?php echo $duration; ?>">
                        <input type="hidden" name="action" value="complete_purchase">
                        <input type="hidden" name="payment_method" id="selected_payment_method" value="card">

                        <!-- Step 1: Health & Profile Details -->
                        <div class="checkout-step-title">
                            <span class="checkout-step-number">1</span>
                            <span>Client Profile & Health Intake</span>
                        </div>

                        <div class="form-grid">
                            <div class="form-group">
                                <label for="client_name">Full Name *</label>
                                <input type="text" id="client_name" name="client_name" required placeholder="e.g. Jane Doe">
                            </div>
                            <div class="form-group">
                                <label for="client_email">Email Address *</label>
                                <input type="email" id="client_email" name="client_email" required placeholder="e.g. jane@example.com">
                            </div>
                        </div>

                        <div class="form-grid">
                            <div class="form-group">
                                <label for="client_phone">Phone / WhatsApp Number *</label>
                                <input type="tel" id="client_phone" name="client_phone" required placeholder="e.g. +91 9876543210">
                            </div>
                            <div class="form-grid" style="gap: 1rem; margin: 0; padding: 0;">
                                <div class="form-group" style="margin: 0;">
                                    <label for="client_age">Age *</label>
                                    <input type="number" id="client_age" name="client_age" min="1" max="120" required placeholder="Age">
                                </div>
                                <div class="form-group" style="margin: 0;">
                                    <label for="client_gender">Gender *</label>
                                    <select id="client_gender" name="client_gender" required>
                                        <option value="" disabled selected>Select</option>
                                        <option value="Female">Female</option>
                                        <option value="Male">Male</option>
                                        <option value="Non-Binary">Other</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group full-width" style="margin-bottom: 2.5rem;">
                            <label for="health_conditions">Describe any health conditions (PMOS, Diabetes, Thyroid, High BP, etc.) *</label>
                            <textarea id="health_conditions" name="health_conditions" rows="3" required placeholder="Specify any clinical diagnoses, medications, or health symptoms Shifana needs to consider."></textarea>
                        </div>

                        <!-- Step 2: Payment Simulation -->
                        <div class="checkout-step-title">
                            <span class="checkout-step-number">2</span>
                            <span>Simulated Payment Gateway</span>
                        </div>
                        <p style="font-size: 0.8rem; color: var(--text-muted); margin-bottom: 1.25rem;">This is a simulated secure payment node. No real money will be charged. Please enter mock credentials to process.</p>

                        <!-- Payment Methods Tab -->
                        <div class="payment-methods">
                            <div class="payment-method-btn active" data-method="card" data-target="#card-payment-details">
                                <i data-feather="credit-card" style="width: 16px; height: 16px; vertical-align: middle; margin-right: 0.5rem;"></i>
                                Card Payment
                            </div>
                            <div class="payment-method-btn" data-method="upi" data-target="#upi-payment-details">
                                <i data-feather="phone-call" style="width: 16px; height: 16px; vertical-align: middle; margin-right: 0.5rem;"></i>
                                UPI Scan & Pay
                            </div>
                        </div>

                        <!-- Card payment interface -->
                        <div class="payment-details-panel active" id="card-payment-details">
                            <div class="form-group">
                                <label for="card_holder">Cardholder Name</label>
                                <input type="text" id="card_holder" placeholder="e.g. Jane Doe" value="Jane Doe">
                            </div>
                            <div class="form-group">
                                <label for="card_number">Card Number</label>
                                <input type="text" id="card_number" placeholder="4111 2222 3333 4444" value="4111 2222 3333 4444">
                            </div>
                            <div class="form-grid">
                                <div class="form-group">
                                    <label for="card_expiry">Expiry Date</label>
                                    <input type="text" id="card_expiry" placeholder="MM/YY" value="12/29">
                                </div>
                                <div class="form-group">
                                    <label for="card_cvv">CVV</label>
                                    <input type="password" id="card_cvv" placeholder="e.g. 123" value="123">
                                </div>
                            </div>
                        </div>

                        <!-- UPI payment interface -->
                        <div class="payment-details-panel" id="upi-payment-details">
                            <div style="text-align: center; padding: 1.5rem; background-color: var(--sandal-medium); border: 1px solid var(--sandal-border); border-radius: var(--radius-sm);">
                                <span style="font-size: 3rem; display: block; margin-bottom: 0.5rem;">📱</span>
                                <h4 style="font-size: 1.1rem; color: var(--green-dark); margin-bottom: 0.5rem;">Scan QR to Pay via BHIM UPI</h4>
                                <p style="font-size: 0.8rem; color: var(--text-muted); margin-bottom: 1rem;">Open your preferred UPI app (GPay, PhonePe, Paytm) and scan this simulation node.</p>
                                <div style="display: inline-block; background-color: var(--white); padding: 0.75rem; border: 1px solid var(--sandal-border); border-radius: var(--radius-sm); margin-bottom: 1rem;">
                                    <!-- Simple SVG QR simulation representation -->
                                    <svg width="120" height="120" viewBox="0 0 100 100" fill="var(--green-dark)">
                                        <path d="M0 0h30v10H10v20H0V0zm70 0h30v30H90v-20H70V0zM0 70h10v20h20v10H0V70zm90 20v-20h10v30H70v-10h20zM30 30h40v40H30V30zm10 10v20h20V40H40z"/>
                                    </svg>
                                </div>
                                <div class="form-group" style="text-align: left; max-width: 300px; margin: 0 auto;">
                                    <label for="upi_id" style="font-size: 0.7rem;">Enter your UPI ID to verify</label>
                                    <input type="text" id="upi_id" placeholder="e.g. username@okhdfc" value="shifaura@upi">
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary" style="width: 100%; justify-content: center; margin-top: 2rem; font-size: 1rem; padding: 1rem 2rem;">
                            Authorize Payment of <?php echo CURRENCY_SYMBOL . number_format($price); ?> &rarr;
                        </button>
                    </form>
                </div>

                <!-- Right Invoice / Pricing summary side -->
                <div>
                    <div class="summary-card">
                        <h3>Order Summary</h3>
                        
                        <div style="margin-bottom: 1.5rem; padding-bottom: 1.5rem; border-bottom: 1px solid var(--sandal-border);">
                            <h4 style="font-size: 1.25rem; color: var(--green-dark); margin-bottom: 0.25rem; font-weight: 600;"><?php echo $package['title']; ?> Program</h4>
                            <p style="font-size: 0.8rem; color: var(--text-muted);">Diet and Wellness Plan &bull; Customized</p>
                        </div>

                        <div class="summary-row">
                            <span>Plan Duration:</span>
                            <strong style="color: var(--green-dark);"><?php 
                                echo $duration === 1 ? '1 Month (Kickstart)' : ($duration === 3 ? '3 Months (Standard)' : '6 Months (Transformation)'); 
                            ?></strong>
                        </div>

                        <div class="summary-row">
                            <span>Dietitian Consultation:</span>
                            <strong style="color: var(--success);">Included (Free)</strong>
                        </div>

                        <div class="summary-row">
                            <span>WhatsApp Coaching:</span>
                            <strong style="color: var(--success);">Included (Unlimited)</strong>
                        </div>

                        <div class="summary-row">
                            <span>Base Price:</span>
                            <span><?php echo CURRENCY_SYMBOL . number_format($price * 0.85); ?></span>
                        </div>

                        <div class="summary-row">
                            <span>GST / Government Taxes (18%):</span>
                            <span><?php echo CURRENCY_SYMBOL . number_format($price * 0.15); ?></span>
                        </div>

                        <div class="summary-total">
                            <span>Total Price:</span>
                            <span><?php echo CURRENCY_SYMBOL . number_format($price); ?></span>
                        </div>

                        <div style="background-color: var(--white); padding: 1rem; border-radius: var(--radius-sm); border: 1px solid var(--sandal-border); margin-top: 1rem; display: flex; gap: 0.5rem; align-items: center;">
                            <i data-feather="shield" style="color: var(--gold); width: 22px; height: 22px; flex-shrink: 0;"></i>
                            <span style="font-size: 0.75rem; color: var(--text-muted); line-height: 1.4;">Your details are protected using industry-grade SSL encryption and processed on a simulated database.</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Custom inline JS to switch payment tabs on this page -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const btns = document.querySelectorAll('.payment-method-btn');
            const panels = document.querySelectorAll('.payment-details-panel');
            const hiddenMethodInput = document.getElementById('selected_payment_method');
            
            btns.forEach(btn => {
                btn.addEventListener('click', () => {
                    // Remove active classes
                    btns.forEach(b => b.classList.remove('active'));
                    panels.forEach(p => p.classList.remove('active'));
                    
                    // Add active class to clicked button
                    btn.classList.add('active');
                    
                    // Add active class to target panel
                    const targetId = btn.getAttribute('data-target').replace('#', '');
                    const targetPanel = document.getElementById(targetId);
                    if (targetPanel) {
                        targetPanel.classList.add('active');
                    }
                    
                    // Update hidden method value
                    hiddenMethodInput.value = btn.getAttribute('data-method');
                });
            });
        });
    </script>

<?php
include_once __DIR__ . '/includes/footer.php';
?>

<?php
/**
 * SHIFAURA - Services Page
 */
require_once __DIR__ . '/db/config.php';

$page_title = 'Our Programs & Services';
$page_description = 'Explore personalized nutrition packages by Dietitian Shifana.I. Weight management, diabetes control, thyroid plans, PMOS support, and holistic wellness.';
include_once __DIR__ . '/includes/header.php';
?>

    <!-- Page Title Header -->
    <header class="page-header">
        <div class="container">
            <span class="badge" style="margin-bottom: 0.75rem;">Specialist Programs</span>
            <h1>Diet Services & Packages</h1>
            <p>Select a structured nutrition and wellness program tailored to your medical history and health goals.</p>
        </div>
    </header>

    <!-- Detailed Packages Section -->
    <section>
        <div class="container">
            <div class="section-header center">
                <span class="tag">Sustainable Healing</span>
                <h2>Find the Right Plan for You</h2>
                <p>All programs include a comprehensive initial medical-diet history audit, weekly reviews, custom recipe libraries, and continuous WhatsApp support.</p>
            </div>

            <!-- Services grid dynamically loaded from configuration file -->
            <div class="packages-grid" style="grid-template-columns: repeat(3, 1fr); gap: 2.5rem; row-gap: 4rem;">
                <?php foreach ($diet_packages as $key => $pkg): ?>
                    <div class="package-card" 
                         id="card-<?php echo $key; ?>" 
                         data-price-1="<?php echo $pkg['prices']['1']; ?>" 
                         data-price-3="<?php echo $pkg['prices']['3']; ?>" 
                         data-price-6="<?php echo $pkg['prices']['6']; ?>">
                        
                        <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 1rem;">
                            <span style="font-size: 2.5rem; filter: grayscale(0.2);"><?php 
                                // Map icons to emojis for clean presentation
                                switch($pkg['icon']) {
                                    case 'scale': echo '⚖️'; break;
                                    case 'activity': echo '📈'; break;
                                    case 'heart': echo '❤️'; break;
                                    case 'leaf': echo '🍃'; break;
                                    case 'sparkles': echo '✨'; break;
                                    case 'sun': echo '☀️'; break;
                                    default: echo '🥗';
                                }
                            ?></span>
                            <span class="badge" style="background-color: var(--sandal-medium); color: var(--green-dark); border: 1px solid var(--sandal-border);">Program</span>
                        </div>

                        <h3 class="package-title" style="font-size: 1.65rem; margin-bottom: 0.5rem; font-weight: 600;"><?php echo $pkg['title']; ?></h3>
                        <p class="package-subtitle" style="font-size: 0.85rem; color: var(--text-muted); margin-bottom: 1.5rem; min-height: 45px; line-height: 1.4;"><?php echo $pkg['subtitle']; ?></p>
                        
                        <!-- Duration selector for this specific card -->
                        <div class="form-group" style="margin-bottom: 1.5rem;">
                            <label for="duration-select-<?php echo $key; ?>" style="font-size: 0.75rem; font-weight: 700; color: var(--green-dark); margin-bottom: 0.25rem;">Select Plan Duration</label>
                            <select id="duration-select-<?php echo $key; ?>" class="service-duration-select" onchange="updateServiceCardPrice('<?php echo $key; ?>')" style="padding: 0.5rem; background-color: var(--sandal-light); border: 1px solid var(--sandal-border); width: 100%; border-radius: var(--radius-sm);">
                                <option value="1">1 Month (Kickstart Plan)</option>
                                <option value="3" selected>3 Months (Most Popular - Recommended)</option>
                                <option value="6">6 Months (Transformation Plan)</option>
                            </select>
                        </div>

                        <!-- Dynamic Price Display -->
                        <div class="package-price-box" style="margin-bottom: 1.75rem;">
                            <span class="package-price-currency" style="font-size: 1.35rem; font-weight: 500;">₹</span>
                            <span class="package-price" id="price-display-<?php echo $key; ?>" style="font-size: 3rem; font-weight: 600; font-family: 'Cormorant Garamond', serif;"><?php echo number_format($pkg['prices']['3']); ?></span>
                            <span class="package-price-period" id="period-display-<?php echo $key; ?>" style="font-size: 0.85rem; color: var(--text-muted);"> / 3 Months</span>
                        </div>

                        <ul class="package-features" style="list-style: none; margin-bottom: 2rem; display: flex; flex-direction: column; gap: 0.75rem; flex-grow: 1; padding: 0;">
                            <?php foreach ($pkg['features'] as $feat): ?>
                                <li style="font-size: 0.85rem; color: var(--text-muted); display: flex; gap: 0.5rem; align-items: flex-start;">
                                    <i data-feather="check" style="color: var(--gold); width: 16px; height: 16px; flex-shrink: 0; margin-top: 0.1rem;"></i>
                                    <span><?php echo $feat; ?></span>
                                </li>
                            <?php endforeach; ?>
                        </ul>

                        <a href="checkout.php?package=<?php echo $key; ?>&duration=3" 
                           id="buy-btn-<?php echo $key; ?>" 
                           class="btn btn-primary" 
                           style="width: 100%; justify-content: center; text-align: center; margin-top: auto;">
                            Register & Buy Plan
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Custom JavaScript for services page pricing update -->
    <script>
        function updateServiceCardPrice(key) {
            const select = document.getElementById('duration-select-' + key);
            const priceDisplay = document.getElementById('price-display-' + key);
            const periodDisplay = document.getElementById('period-display-' + key);
            const buyBtn = document.getElementById('buy-btn-' + key);
            const card = document.getElementById('card-' + key);
            
            const selectedDuration = select.value;
            const price = card.getAttribute('data-price-' + selectedDuration);
            
            // Format number
            const formattedPrice = Number(price).toLocaleString('en-IN');
            priceDisplay.textContent = formattedPrice;
            
            // Update Period text
            let periodText = ' / Month';
            if (selectedDuration === '3') periodText = ' / 3 Months';
            if (selectedDuration === '6') periodText = ' / 6 Months';
            periodDisplay.textContent = periodText;
            
            // Update Checkout CTA Link
            buyBtn.setAttribute('href', 'checkout.php?package=' + key + '&duration=' + selectedDuration);
        }
    </script>

    <!-- Inclusions / What is in the package -->
    <section class="section-bg-alt">
        <div class="container" style="max-width: 900px;">
            <div class="section-header center">
                <span class="tag">Inclusions</span>
                <h2>What is included in every program?</h2>
                <p>We believe in setting you up for success. Regardless of the duration or package you choose, every client receives absolute professional attention.</p>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem;">
                <div style="background-color: var(--white); border: 1px solid var(--sandal-border); padding: 2rem; border-radius: var(--radius-md); display: flex; gap: 1rem;">
                    <div style="background-color: var(--gold-light); width: 44px; height: 44px; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: var(--gold); flex-shrink: 0;"><i data-feather="message-square"></i></div>
                    <div>
                        <h4 style="font-size: 1.2rem; margin-bottom: 0.5rem; color: var(--green-dark);">Daily Support</h4>
                        <p style="font-size: 0.85rem;">Direct chat access to Dietitian Shifana.I. No AI bots or intermediate assistants. Your questions get answered directly.</p>
                    </div>
                </div>

                <div style="background-color: var(--white); border: 1px solid var(--sandal-border); padding: 2rem; border-radius: var(--radius-md); display: flex; gap: 1rem;">
                    <div style="background-color: var(--gold-light); width: 44px; height: 44px; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: var(--gold); flex-shrink: 0;"><i data-feather="book"></i></div>
                    <div>
                        <h4 style="font-size: 1.2rem; margin-bottom: 0.5rem; color: var(--green-dark);">Custom Kitchen Manual</h4>
                        <p style="font-size: 0.85rem;">Recipes formulated around your dietary habits. We show you how to swap ingredients and adjust portions using standard cooking methods.</p>
                    </div>
                </div>

                <div style="background-color: var(--white); border: 1px solid var(--sandal-border); padding: 2rem; border-radius: var(--radius-md); display: flex; gap: 1rem;">
                    <div style="background-color: var(--gold-light); width: 44px; height: 44px; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: var(--gold); flex-shrink: 0;"><i data-feather="check-square"></i></div>
                    <div>
                        <h4 style="font-size: 1.2rem; margin-bottom: 0.5rem; color: var(--green-dark);">Weekly Audits</h4>
                        <p style="font-size: 0.85rem;">Reviewing weight markers, symptoms diary, sleep cycles, and food schedules every week. We adjust plans dynamically based on your progress.</p>
                    </div>
                </div>

                <div style="background-color: var(--white); border: 1px solid var(--sandal-border); padding: 2rem; border-radius: var(--radius-md); display: flex; gap: 1rem;">
                    <div style="background-color: var(--gold-light); width: 44px; height: 44px; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: var(--gold); flex-shrink: 0;"><i data-feather="heart"></i></div>
                    <div>
                        <h4 style="font-size: 1.2rem; margin-bottom: 0.5rem; color: var(--green-dark);">Lifestlye Integration</h4>
                        <p style="font-size: 0.85rem;">Step-by-step guidance on breathing exercises, managing circadian rhythms, optimizing hydration, and scheduling sun exposure.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php
include_once __DIR__ . '/includes/footer.php';
?>

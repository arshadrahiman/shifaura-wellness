<?php
/**
 * SHIFAURA - Resources Page
 */
require_once __DIR__ . '/db/config.php';

$page_title = 'Wellness Resources, Articles & Guides';
$page_description = 'Download sample diet plans, healthy recipes, and metabolic health guides. Access evidence-based articles by Dietitian Shifana.';
include_once __DIR__ . '/includes/header.php';
?>

    <!-- Page Title Header -->
    <header class="page-header">
        <div class="container">
            <span class="badge" style="margin-bottom: 0.75rem;">Wellness Library</span>
            <h1>Health Resources & Guides</h1>
            <p>Free, evidence-based guides, meal recipes, and tools to support your health journey.</p>
        </div>
    </header>

    <!-- Downloadable PDFs Section -->
    <section>
        <div class="container">
            <div class="section-header center">
                <span class="tag">Free Downloads</span>
                <h2>E-books & Cheat Sheets</h2>
                <p>Download our free worksheets and resource guides to start building healthier habits today.</p>
            </div>

            <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 2rem;">
                <!-- Guide 1 -->
                <div style="background-color: var(--white); border: 1px solid var(--sandal-border); border-radius: var(--radius-md); padding: 2.25rem 1.75rem; display: flex; flex-direction: column;">
                    <div style="background-color: var(--green-light); color: var(--green-dark); width: 48px; height: 48px; border-radius: var(--radius-sm); display: flex; align-items: center; justify-content: center; margin-bottom: 1.5rem;"><i data-feather="file-text"></i></div>
                    <span class="badge" style="align-self: flex-start; margin-bottom: 0.5rem; font-size: 0.65rem; background-color: var(--gold-light); color: var(--gold-dark);">PDF Guide</span>
                    <h3 style="font-size: 1.35rem; margin-bottom: 0.75rem; color: var(--green-dark);">Circadian Clock & Sleep Tracker</h3>
                    <p style="font-size: 0.85rem; color: var(--text-muted); margin-bottom: 1.5rem; flex-grow: 1;">A simple worksheet to log your sleep, wake-up times, and morning sun exposure. Reset your biological clock to balance cortisol and insulin levels.</p>
                    <a href="javascript:void(0);" onclick="alert('Download started: Circadian_Clock_Tracker.pdf (Mock File)');" class="btn btn-secondary" style="width: 100%; text-align: center; justify-content: center;"><i data-feather="download" style="width: 14px; height: 14px; margin-right: 0.5rem;"></i> Download PDF</a>
                </div>

                <!-- Guide 2 -->
                <div style="background-color: var(--white); border: 1px solid var(--sandal-border); border-radius: var(--radius-md); padding: 2.25rem 1.75rem; display: flex; flex-direction: column;">
                    <div style="background-color: var(--green-light); color: var(--green-dark); width: 48px; height: 48px; border-radius: var(--radius-sm); display: flex; align-items: center; justify-content: center; margin-bottom: 1.5rem;"><i data-feather="list"></i></div>
                    <span class="badge" style="align-self: flex-start; margin-bottom: 0.5rem; font-size: 0.65rem; background-color: var(--gold-light); color: var(--gold-dark);">Cheat Sheet</span>
                    <h3 style="font-size: 1.35rem; margin-bottom: 0.75rem; color: var(--green-dark);">Glycemic Index Food Swap List</h3>
                    <p style="font-size: 0.85rem; color: var(--text-muted); margin-bottom: 1.5rem; flex-grow: 1;">A quick reference sheet showing common high-GI ingredients and their healthier, low-GI alternatives to support blood sugar management.</p>
                    <a href="javascript:void(0);" onclick="alert('Download started: Glycemic_Index_Swaps.pdf (Mock File)');" class="btn btn-secondary" style="width: 100%; text-align: center; justify-content: center;"><i data-feather="download" style="width: 14px; height: 14px; margin-right: 0.5rem;"></i> Download PDF</a>
                </div>

                <!-- Guide 3 -->
                <div style="background-color: var(--white); border: 1px solid var(--sandal-border); border-radius: var(--radius-md); padding: 2.25rem 1.75rem; display: flex; flex-direction: column;">
                    <div style="background-color: var(--green-light); color: var(--green-dark); width: 48px; height: 48px; border-radius: var(--radius-sm); display: flex; align-items: center; justify-content: center; margin-bottom: 1.5rem;"><i data-feather="book-open"></i></div>
                    <span class="badge" style="align-self: flex-start; margin-bottom: 0.5rem; font-size: 0.65rem; background-color: var(--gold-light); color: var(--gold-dark);">Recipe Book</span>
                    <h3 style="font-size: 1.35rem; margin-bottom: 0.75rem; color: var(--green-dark);">5 Anti-Inflammatory Breakfasts</h3>
                    <p style="font-size: 0.85rem; color: var(--text-muted); margin-bottom: 1.5rem; flex-grow: 1;">A recipe collection featuring delicious, simple meals designed to support thyroid health, reduce bloating, and sustain morning energy levels.</p>
                    <a href="javascript:void(0);" onclick="alert('Download started: Anti_Inflammatory_Breakfasts.pdf (Mock File)');" class="btn btn-secondary" style="width: 100%; text-align: center; justify-content: center;"><i data-feather="download" style="width: 14px; height: 14px; margin-right: 0.5rem;"></i> Download PDF</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Articles Section -->
    <section class="section-bg-alt">
        <div class="container">
            <div class="section-header center">
                <span class="tag">Knowledge Hub</span>
                <h2>Recent Health Articles</h2>
                <p>Read about the science behind nutrition, hormones, and sustainable lifestyle modifications.</p>
            </div>

            <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 2.5rem;">
                <!-- Article 1 -->
                <article style="background: var(--white); border: 1px solid var(--sandal-border); border-radius: var(--radius-md); overflow: hidden; display: flex; flex-direction: column; box-shadow: var(--shadow-sm); transition: var(--transition);">
                    <img src="assets/images/article_pcos.jpg" alt="PMOS and Insulin Resistance article image" style="width: 100%; height: 220px; object-fit: cover;">
                    <div style="padding: 1.75rem; display: flex; flex-direction: column; flex-grow: 1;">
                        <span style="font-size: 0.7rem; text-transform: uppercase; letter-spacing: 0.05em; color: var(--gold); font-weight: 600; margin-bottom: 0.5rem; display: block;">Hormonal Health</span>
                        <h3 style="font-size: 1.35rem; color: var(--green-dark); margin-bottom: 0.75rem; line-height: 1.3;">Understanding PMOS and Insulin Resistance</h3>
                        <p style="font-size: 0.85rem; color: var(--text-muted); margin-bottom: 1.5rem; flex-grow: 1;">Explore how simple dietary tweaks and proper food sequencing can help manage insulin levels and support hormonal balance.</p>
                        <a href="javascript:void(0);" onclick="alert('This article will be available soon!');" style="color: var(--green-dark); font-weight: 600; font-size: 0.85rem; display: inline-flex; align-items: center; gap: 0.4rem; margin-top: auto;">Read Article <i data-feather="arrow-right" style="width: 14px; height: 14px;"></i></a>
                    </div>
                </article>

                <!-- Article 2 -->
                <article style="background: var(--white); border: 1px solid var(--sandal-border); border-radius: var(--radius-md); overflow: hidden; display: flex; flex-direction: column; box-shadow: var(--shadow-sm); transition: var(--transition);">
                    <img src="assets/images/article_diabetes.jpg" alt="Diabetes control article image" style="width: 100%; height: 220px; object-fit: cover;">
                    <div style="padding: 1.75rem; display: flex; flex-direction: column; flex-grow: 1;">
                        <span style="font-size: 0.7rem; text-transform: uppercase; letter-spacing: 0.05em; color: var(--gold); font-weight: 600; margin-bottom: 0.5rem; display: block;">Diabetes Care</span>
                        <h3 style="font-size: 1.35rem; color: var(--green-dark); margin-bottom: 0.75rem; line-height: 1.3;">The Power of Food Pairing in Blood Sugar Control</h3>
                        <p style="font-size: 0.85rem; color: var(--text-muted); margin-bottom: 1.5rem; flex-grow: 1;">Learn why combining complex carbohydrates with fiber, healthy fats, and proteins helps manage glucose responses.</p>
                        <a href="javascript:void(0);" onclick="alert('This article will be available soon!');" style="color: var(--green-dark); font-weight: 600; font-size: 0.85rem; display: inline-flex; align-items: center; gap: 0.4rem; margin-top: auto;">Read Article <i data-feather="arrow-right" style="width: 14px; height: 14px;"></i></a>
                    </div>
                </article>

                <!-- Article 3 -->
                <article style="background: var(--white); border: 1px solid var(--sandal-border); border-radius: var(--radius-md); overflow: hidden; display: flex; flex-direction: column; box-shadow: var(--shadow-sm); transition: var(--transition);">
                    <img src="assets/images/article_sleep.jpg" alt="Circadian rhythm article image" style="width: 100%; height: 220px; object-fit: cover;">
                    <div style="padding: 1.75rem; display: flex; flex-direction: column; flex-grow: 1;">
                        <span style="font-size: 0.7rem; text-transform: uppercase; letter-spacing: 0.05em; color: var(--gold); font-weight: 600; margin-bottom: 0.5rem; display: block;">Circadian Health</span>
                        <h3 style="font-size: 1.35rem; color: var(--green-dark); margin-bottom: 0.75rem; line-height: 1.3;">How Circadian Rhythms Govern Weight Management</h3>
                        <p style="font-size: 0.85rem; color: var(--text-muted); margin-bottom: 1.5rem; flex-grow: 1;">Why *when* you eat is just as important as *what* you eat. Aligning your meals with natural daylight cycles can support metabolic health.</p>
                        <a href="javascript:void(0);" onclick="alert('This article will be available soon!');" style="color: var(--green-dark); font-weight: 600; font-size: 0.85rem; display: inline-flex; align-items: center; gap: 0.4rem; margin-top: auto;">Read Article <i data-feather="arrow-right" style="width: 14px; height: 14px;"></i></a>
                    </div>
                </article>
            </div>
        </div>
    </section>

<?php
include_once __DIR__ . '/includes/footer.php';
?>

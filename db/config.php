<?php
/**
 * SHIFAURA - Configuration File
 */

// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Global Site Definitions
define('SITE_NAME', 'SHIFAURA');
define('SITE_TAGLINE', 'Personalized Nutrition. Proven Results.');
define('SITE_DOMAIN', 'www.dietitianshifana.com');
define('CURRENCY_SYMBOL', '₹');

// Database Configuration (Supports MariaDB/MySQL for LAMP & SQLite for local fallback)
define('DB_DRIVER', getenv('DB_DRIVER') ?: 'sqlite'); // Change to 'mysql' for MariaDB / Endor LAMP
define('DB_HOST', getenv('DB_HOST') ?: '127.0.0.1');
define('DB_PORT', getenv('DB_PORT') ?: '3306');
define('DB_NAME', getenv('DB_NAME') ?: 'shifaura');
define('DB_USER', getenv('DB_USER') ?: 'root');
define('DB_PASS', getenv('DB_PASS') ?: '');
define('DB_FILE_PATH', __DIR__ . '/shifaura.db');

// Packages Pricing Structure
$diet_packages = [
    'weight-management' => [
        'title' => 'Weight Management',
        'subtitle' => 'Sustainable weight loss and healthy weight gain.',
        'icon' => 'scale',
        'prices' => [
            '1' => 2999,
            '3' => 7499,
            '6' => 12999
        ],
        'features' => [
            'Personalized meal strategies & plans',
            'Weekly coaching calls with Shifana',
            'Daily WhatsApp support & query resolution',
            'Lifestyle, sleep, and activity tracking',
            'Customized workout & movement guidelines'
        ]
    ],
    'diabetes-management' => [
        'title' => 'Diabetes Management',
        'subtitle' => 'Blood sugar management and healthy lifestyle routing.',
        'icon' => 'activity',
        'prices' => [
            '1' => 3499,
            '3' => 8999,
            '6' => 14999
        ],
        'features' => [
            'Low glycemic index personalized diets',
            'Continuous glucose monitoring (CGM) support',
            'Bi-weekly clinical metric evaluations',
            'Cardio & strength exercise counseling',
            'Direct access to certified educator Shifana'
        ]
    ],
    'pcos-hormonal' => [
        'title' => 'PCOS & Hormonal Health',
        'subtitle' => 'Nutrition designed around your hormonal & metabolic needs.',
        'icon' => 'heart',
        'prices' => [
            '1' => 3499,
            '3' => 8999,
            '6' => 14999
        ],
        'features' => [
            'Insulin resistance reversal meal plans',
            'Hormonal imbalance tracking diary',
            'Stress & sleep restoration protocols',
            'Supplements and herbal remedies guidelines',
            'Fertility and cycles synchronization coaching'
        ]
    ],
    'thyroid-health' => [
        'title' => 'Thyroid Health',
        'subtitle' => 'Nutrition guidance to complement your thyroid health.',
        'icon' => 'leaf',
        'prices' => [
            '1' => 2999,
            '3' => 7499,
            '6' => 12999
        ],
        'features' => [
            'Metabolism-boosting nutrient planning',
            'Inflammatory trigger identification checklist',
            'Micronutrient (Selenium, Iodine, Zinc) audit',
            'Energy management coaching sessions',
            'Regular thyroid lab reports evaluation'
        ]
    ],
    'fertility-nutrition' => [
        'title' => 'Fertility Nutrition',
        'subtitle' => 'Nourishing your body and habits for the fertility journey.',
        'icon' => 'sparkles',
        'prices' => [
            '1' => 3999,
            '3' => 9999,
            '6' => 16999
        ],
        'features' => [
            'Preconception nutrition for both partners',
            'Egg & sperm health optimization diets',
            'Endometrial lining & cycle phase nutrition',
            'Detoxification guidelines & chemical-free living',
            'Direct emotional support and counseling'
        ]
    ],
    'holistic-wellness' => [
        'title' => 'Holistic Wellness',
        'subtitle' => 'Integrating nutrition, movement, sleep, hydration & wellbeing.',
        'icon' => 'sun',
        'prices' => [
            '1' => 2499,
            '3' => 5999,
            '6' => 9999
        ],
        'features' => [
            '8 Pillars of Shifauara wellness integration',
            'Mindful eating training guides',
            'Hydration and breathing logging checks',
            'Sunlight, circadian rhythm resetting guide',
            'Monthly progress review & sustainability plan'
        ]
    ]
];

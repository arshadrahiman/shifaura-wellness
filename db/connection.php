<?php
/**
 * SHIFAURA - Database Connection & Dual Driver Setup (MySQL/MariaDB & SQLite)
 */

require_once __DIR__ . '/config.php';

try {
    if (DB_DRIVER === 'mysql') {
        // Connect to MariaDB / MySQL for Endor LAMP
        $dsn = "mysql:host=" . DB_HOST . ";port=" . DB_PORT . ";dbname=" . DB_NAME . ";charset=utf8mb4";
        $pdo = new PDO($dsn, DB_USER, DB_PASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

        // Auto-create MySQL tables if missing
        $pdo->exec("CREATE TABLE IF NOT EXISTS bookings (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(255) NOT NULL,
            email VARCHAR(255) NOT NULL,
            phone VARCHAR(50) NOT NULL,
            preferred_date VARCHAR(50) NOT NULL,
            preferred_time VARCHAR(50) NOT NULL,
            health_goal VARCHAR(255) NOT NULL,
            message TEXT,
            status VARCHAR(50) DEFAULT 'Pending',
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");

        $pdo->exec("CREATE TABLE IF NOT EXISTS purchases (
            id INT AUTO_INCREMENT PRIMARY KEY,
            package_name VARCHAR(255) NOT NULL,
            package_duration VARCHAR(50) NOT NULL,
            price DECIMAL(10,2) NOT NULL,
            client_name VARCHAR(255) NOT NULL,
            client_email VARCHAR(255) NOT NULL,
            client_phone VARCHAR(50) NOT NULL,
            client_age INT NOT NULL,
            client_gender VARCHAR(50) NOT NULL,
            health_conditions TEXT,
            payment_status VARCHAR(50) DEFAULT 'Paid',
            transaction_id VARCHAR(100) NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");

        $pdo->exec("CREATE TABLE IF NOT EXISTS admins (
            id INT AUTO_INCREMENT PRIMARY KEY,
            username VARCHAR(100) UNIQUE NOT NULL,
            password VARCHAR(255) NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");

    } else {
        // Fallback: Connect to SQLite for local file-based dev
        $pdo = new PDO('sqlite:' . DB_FILE_PATH);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

        // Create Bookings Table
        $pdo->exec("CREATE TABLE IF NOT EXISTS bookings (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            name TEXT NOT NULL,
            email TEXT NOT NULL,
            phone TEXT NOT NULL,
            preferred_date TEXT NOT NULL,
            preferred_time TEXT NOT NULL,
            health_goal TEXT NOT NULL,
            message TEXT,
            status TEXT DEFAULT 'Pending',
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP
        )");

        // Create Purchases Table
        $pdo->exec("CREATE TABLE IF NOT EXISTS purchases (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            package_name TEXT NOT NULL,
            package_duration TEXT NOT NULL,
            price REAL NOT NULL,
            client_name TEXT NOT NULL,
            client_email TEXT NOT NULL,
            client_phone TEXT NOT NULL,
            client_age INTEGER NOT NULL,
            client_gender TEXT NOT NULL,
            health_conditions TEXT,
            payment_status TEXT DEFAULT 'Paid',
            transaction_id TEXT NOT NULL,
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP
        )");

        // Create Admins Table
        $pdo->exec("CREATE TABLE IF NOT EXISTS admins (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            username TEXT UNIQUE NOT NULL,
            password TEXT NOT NULL,
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP
        )");
    }

    // Seed Default Admin if none exists
    $stmt = $pdo->query("SELECT COUNT(*) FROM admins");
    $count = $stmt->fetchColumn();

    if ($count == 0) {
        $default_username = 'admin';
        $default_password = password_hash('Password123', PASSWORD_DEFAULT);
        $insert_admin = $pdo->prepare("INSERT INTO admins (username, password) VALUES (:username, :password)");
        $insert_admin->execute([
            ':username' => $default_username,
            ':password' => $default_password
        ]);
    }

} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

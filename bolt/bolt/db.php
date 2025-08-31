<?php
// SQLite DB for Bolt demo (no MySQL/server setup needed)
$dbFile = __DIR__ . '/foodlink.sqlite';

try {
    $conn = new PDO('sqlite:' . $dbFile);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Create tables if not exist
    $conn->exec("
        CREATE TABLE IF NOT EXISTS donations (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            donor_name TEXT,
            food_item TEXT,
            quantity TEXT,
            location TEXT,
            contact TEXT,
            status TEXT DEFAULT 'available',
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP
        );
    ");
    $conn->exec("
        CREATE TABLE IF NOT EXISTS payments (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            reference TEXT,
            email TEXT,
            amount REAL,
            status TEXT,
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP
        );
    ");
} catch (Exception $e) {
    die('DB error: ' . htmlspecialchars($e->getMessage()));
}

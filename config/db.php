<?php
require_once __DIR__ . '/load_config.php';
$config = loadConfig();

$host = $config['database']['host'];
$port = $config['database']['port'];
$dbname = $config['database']['dbname'];
$user = $config['database']['user'];
$password = $config['database']['password'];

try {
    $pdo = new PDO("pgsql:host=" . $host . ";port=" . $port . ";dbname=postgres", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT 1 FROM pg_database WHERE datname = :dbname";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':dbname' => $dbname]);

    if ($stmt->fetchColumn() === false) {
        $pdo->exec("CREATE DATABASE " . $dbname);
    }

    $pdo = new PDO("pgsql:host=" . $host . ";port=" . $port . ";dbname=" . $dbname, $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "CREATE TABLE IF NOT EXISTS users (
        id SERIAL PRIMARY KEY,
        username VARCHAR(50) NOT NULL UNIQUE,
        email VARCHAR(70) UNIQUE,
        password VARCHAR(255) NOT NULL,
        is_admin BOOLEAN DEFAULT FALSE,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";

    $pdo->exec($sql);
} catch (PDOException $e) {
    die("ERROR: " . $e->getMessage());
}

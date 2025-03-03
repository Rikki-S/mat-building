<?php
$host = 'localhost';
$db   = 'rajawali';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
    // echo "Koneksi berhasil!";
} catch (\PDOException $e) {
    echo "Koneksi gagal: " . $e->getMessage();
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}

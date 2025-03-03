<?php
require '../connection.php';  // Menghubungkan ke database

try {
    // Menyiapkan dan mengeksekusi query SQL untuk mengambil data supplier
    $stmt = $pdo->query("SELECT id_sales, nama FROM data_sales");
    $suppliers = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

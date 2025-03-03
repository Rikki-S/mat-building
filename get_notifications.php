<?php
require '../../connection.php'; // Sesuaikan dengan lokasi file koneksi database

// Query untuk mengambil data barang dengan stok kurang dari 4
$query = "SELECT id_barang, namaBarang, stock FROM barang WHERE stock < 4";
$stmt = $pdo->prepare($query);
$stmt->execute();
$notifications = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Kembalikan data dalam format JSON
header('Content-Type: application/json');
echo json_encode($notifications);
?>
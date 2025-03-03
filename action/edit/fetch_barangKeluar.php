<?php
require '../../connection.php'; // Sesuaikan dengan lokasi file connection.php

if (isset($_GET['id'])) {
    $id_barangKeluar = $_GET['id'];

    try {
        // Query untuk mengambil data barang keluar berdasarkan id_barangKeluar
        $stmt = $pdo->prepare("SELECT id_barangKeluar, id_barang, namaBarang, tanggalKeluar, jumlahKeluar FROM barang_keluar WHERE id_barangKeluar = ?");
        $stmt->execute([$id_barangKeluar]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        // Mengembalikan data dalam format JSON
        header('Content-Type: application/json');
        echo json_encode($data);
    } catch (PDOException $e) {
        echo json_encode(['error' => 'Error fetching data: ' . $e->getMessage()]);
    }
} else {
    // Jika tidak ada id_barangKeluar yang diberikan, kirimkan response error
    echo json_encode(['error' => 'ID Barang Keluar tidak ditemukan.']);
}
?>
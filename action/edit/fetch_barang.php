<?php
require '../../connection.php'; // Sesuaikan dengan lokasi file connection.php

$response = array();

// Pastikan ada parameter id yang dikirimkan melalui GET
if (isset($_GET['id'])) {
    $id_barang = $_GET['id'];

    try {
        // Query untuk mengambil data barang berdasarkan id_barang
        $stmt = $pdo->prepare("SELECT * FROM barang WHERE id_barang = ?");
        $stmt->execute([$id_barang]);
        $barang = $stmt->fetch(PDO::FETCH_ASSOC);

        // Jika data barang ditemukan
        if ($barang) {
            $response['barang'] = $barang;

            // Query untuk mengambil data supplier
            $stmt = $pdo->prepare("SELECT id_sales, nama FROM data_sales");
            $stmt->execute();
            $suppliers = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $response['suppliers'] = $suppliers;

            // Kirimkan response sebagai JSON
            header('Content-Type: application/json');
            echo json_encode($response);
        } else {
            echo json_encode(array("error" => "Data barang tidak ditemukan"));
        }
    } catch (PDOException $e) {
        echo json_encode(array("error" => $e->getMessage()));
    }
} else {
    echo json_encode(array("error" => "ID barang tidak diberikan"));
}
?>

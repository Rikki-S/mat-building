<?php
require '../../connection.php'; // Sesuaikan dengan lokasi file connection.php

// Pastikan ada parameter id yang dikirimkan melalui GET
if (isset($_GET['id'])) {
    $id_sales = $_GET['id'];

    try {
        // Query untuk mengambil data sales berdasarkan id_sales
        $stmt = $pdo->prepare("SELECT * FROM data_sales WHERE id_sales = ?");
        $stmt->execute([$id_sales]);
        $sales = $stmt->fetch(PDO::FETCH_ASSOC);

        // Jika data ditemukan, kirimkan sebagai JSON response
        if ($sales) {
            header('Content-Type: application/json');
            echo json_encode($sales);
        } else {
            echo "Data sales tidak ditemukan";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "ID sales tidak diberikan";
}
?>
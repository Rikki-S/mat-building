<?php
require '../connection.php'; // Adjust the path as per your file structure

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Memeriksa apakah semua input form diisi
    if (isset($_POST['namaBarang'], $_POST['tanggalKeluar'], $_POST['jumlahKeluar'])) {
        $id_barang = $_POST['namaBarang']; // Using 'namaBarang' as id_barang since it's passed as id_barang

        $tanggalKeluar = $_POST['tanggalKeluar'];
        $jumlahKeluar = $_POST['jumlahKeluar'];

        try {
            // Ambil id_barang, namaBarang dan stok dari database berdasarkan id_barang
            $stmt = $pdo->prepare("SELECT id_barang, namaBarang, stock FROM barang WHERE id_barang = ?");
            $stmt->execute([$id_barang]);
            $barangRow = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$barangRow) {
                echo "Barang not found.";
                exit;
            }

            $namaBarang = $barangRow['namaBarang'];
            $stock = $barangRow['stock'];

            if ($stock < $jumlahKeluar) {
                echo "Stok barang tidak mencukupi.";
                exit;
            }

            // Kurangi stok barang di database
            $newStock = $stock - $jumlahKeluar;
            $updateStmt = $pdo->prepare("UPDATE barang SET stock = ? WHERE id_barang = ?");
            $updateStmt->execute([$newStock, $id_barang]);

            // Simpan data barang keluar
            $insertStmt = $pdo->prepare("INSERT INTO barang_keluar (id_barang, namaBarang, tanggalKeluar, jumlahKeluar) VALUES (?, ?, ?, ?)");
            $insertStmt->execute([$id_barang, $namaBarang, $tanggalKeluar, $jumlahKeluar]);

            echo "<script>alert('Data berhasil disimpan.'); window.location='../dashboard/barang_keluar.php';</script>";
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    } else {
        echo "Form harus diisi lengkap.";
    }
}
?>

<?php
require '../../connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Memeriksa apakah semua input form diisi
    if (isset($_POST['id_barang'], $_POST['namaBarang'], $_POST['supplier'], $_POST['stock'], $_POST['hargaSales'], $_POST['hargaToko'], $_POST['hargaOnline'], $_POST['hargaKompetitor'], $_POST['tanggalMasuk'])) {
        $id_barang = $_POST['id_barang'];
        $namaBarang = $_POST['namaBarang'];
        $supplier = $_POST['supplier'];
        $stock = $_POST['stock'];
        $hargaSales = $_POST['hargaSales'];
        $hargaToko = $_POST['hargaToko'];
        $hargaOnline = $_POST['hargaOnline'];
        $hargaKompetitor = $_POST['hargaKompetitor'];
        $tanggalMasuk = $_POST['tanggalMasuk']; // Sesuaikan dengan nama input form

        // Update data barang di database
        try {
            $stmt = $pdo->prepare("UPDATE barang SET namaBarang = ?, supplier = ?, stock = ?, hargaSales = ?, hargaToko = ?, hargaOnline = ?, hargaKompetitor = ?, tanggalMasuk = ? WHERE id_barang = ?");
            $stmt->execute([$namaBarang, $supplier, $stock, $hargaSales, $hargaToko, $hargaOnline, $hargaKompetitor, $tanggalMasuk, $id_barang]);
            echo "<script>alert('Data berhasil diupdate.'); window.location='../../dashboard/master_barang.php';</script>";
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    } else {
        echo "All form fields must be filled out.";
    }
}
} elseif (isset($_GET['id'])) {
    // Tampilkan form edit dengan data barang yang sudah ada
    $id_barang = $_GET['id'];

    try {
        $stmt = $pdo->prepare("SELECT * FROM barang WHERE id_barang = ?");
        $stmt->execute([$id_barang]);
        $barang = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$barang) {
            echo "Barang tidak ditemukan.";
            exit();
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "ID Barang tidak diberikan.";
    exit();
}
?>

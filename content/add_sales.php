<?php
require '../connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Memeriksa apakah semua input form diisi
    if (isset($_POST['nama'], $_POST['perusahaan'], $_POST['alamat'])) {
        $nama = $_POST['nama'];
        $perusahaan = $_POST['perusahaan'];
        $alamat = $_POST['alamat'];

        // Menyimpan data ke database
        try {
            $stmt = $pdo->prepare("INSERT INTO data_sales (nama, perusahaan, alamat) VALUES (?, ?, ?)");
            $stmt->execute([$nama, $perusahaan, $alamat]);
            echo "Data berhasil disimpan.";
            echo "<script>alert('Data berhasil disimpan.'); window.location='../dashboard/data_sales.php';</script>";
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    } else {
        echo "All form fields must be filled out.";
    }
}
?>

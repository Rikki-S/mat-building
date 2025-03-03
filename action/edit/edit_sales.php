<?php
require '../../connection.php';  // Menghubungkan ke database

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_sales = $_POST['id_sales'];
    $nama = $_POST['nama'];
    $perusahaan = $_POST['perusahaan'];
    $alamat = $_POST['alamat'];

    try {
        // Menyiapkan dan mengeksekusi query SQL untuk mengedit data
        $stmt = $pdo->prepare("UPDATE data_sales SET nama = ?, perusahaan = ?, alamat = ? WHERE id_sales = ?");
        $stmt->execute([$nama, $perusahaan, $alamat, $id_sales]);

        if ($stmt->rowCount()) {
            header('Location: ../../dashboard/data_sales.php?status=success');  // Redirect dengan parameter sukses
            exit;
        } else {
            header('Location: ../../dashboard/data_sales.php?status=nochange');  // Redirect dengan parameter tidak ada perubahan
            exit;
        }
    } catch (PDOException $e) {
        header('Location: ../../dashboard/data_sales.php?status=error');  // Redirect dengan parameter error
        exit;
    }
}
?>

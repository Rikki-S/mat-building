<?php
include '../connection.php';

// Inisialisasi variabel untuk alert
$message = "";

// Ambil id_barang dari query string
if (isset($_GET['id'])) {
    $id_barang = $_GET['id'];

    try {
        // Query untuk menghapus data berdasarkan id_barang
        $stmt = $pdo->prepare("DELETE FROM barang WHERE id_barang = ?");
        $stmt->execute([$id_barang]);

        // Set pesan alert
        $message = "Data berhasil dihapus.";
    } catch (PDOException $e) {
        die("Gagal menghapus data: " . $e->getMessage());
    }
} else {
    // Jika tidak ada id_barang yang diberikan, kembali ke halaman sebelumnya
    header("Location: ../dashboard/master_barang.php");
    exit();
}

?>
    <script>
        alert("<?php echo $message; ?>");
        // Redirect kembali ke halaman utama setelah alert ditampilkan
        window.location.href = "../dashboard/master_barang.php";
    </script>
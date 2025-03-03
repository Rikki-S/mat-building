<?php
include '../connection.php';

// Inisialisasi variabel untuk alert
$message = "";

// Ambil id_sales dari query string
if (isset($_GET['id'])) {
    $id_sales = $_GET['id'];

    try {
        // Query untuk menghapus data berdasarkan id_sales
        $stmt = $pdo->prepare("DELETE FROM data_sales WHERE id_sales = ?");
        $stmt->execute([$id_sales]);

        // Set pesan alert
        $message = "Data berhasil dihapus.";
    } catch (PDOException $e) {
        die("Gagal menghapus data: " . $e->getMessage());
    }
} else {
    // Jika tidak ada id_sales yang diberikan, kembali ke halaman sebelumnya
    header("Location: ../dashboard/data_sales.php");
    exit();
}
?>
    <script>
        alert("<?php echo $message; ?>");
        // Redirect kembali ke halaman utama setelah alert ditampilkan
        window.location.href = "../dashboard/data_sales.php";
    </script>

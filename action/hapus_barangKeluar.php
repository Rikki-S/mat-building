<?php
include '../connection.php';

// Inisialisasi variabel untuk alert
$message = "";

// Ambil id_barangKeluar dari query string
if (isset($_GET['id'])) {
    $id_barangKeluar = $_GET['id'];

    try {
        // Ambil id_barang dan jumlahKeluar dari barang_keluar untuk mengembalikan stok
        $stmt = $pdo->prepare("SELECT id_barang, jumlahKeluar FROM barang_keluar WHERE id_barangKeluar = ?");
        $stmt->execute([$id_barangKeluar]);
        $barangKeluarRow = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$barangKeluarRow) {
            die("Data barang keluar tidak ditemukan.");
        }

        $id_barang = $barangKeluarRow['id_barang'];
        $jumlahKeluar = $barangKeluarRow['jumlahKeluar'];

        // Hapus data dari tabel barang_keluar
        $deleteStmt = $pdo->prepare("DELETE FROM barang_keluar WHERE id_barangKeluar = ?");
        $deleteStmt->execute([$id_barangKeluar]);

        // Update stok barang di tabel barang
        $updateStmt = $pdo->prepare("UPDATE barang SET stock = stock + ? WHERE id_barang = ?");
        $updateStmt->execute([$jumlahKeluar, $id_barang]);

        // Set pesan alert
        $message = "Data berhasil dihapus. Stok barang telah dikembalikan.";
    } catch (PDOException $e) {
        die("Gagal menghapus data: " . $e->getMessage());
    }
} else {
    // Jika tidak ada id_barangKeluar yang diberikan, kembali ke halaman sebelumnya
    header("Location: ../dashboard/barang_keluar.php");
    exit();
}

?>
<script>
    alert("<?php echo $message; ?>");
    // Redirect kembali ke halaman utama setelah alert ditampilkan
    window.location.href = "../dashboard/barang_keluar.php";
</script>

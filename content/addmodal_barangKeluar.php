<?php
require '../connection.php'; // Adjust the path as per your file structure

try {
    // Query to fetch data from barang table
    $stmt = $pdo->prepare("SELECT id_barang, namaBarang, stock FROM barang");
    $stmt->execute();
    $barang = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

<!-- Modal Add -->
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModalLabel">Tambah Data Barang Keluar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="../content/add_barangKeluar.php">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="namaBarang">Nama Barang</label>
                                <select class="form-control" id="namaBarang" name="namaBarang" required>
                                    <option value="">-- Pilih Barang --</option>
                                    <?php foreach ($barang as $item): ?>
                                        <option value="<?php echo $item['id_barang']; ?>">
                                            <?php echo htmlspecialchars($item['namaBarang']); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="stock">Stok saat ini</label>
                                <input type="number" class="form-control" id="stock" name="stock" readonly>
                            </div>
                            <div class="form-group">
                                <label for="tanggalKeluar">Tanggal Keluar</label>
                                <input type="date" class="form-control" id="tanggalKeluar" name="tanggalKeluar" required>
                            </div>
                            <div class="form-group">
                                <label for="jumlahKeluar">Jumlah Keluar</label>
                                <input type="number" class="form-control" id="jumlahKeluar" name="jumlahKeluar" required>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var namaBarangSelect = document.getElementById('namaBarang');
    var stockInput = document.getElementById('stock');
    var barangData = <?php echo json_encode($barang); ?>; // Ambil data barang dari PHP

    // Event listener saat memilih barang
    namaBarangSelect.addEventListener('change', function() {
        var selectedId = this.value;

        // Cari data barang yang sesuai dari daftar barang yang sudah diambil dari PHP
        var selectedBarang = barangData.find(barang => barang.id_barang == selectedId);

        // Jika barang ditemukan, update nilai stok
        if (selectedBarang) {
            stockInput.value = selectedBarang.stock;
        } else {
            stockInput.value = ''; // Jika tidak ditemukan, kosongkan nilai stok
        }
    });
});
</script>

<!-- Modal Edit -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Data Barang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editForm" action="../action/edit/edit_barang.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" id="editId" name="id_barang">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="editNamaBarang">Nama Barang</label>
                                <input type="text" class="form-control" id="editNamaBarang" name="namaBarang" required>
                            </div>
                            <div class="form-group">
                                <label for="editSupplier">Supplier</label>
                                <select class="form-control" id="editSupplier" name="supplier" required>
                                    <option value="">Pilih Supplier</option>
                                    <?php foreach ($suppliers as $supplier): ?>
                                        <option value="<?= htmlspecialchars($supplier['nama']) ?>"><?= htmlspecialchars($supplier['nama']) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="editStock">Stock</label>
                                <input type="number" class="form-control" id="editStock" name="stock" required>
                            </div>
                            <div class="form-group">
                                <label for="editHargaSales">Harga Sales</label>
                                <input type="number" class="form-control" id="editHargaSales" name="hargaSales" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="editHargaToko">Harga Toko</label>
                                <input type="number" class="form-control" id="editHargaToko" name="hargaToko" required>
                            </div>
                            <div class="form-group">
                                <label for="editHargaOnline">Harga Online</label>
                                <input type="number" class="form-control" id="editHargaOnline" name="hargaOnline" required>
                            </div>
                            <div class="form-group">
                                <label for="editHargaKompetitor">Harga Kompetitor</label>
                                <input type="number" class="form-control" id="editHargaKompetitor" name="hargaKompetitor" required>
                            </div>
                            <div class="form-group">
                        <label for="editTanggalKeluar">Tanggal Masuk</label>
                        <input type="date" class="form-control" id="editTanggalMasuk" name="tanggalMasuk" required>
                    </div>
                            <div class="form-group">
                                <label for="editGambar">Gambar</label>
                                <input type="file" class="form-control-file" id="editGambar" name="gambar">
                                <label id="editGambarLabel"></label>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var editButtons = document.querySelectorAll('.edit-btn');
    editButtons.forEach(function(button) {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            var id = this.getAttribute('data-id');
            
            // Fetch data barang dari database berdasarkan id_barang
            fetch('../action/edit/fetch_barang.php?id=' + id)
                .then(response => response.json())
                .then(data => {
                    if (data.error) {
                        console.error(data.error);
                        return;
                    }

                    var barang = data.barang;
                    var suppliers = data.suppliers;

                    // Mengisi nilai-nilai input di form modal
                    document.getElementById('editId').value = barang.id_barang;
                    document.getElementById('editNamaBarang').value = barang.namaBarang;
                    document.getElementById('editStock').value = barang.stock;
                    document.getElementById('editHargaSales').value = barang.hargaSales;
                    document.getElementById('editHargaToko').value = barang.hargaToko;
                    document.getElementById('editHargaOnline').value = barang.hargaOnline;
                    document.getElementById('editHargaKompetitor').value = barang.hargaKompetitor;
                    document.getElementById('editTanggalMasuk').value = data.tanggalMasuk;

                    // Mengisi dropdown supplier
                    var supplierSelect = document.getElementById('editSupplier');
                    supplierSelect.innerHTML = '<option value="">Pilih Supplier</option>';
                    suppliers.forEach(function(supplier) {
                        var option = document.createElement('option');
                        option.value = supplier.nama;
                        option.text = supplier.nama;
                        if (supplier.nama === barang.supplier) {
                            option.selected = true;
                        }
                        supplierSelect.appendChild(option);
                    });

                    // Menampilkan nama gambar
                    if (barang.gambar) {
                        document.getElementById('editGambarLabel').innerText = "Gambar: " + barang.gambar;
                    } else {
                        document.getElementById('editGambarLabel').innerText = "Tidak ada gambar terpilih";
                    }

                    // Clear input file
                    document.getElementById('editGambar').value = null;
                    
                    // Buka modal edit
                    $('#editModal').modal('show');
                })
                .catch(error => console.error('Error:', error));
        });
    });

    // Event listener untuk mengubah teks label setelah pemilihan gambar
    document.getElementById('editGambar').addEventListener('change', function() {
        var fileName = this.files[0].name;
        document.getElementById('editGambarLabel').innerText = "Gambar: " + fileName;
    });
});

</script>

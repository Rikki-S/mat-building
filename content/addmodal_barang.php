<!-- Modal Add -->
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModalLabel">Tambah Data Barang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="../content/add_barang.php" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="namaBarang">Nama Barang</label>
                                <input type="text" class="form-control" id="namaBarang" name="namaBarang" required>
                            </div>
                            <div class="form-group">
                                <label for="supplier">Supplier</label>
                                <select class="form-control" id="supplier" name="supplier" required>
                                    <?php
                                    require 'get_supplier.php';
                                    foreach ($suppliers as $supplier) {
                                        echo "<option value='" . $supplier['id_sales'] . "'>" . $supplier['nama'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="stock">Jumlah Masuk</label>
                                <input type="number" class="form-control" id="stock" name="stock" required>
                            </div>
                            <div class="form-group">
                                <label for="hargaSales">Harga Sales</label>
                                <input type="number" class="form-control" id="hargaSales" name="hargaSales" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="hargaToko">Harga Toko</label>
                                <input type="number" class="form-control" id="hargaToko" name="hargaToko" required>
                            </div>
                            <div class="form-group">
                                <label for="hargaOnline">Harga Online</label>
                                <input type="number" class="form-control" id="hargaOnline" name="hargaOnline" required>
                            </div>
                            <div class="form-group">
                                <label for="hargaKompetitor">Harga Kompetitor</label>
                                <input type="number" class="form-control" id="hargaKompetitor" name="hargaKompetitor" required>
                            </div>
                            <div class="form-group">
                                <label for="tanggalKeluar">Tanggal Masuk</label>
                                <input type="date" class="form-control" id="tanggalMasuk" name="tanggalMasuk" required>
                            </div>
                            <div class="form-group">
                                <label for="gambar">Gambar</label>
                                <input type="file" class="form-control-file" id="gambar" name="gambar">
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

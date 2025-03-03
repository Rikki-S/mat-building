<!-- Modal Edit Barang Keluar -->
<div class="modal fade" id="editModalBarangKeluar" tabindex="-1" aria-labelledby="editModalBarangKeluarLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalBarangKeluarLabel">Edit Data Barang Keluar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editFormBarangKeluar" action="../action/edit/edit_barangKeluar.php" method="POST">
                    <input type="hidden" id="editIdBarangKeluar" name="id_barangKeluar">
                    <div class="form-group">
                        <label for="editNamaBarang">Nama Barang</label>
                        <input type="text" class="form-control" id="editNamaBarang" name="namaBarang" readonly>
                    </div>
                    <div class="form-group">
                        <label for="editTanggalKeluar">Tanggal Keluar</label>
                        <input type="date" class="form-control" id="editTanggalKeluar" name="tanggalKeluar" required>
                    </div>
                    <div class="form-group">
                        <label for="editJumlahKeluar">Jumlah Keluar</label>
                        <input type="number" class="form-control" id="editJumlahKeluar" name="jumlahKeluar" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var editButtons = document.querySelectorAll('.edit-barang-keluar-btn');
    editButtons.forEach(function(button) {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            var idBarangKeluar = this.getAttribute('data-id');
            
            // Fetch data barang keluar dari database berdasarkan id_barangKeluar
            fetch('../action/edit/fetch_barangKeluar.php?id=' + idBarangKeluar)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('Data fetched:', data); // Log untuk melihat data yang diterima
                    // Mengisi nilai-nilai input di form modal
                    document.getElementById('editIdBarangKeluar').value = data.id_barangKeluar;
                    document.getElementById('editNamaBarang').value = data.namaBarang;
                    document.getElementById('editTanggalKeluar').value = data.tanggalKeluar;
                    document.getElementById('editJumlahKeluar').value = data.jumlahKeluar;
                })
                .catch(error => {
                    console.error('Error fetching data:', error); // Log untuk melihat error fetch data
                });
            
            // Buka modal edit barang keluar
            $('#editModalBarangKeluar').modal('show');
        });
    });
});
</script>



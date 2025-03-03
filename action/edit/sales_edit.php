<!-- Modal Edit -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Data Supplier</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editForm" action="../action/edit/edit_sales.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" id="editId" name="id_sales">
                    <div class="form-group">
                        <label for="editNama">Nama</label>
                        <input type="text" class="form-control" id="editNama" name="nama" required>
                    </div>
                    <div class="form-group">
                        <label for="editPerusahaan">Perusahaan</label>
                        <input type="text" class="form-control" id="editPerusahaan" name="perusahaan" required>
                    </div>
                    <div class="form-group">
                        <label for="editAlamat">Alamat</label>
                        <input type="text" class="form-control" id="editAlamat" name="alamat" required>
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
            
            // Fetch data sales dari database berdasarkan id_sales
            fetch('../action/edit/fetch_sales.php?id=' + id)
                .then(response => response.json())
                .then(data => {
                    // Mengisi nilai-nilai input di form modal
                    document.getElementById('editId').value = data.id_sales;
                    document.getElementById('editNama').value = data.nama;
                    document.getElementById('editPerusahaan').value = data.perusahaan;
                    document.getElementById('editAlamat').value = data.alamat;
                })
                .catch(error => console.error('Error:', error));
            
            // Buka modal edit
            $('#editModal').modal('show');
        });
    });
});
</script>

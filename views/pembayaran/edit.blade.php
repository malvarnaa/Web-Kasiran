<div class="modal fade" id="modalEditPembayaran" tabindex="-1" aria-labelledby="modalEditPembayaranLabel" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalEditPembayaranLabel">Tambah Jenis Pembayaran</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
            <form action="{{ isset($pembayaran[0]) ? route('pembayaran.update', $pembayaran[0]->id) : '#' }}" method="POST" id="editPembayaranForm">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nama_pembayaran" class="form-label">Nama Pembayaran</label>
                        <input type="text" name="nama_pembayaran" id="nama_pembayaran" class="form-control" value="{{ isset($pembayaran[0]) ? $pembayaran[0]->nama_pembayaran : '' }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="jenis_pembayaran" class="form-label">Jenis Pembayaran</label>
                        <input type="text" name="jenis_pembayaran" id="jenis_pembayaran" class="form-control" value="{{ isset($pembayaran[0]) ? $pembayaran[0]->jenis_pembayaran : '' }}" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
    document.addEventListener('DOMContentLoaded', function () {
        const editModal = new bootstrap.Modal(document.getElementById('editPetugas'));
        document.querySelectorAll('.btn-edit').forEach(button => {
            button.addEventListener('click', function () {
                const petugasId = this.dataset.id;

                fetch(`/petugas/${petugasId}/edit`)
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById('editPetugasForm').action = `/petugas/${petugasId}`;
                        document.getElementById('edit_nama').value = data.nama;
                        document.getElementById('edit_email').value = data.email;
                        document.getElementById('edit.jenis_kelamin').value = data.jenis_kelamin;
                        document.getElementById('edit_no_telp').value = data.no_telp;
                        document.getElementById('edit_alamat').value = data.alamat;
                        // Set other form fields as necessary
                        editModal.show();
                    })
                    .catch(error => console.error('Error fetching data:', error));
            });
        });
    });
</script>

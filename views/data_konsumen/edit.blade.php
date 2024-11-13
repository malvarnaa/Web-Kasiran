<div class="modal fade" id="editKonsumen" tabindex="-1" aria-labelledby="staticBackdropLabel" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Data Konsumen</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ isset($konsumen[0]) ? route('konsumen.update', $konsumen[0]->id) : '#' }}" method="POST" id="editKonsumenForm">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" name="nama" id="nama" class="form-control" value="{{ isset($konsumen[0]) ? $konsumen[0]->nama : '' }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" id="email" class="form-control" value="{{ isset($konsumen[0]) ?  $konsumen[0]->email : ''  }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                        <input type="text" name="jenis_kelamin" id="jenis_kelamin" class="form-control" value="{{ isset($konsumen[0]) ? $konsumen[0]->jenis_kelamin : ''  }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="no_telp" class="form-label">No Telepon</label>
                        <input type="text" name="no_telp" id="no_telp" class="form-control" value="{{ isset($konsumen[0]) ?  $konsumen[0]->no_telp : ''  }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <input type="text" name="alamat" id="alamat" class="form-control" value="{{ isset($konsumen[0]) ?  $konsumen[0]->alamat : ''  }}" required>
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
        const editModal = new bootstrap.Modal(document.getElementById('editKonsumen'));
        document.querySelectorAll('.btn-edit').forEach(button => {
            button.addEventListener('click', function () {
                const konsumenId = this.dataset.id;

                fetch(`/konsumen/${konsumenId}/edit`)
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById('editKonsumenForm').action = `/konsumen/${konsumenId}`;
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

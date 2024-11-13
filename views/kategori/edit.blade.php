<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css">
<!-- Modal Structure -->
<div class="modal fade" id="editKategori" tabindex="-1" aria-labelledby="staticBackdropLabel" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Data Kategori</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{ isset($kategori[0]) ? route('kategori.update', $kategori[0]->id) : '#' }}" method="POST" id="editKategoriForm">
            @csrf
            @method('PUT')

            <div class="modal-body">
                {{-- <div class="mb-3">
                    <label for="kode" class="form-label">Kode</label>
                    <input type="text" name="kode" id="kode" class="form-control" value="{{ old('kode', $data->kode) }}">
                </div> --}}
                <div class="mb-3">
                    <label for="jenis_brg" class="form-label">Nama Barang</label>
                    <input type="text" name="jenis_brg" id="jenis_brg" class="form-control" value="{{ isset($data[0]) ? $kategori[0]->jenis_brg : '' }}"  required>
                </div>
                <div class="mb-3">
                    <label for="harga" class="form-label">Harga</label>
                    <input type="text" name="harga" id="harga" class="form-control" value="{{ isset($data[0]) ? $kategori[0]->harga : '' }}"  required>
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


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

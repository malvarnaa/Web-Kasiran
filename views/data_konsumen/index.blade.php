<x-layout>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css">

    <h2>{{ $header }}</h2>

    <div class="card">
        <div class="d-flex justify-content-end mb-3">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambahKonsumen">
                Tambah Data
            </button>
        </div>
        <div class="card-body">
            <table class="table table-hover" style="font-size: 13px";>
                <thead >
                    <tr style="background-color: #5a57c3;">
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Jenis Kelamin</th>
                        <th>No Telepon</th>
                        <th>Alamat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($konsumens->isEmpty())
                    <tr>
                        <td colspan="7"style="text-align: center;">Tidak ada data yang ditemukan</td>
                    </tr>
                    @else
                        @foreach ($konsumens as $no => $konsumen)
                            <tr>
                                <td>{{ $no+1 }}</td>
                                <td>{{ $konsumen->nama }}</td>
                                <td>{{ $konsumen->email }}</td>
                                <td>{{ $konsumen->jenis_kelamin }}</td>
                                <td>{{ $konsumen->no_telp }}</td>
                                <td>{{ $konsumen->alamat }}</td>
                                <td>
                                    <div class="action-buttons text-center align-middle gap-2">
                                        <a href="{{ route('konsumen.edit', $konsumen->id) }}" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#editKonsumen" data-id="{{ $konsumen->id }}">
                                            <i class="bi bi-pen"></i> 
                                        </a>                                       
                                    </div>
                                    <form action="{{ route('konsumen.destroy', $konsumen->id) }}" class="d-inline col-mb-2 deleteForm" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>

    @include('data_konsumen.create')
    @include('data_konsumen.edit')

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Fetch the modal element
            const editModal = document.getElementById('editKonsumen');
            
            // When the modal is triggered
            editModal.addEventListener('show.bs.modal', function (event) {
                // Button that triggered the modal
                const button = event.relatedTarget;
                const konsumenId = button.getAttribute('data-id');
    
                // Fetch data dynamically here if needed (e.g., via AJAX)
                // Example AJAX request to fetch data for the selected petugas
                fetch(`/konsumen/${konsumenId}/edit`)
                    .then(response => response.json())
                    .then(data => {
                        // Fill modal inputs with fetched data
                        editModal.querySelector('#nama').value = data.nama;
                        editModal.querySelector('#email').value = data.email;
                        editModal.querySelector('#jenis_kelamin').value = data.jenis_kelamin;
                        editModal.querySelector('#no_telp').value = data.no_telp;
                        editModal.querySelector('#alamat').value = data.alamat;
                    })
                    .catch(error => console.error('Error fetching data:', error));
            });
        });
    </script>
    

    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> --}}
</x-layout>
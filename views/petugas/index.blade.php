<x-layout>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css">

    <h2>{{ $header }}</h2>

    <div class="card">
        <div class="d-flex justify-content-end mb-3">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambahPetugas">
                Tambah Data
            </button>
        </div>
        <div class="card-body">
            <table class="table table-hover" style="font-size: 13px";>
                <thead >
                    <tr style="background-color: #5a57c3;">
                        <th>No</th>
                        <th>NIK</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Jenis Kelamin</th>
                        <th>No Telepon</th>
                        <th>Alamat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($petugas->isEmpty())
                    <tr>
                        <td colspan="7"style="text-align: center;">Tidak ada data yang ditemukan</td>
                    </tr>
                    @else
                        @foreach ($petugas as $no => $data)
                            <tr>
                                <td>{{ $no+1 }}</td>
                                <td>{{ $data->nik }}</td>
                                <td>{{ $data->nama }}</td>
                                <td>{{ $data->email }}</td>
                                <td>{{ $data->jenis_kelamin }}</td>
                                <td>{{ $data->no_telp }}</td>
                                <td>{{ $data->alamat }}</td>
                                <td>
                                    <div class="action-buttons text-center align-middle gap-2">
                                        <a href="{{ route('petugas.edit', $data->id) }}" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#editPetugas" data-id="{{ $data->id }}">
                                            <i class="bi bi-pen"></i> 
                                        </a>                                        
                                        <form action="{{ route('petugas.destroy', $data->id) }}" class="d-inline col-mb-2 deleteForm" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>

    @include('petugas.create')
    @include('petugas.edit')

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Fetch the modal element
            const editModal = document.getElementById('editPetugas');
            
            // When the modal is triggered
            editModal.addEventListener('show.bs.modal', function (event) {
                // Button that triggered the modal
                const button = event.relatedTarget;
                const petugasId = button.getAttribute('data-id');
    
                // Fetch data dynamically here if needed (e.g., via AJAX)
                // Example AJAX request to fetch data for the selected petugas
                fetch(`/petugas/${petugasId}/edit`)
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
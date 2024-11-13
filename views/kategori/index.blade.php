<x-layout>

    <div class="container mt-4">
       <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-end mb-3">
                    {{-- ambil button dari create --}}
                    @include('kategori.create')
                </div>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Barang</th>
                            <th>Nama Barang</th>
                            <th>Harga Barang</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($kategori->isEmpty())
                        <tr>
                            <td colspan="5" style="text-align: center;">Tidak ada data yang ditemukan.</td>
                        </tr>
                        @else
                            @foreach ($kategori as $no => $data)
                            <tr>
                                <td>{{ $no + 1 }}</td>
                                <td>{{ $data->kode }}</td>
                                <td>{{ $data->jenis_brg }}</td>
                                <td>{{ 'Rp ' . number_format($data->harga, 0, ',', '.') }}</td> <!-- Format harga -->
                                <td>
                                    <div class="action-buttons d-flex justify-content-center align-items-center gap-2">
                                        <a href="{{ route('kategori.edit', $data->id) }}" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#editKategori" data-id="{{ $data->id }}">
                                            <i class="bi bi-pen"></i> 
                                        </a>
                                        <form action="{{ route('kategori.destroy', $data->id) }}" class="d-inline deleteForm" method="POST">
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
    </div>

    @include('kategori.edit')

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const editModal = document.getElementById('editKategori');
            
            // When the edit modal is triggered
            editModal.addEventListener('show.bs.modal', function (event) {
                const button = event.relatedTarget;
                const kategoriId = button.getAttribute('data-id');

                fetch(`/kategori/${kategoriId}/edit`)
                    .then(response => response.json())
                    .then(data => {
                        editModal.querySelector('#kode').value = data.kode;
                        editModal.querySelector('#jenis_brg').value = data.jenis_brg;
                    })
                    .catch(error => console.error('Error fetching data:', error));
            });
        });
    </script>
</x-layout>

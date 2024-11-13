<x-layout>


    {{-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambahPembayaran">Tambah Data</button> --}}
    <div class="card">
        <div class="d-flex justify-content-end mb-3">
            <div class="d-flex justify-content-end mb-3">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambahPembayaran">
                    Tambah Data
                </button>
            </div>
            {{-- <a href="{{ route('pembayaran.create') }}" class="btn btn-primary" type="button">Tambah</a> --}}
        </div>
        <div class="card-body">
            <table class="table table-hover" style="font-size: 13px";>
                <thead >
                    <tr style="background-color: #5a57c3;">
                        <th>No</th>
                        <th>Nama Pembayaran</th>
                        <th>Jenis Pembayaran</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($pembayaran->isEmpty())
                    <tr>
                        <td colspan="4"style="text-align: center;">Tidak ada data yang ditemukan</td>
                    </tr>
                    @else
                        @foreach ($pembayaran as $no => $data)
                            <tr>
                                <td>{{ $no+1 }}</td>
                                <td>{{ $data->nama_pembayaran }}</td>
                                <td>{{ $data->jenis_pembayaran   }}</td>
                                <td>
                                    <div class="action-buttons text-center align-middle gap-2">
                                        <a href="{{ route('pembayaran.edit', $data->id) }}" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#modalEditPembayaran" data-id="{{ $data->id }}">
                                            <i class="bi bi-pen"></i> 
                                        </a>                                        
                                        <form action="{{ route('pembayaran.destroy', $data->id) }}" class="d-inline col-mb-2 deleteForm" method="POST">
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

    @include('pembayaran.create')
    @include('pembayaran.edit')

</x-layout>
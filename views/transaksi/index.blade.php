{{-- <x-layout>
    <div class="container">
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

       @if($errors->any())
       <div class="alert alert-danger alert-dismissible fade show" role="alert">
           <strong>Terjadi kesalahan:</strong>
           <ul>
               @foreach ($errors->all() as $error)
                   <li>{{ $error }}</li>
               @endforeach
           </ul>
           <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
       </div>
       @endif

        <h2>Daftar Transaksi</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Nama Konsumen</th>
                    <th>Total Harga</th>
                    <th>Jenis Pembayaran</th>
                    <th>Tanggal Pembayaran</th>
                </tr>
            </thead>
            <tbody>
                @foreach($transaksis as $transaksi)
                <tr>
                    <td>{{ $transaksi->nama_konsumen }}</td>
                    <td>Rp{{ number_format($transaksi->total_harga, 0, ',', '.') }}</td>
                    <td>{{ $transaksi->pembayaran->jenis_pembayaran }}</td>
                    <td>{{ \Carbon\Carbon::parse($transaksi->tanggal_bayar)->format('d-m-Y') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>        
    </div>
</x-layout> --}}

<x-layout>
    <div class="container mt-5">
        <h1 class="text-center">Daftar Transaksi</h1>
    
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
    
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Transaksi</th>
                    <th>Nama Konsumen</th>
                    <th>Total Harga</th>
                    <th>Jenis Pembayaran</th>
                    <th>Tanggal Transaksi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($transaksis as $transaksi)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $transaksi->kode_transaksi }}</td>
                        <td>{{ $transaksi->nama_konsumen }}</td>
                        <td>{{ $transaksi->total_harga }}</td>
                        <td>{{ $transaksi->pembayaran->nama_pembayaran }}</td>
                        <td>{{ $transaksi->created_at->format('d-m-Y H:i:s') }}</td>
                        <td>
                            <div class="action-buttons text-center align-middle gap-2">                                      
                                <form action="{{ route('transaksi.destroy', $transaksi->id) }}" class="d-inline col-mb-2 deleteForm" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                                <a href="#" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#detailTransaksi" data-id="#">
                                    <i class="bi bi-three-dots"></i>
                                </a> 
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="modal fade" id="detailTransaksi" tabindex="-1" aria-labelledby="detailTransaksiLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="exampleModalLabel">Detail Transaksi</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Kode Transaksi</th>
                                <th>Nama Konsumen</th>
                                <th>Jenis Barang</th>
                                <th>Jumlah</th>
                                <th>Total Harga</th>
                                <th>Uang Pembeli</th>
                                <th>Kembalian</th>
                                <th>Jenis Pembayaran</th>
                                <th>Tanggal Transaksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($transaksis as $transaksi)
                                <tr>
                                    <td>{{ $transaksi->kode_transaksi }}</td>
                                    <td>{{ $transaksi->nama_konsumen }}</td>
                                    <td>{{ $transaksi->kategori->jenis_brg }}</td>
                                    <td>{{ $transaksi->jumlah }}</td>
                                    <td>{{ $transaksi->total_harga }}</td>
                                    <td>{{ $transaksi->uang_pembeli }}</td>
                                    <td>{{ $transaksi->kembalian }}</td>
                                    <td>{{ $transaksi->pembayaran->nama_pembayaran }}</td>
                                    <td>{{ $transaksi->created_at->format('d-m-Y H:i:s') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
          </div>
    </div>
</x-layout>

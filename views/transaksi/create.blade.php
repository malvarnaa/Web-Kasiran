<!-- resources/views/transaksi/create.blade.php -->
<x-layout>
    <div class="container mt-5">
        <h1 class="text-center">Transaksi Pembayaran</h1>

        <form action="{{ route('transaksi.store') }}" method="POST">
            @csrf
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="card mb-4">
                <div class="card-header">Input Data Konsumen</div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="nama_konsumen" class="form-label">Nama Konsumen:</label>
                        <input type="text" class="form-control" name="nama_konsumen" required>
                    </div>

                    <div class="mb-3">
                        <label for="kategori_id" class="form-label">Pilih Barang:</label>
                        <select class="form-select" name="kategori_id" id="kategoriSelect" required>
                            <option value="" disabled selected>Pilih Barang</option>
                            @foreach($kategoris as $kategori)
                                <option value="{{ $kategori->id }}" data-harga="{{ $kategori->harga }}">{{ $kategori->jenis_brg }} - {{ $kategori->kode }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="jumlah" class="form-label">Jumlah:</label>
                        <input type="number" class="form-control" name="jumlah" id="jumlahInput" required>
                    </div>

                    <button type="button" class="btn btn-primary" onclick="tambahBarang()">Tambah Barang</button>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header">Rekapan Barang</div>
                <div class="card-body">
                    <table class="table table-bordered" id="rekapan">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Jenis Barang</th>
                                <th>Harga</th>
                                <th>Jumlah</th>
                                <th>Total Harga</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(session('rekapan'))
                                <tr>
                                    <td>1</td>
                                    <td>{{ session('rekapan.jenis_brg') }}</td>
                                    <td>{{ session('rekapan.harga') }}</td>
                                    <td>{{ session('rekapan.jumlah') }}</td>
                                    <td>{{ session('rekapan.total_harga') }}</td>
                                    <td><button type="button" class="btn btn-danger" onclick="hapusBarang(this)">Hapus</button></td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="mb-3">
                <label for="total_harga" class="form-label">Total Harga:</label>
                <input type="number" class="form-control" name="total_harga" id="total_harga" value="{{ session('rekapan.total_harga', 0) }}" readonly>
            </div>

            <div class="mb-3">
                <label for="pembayaran_id" class="form-label">Jenis Pembayaran:</label>
                <select class="form-select" name="pembayaran_id" id="pembayaranSelect" required>
                    @foreach($pembayarans as $pembayaran)
                        <option value="{{ $pembayaran->id }}">{{ $pembayaran->nama_pembayaran }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="uang_pembeli" class="form-label">Uang Pembeli:</label>
                <input type="number" class="form-control" name="uang_pembeli" id="uang_pembeli" required>
            </div>

            <div class="mb-3">
                <label for="kembalian" class="form-label">Kembalian:</label>
                <input type="number" class="form-control" name="kembalian" id="kembalian" value ="{{ session('rekapan.kembalian', 0) }}" readonly>
            </div>

            <button type="submit" class="btn btn-success">Simpan Transaksi</button>
        </form>
    </div>

    <script>
        function tambahBarang() {
            const kategoriSelect = document.getElementById('kategoriSelect');
            const jumlahInput = document.getElementById('jumlahInput');
            const rekapanTable = document.getElementById('rekapan').getElementsByTagName('tbody')[0];
            const totalHargaInput = document.getElementById('total_harga');
            const kembalianInput = document.getElementById('kembalian');
            const uangPembeliInput = document.getElementById('uang_pembeli');

            const selectedOption = kategoriSelect.options[kategoriSelect.selectedIndex];
            const jenisBrg = selectedOption.text;
            const harga = parseInt(selectedOption.getAttribute('data-harga'));
            const jumlah = parseInt(jumlahInput.value);
            const totalHarga = harga * jumlah;

            const newRow = rekapanTable.insertRow();
            newRow.innerHTML = `
                <td></td> <!-- Kosongkan untuk diisi nomor urut -->
                <td>${jenisBrg}</td>
                <td>${harga}</td>
                <td>${jumlah}</td>
                <td>${totalHarga}</td>
                <td><button type="button" class="btn btn-danger" onclick="hapusBarang(this)">Hapus</button></td>
            `;

            // Update total harga
            let total = 0;
            for (let i = 0; i < rekapanTable.rows.length; i++) {
                total += parseInt(rekapanTable.rows[i].cells[4].innerText);
            }
            totalHargaInput.value = total;

            // Update kembalian
            const uangPembeli = parseInt(uangPembeliInput.value) || 0;
            kembalianInput.value = uangPembeli - total;

            // Update nomor urut
            updateNomorUrut();
        }

        function updateNomorUrut() {
            const rekapanTable = document.getElementById('rekapan').getElementsByTagName('tbody')[0];
            for (let i = 0; i < rekapanTable.rows.length; i++) {
                rekapanTable.rows[i].cells[0].innerText = i + 1; // Nomor urut mulai dari 1
            }
        }

        function hapusBarang(button) {
            const row = button.parentNode.parentNode;
            const rekapanTable = document.getElementById('rekapan').getElementsByTagName('tbody')[0];
            rekapanTable.deleteRow(row.rowIndex - 1); // -1 karena index dimulai dari 0

            // Update total harga
            let total = 0;
            for (let i = 0; i < rekapanTable.rows.length; i++) {
                total += parseInt(rekapanTable.rows[i].cells[4].innerText);
            }
            document.getElementById('total_harga').value = total;

            // Update kembalian
            const uangPembeli = parseInt(document.getElementById('uang_pembeli').value) || 0;
            document.getElementById('kembalian').value = uangPembeli - total;

            // Update nomor urut setelah menghapus
            updateNomorUrut();
        }

        function hapusBarang(button) {
            const row = button.parentNode.parentNode;
            const rekapanTable = document.getElementById('rekapan').getElementsByTagName('tbody')[0];
            rekapanTable.deleteRow(row.rowIndex - 1); // -1 karena index dimulai dari 0

            // Update total harga
            let total = 0;
            for (let i = 0; i < rekapanTable.rows.length; i++) {
                total += parseInt(rekapanTable.rows[i].cells[4].innerText);
            }
            document.getElementById('total_harga').value = total;

            // Update kembalian
            const uangPembeli = parseInt(document.getElementById('uang_pembeli').value) || 0;
            document.getElementById('kembalian').value = uangPembeli - total;
        }
    </script>
</x-layout>
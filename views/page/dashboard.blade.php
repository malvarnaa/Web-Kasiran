<x-layout>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css">

    <h2>{{ $header }}</h2>


    @if (auth()->check() && auth()->user()->role === 'admin')
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-4 mb-3">
                <div class="card text-dark" style="background-color: #ffff">
                    <div class="card-header text-white text-center d-flex align-items-center justify-content-center" style="background-color: #5a57c3;">
                        <i class="bi bi-box me-2"></i>
                        <h6 class="card-title mb-0 font-weight-bold">Jumlah Kategori</h6>
                    </div>                    
                    <div class="card-body d-flex align-items-center justify-content-center">
                        <h2 class="text-center mb-0">{{ $totalKategori }}</h2>
                    </div>
                    <a href="#" class="card-footer text-dark text-center">Info lebih lanjut <i class="bi bi-arrow-right-circle"></i></a>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card text-dark" style="background-color: #ffff">
                    <div class="card-header text-white d-flex align-items-center justify-content-center" style="background-color: #5a57c3;">
                        <i class="bi bi-people-fill me-2"></i>
                        <h6 class="card-title mb-0 font-weight-bold">Jumlah Petugas</h6>
                    </div>                    
                    <div class="card-body d-flex align-items-center justify-content-center">
                        <h2 class="text-center mb-0">{{ $totalPetugas }}</h2>
                    </div>
                    <a href="#" class="card-footer text-dark text-center">Info lebih lanjut <i class="bi bi-arrow-right-circle"></i></a>
                </div>
            </div>
            
            <div class="col-md-4 mb-3">
                <div class="card text-dark" style="background-color: #ffff">
                    <div class="card-header text-white d-flex align-items-center justify-content-center" style="background-color: #5a57c3;">
                        <i class="bi bi-arrow-left-right me-2"></i>
                        <h6 class="card-title mb-0 font-weight-bold">Jumlah Transaksi</h6>
                    </div>                    
                    <div class="card-body d-flex align-items-center justify-content-center">
                        <h2 class="text-center mb-0">5</h2>
                    </div>
                    <a href="#" class="card-footer text-dark text-center">Info lebih lanjut <i class="bi bi-arrow-right-circle"></i></a>
                </div>
            </div>      
            
            
            <div class="col-md-12 mb-3">
                <div class="card text-dark" style="background-color: #fff">
                    <div class="card-header text-dark d-flex align-items-center justify-content-space-between">
                        <h6 class="card-title mb-0 font-weight-bold">AA</h6>
                    </div>
                    <div class="card-body">
                        
                    </div>
                </div>
            </div>

            <h4>Kategori Barang</h4>        
            <div class="col-md-6 mb-3">
                <div class="card text-dark" style="background-color: #fff">
                    <div class="card-header text-dark d-flex align-items-center justify-content-space-between">
                        <h6 class="card-title mb-0 font-weight-bold">Pakaian</h6>
                    </div>
                    <div class="card-body">
                        
                    </div>
                </div>
            </div>
    </div>

    
    @endif

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</x-layout>

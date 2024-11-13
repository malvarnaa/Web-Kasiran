<aside class="sidebar text-white shadow-lg" id="sidebar">
    <div class="sidebar-header d-flex justify-content-between align-items-center">
        <h4 class="mb-0">Kasir</h4>
    </div>
    <ul class="nav flex-column">
        <!-- Beranda -->
        <li class="nav-item">
            <a href="@if(auth()->user()->role == 'admin') /dashboard/admin 
                    @elseif(auth()->user()->role == 'petugas') /dashboard/petugas 
                    @elseif(auth()->user()->role == 'pimpinan') /dashboard/pimpinan 
                    @endif" 
                class="nav-link {{ request()->is('dashboard/*') ? 'active' : '' }}">
                <i class="bi bi-house me-2"></i> Beranda
            </a>
        </li>

        <!-- Data Master Section with Collapsible Submenu -->
        <li class="nav-item">
            <a href="#" class="nav-link d-flex justify-content-between align-items-center" onclick="toggleSubMenu('dataMaster', this)">
                <span><i class="bi bi-folder me-2"></i> Data Master</span>
                <i class="bi bi-chevron-down" id="dataMaster-icon"></i>
            </a>
            <ul class="nav flex-column collapse" id="dataMaster">
                <li class="nav-item">
                    <a class="nav-link" href="/data/konsumen"><i class="bi bi-person-lines-fill me-2"></i> Data Konsumen</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/data/petugas"><i class="bi bi-exclamation-circle me-2"></i> Data Petugas</a>
                </li>
            </ul>
        </li>

        <!-- Kategori Barang Section -->
        <li class="nav-item">
            <a class="nav-link" href="/kategori"><i class="bi bi-file-earmark-text me-2"></i> Kategori Barang</a>
        </li>

        <!-- Pembayaran Section -->
        <li class="nav-item">
            <a class="nav-link" href="/pembayaran"><i class="bi bi-file-earmark-text me-2"></i> Jenis Pembayaran</a>
        </li>

        <!-- Transaksi Section with Collapsible Submenu -->
        <li class="nav-item">
            <a href="#" class="nav-link d-flex justify-content-between align-items-center" onclick="toggleSubMenu('transaksi', this)">
                <span><i class="bi bi-file-earmark-text me-2"></i> Transaksi</span>
                <i class="bi bi-chevron-down" id="transaksi-icon"></i>
            </a>
            <ul class="nav flex-column collapse" id="transaksi">
                <li class="nav-item">
                    <a class="nav-link" href="/transaksi/create"><i class="bi bi-file-earmark-text me-2"></i> Transaksi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/transaksi"><i class="bi bi-file-earmark-text me-2"></i> Riwayat Transaksi</a>
                </li>
            </ul>
        </li>

        <!-- Laporan Section -->
        <li class="nav-item">
            <a class="nav-link" href="/kategori"><i class="bi bi-file-earmark-text me-2"></i> Laporan</a>
        </li>

        <!-- Logout Section -->
        <li class="nav-item">
            <a class="nav-link" href="/logout"><i class="bi bi-box-arrow-right me-2"></i> Log Out</a>
        </li>
    </ul>
</aside>

<script>
    function toggleSubMenu(menuId, element) {
        const menu = document.getElementById(menuId);
        const icon = element.querySelector("i");

        if (menu.classList.contains("show")) {
            menu.classList.remove("show");
            icon.classList.replace("bi-chevron-up", "bi-chevron-down");
        } else {
            menu.classList.add("show");
            icon.classList.replace("bi-chevron-down", "bi-chevron-up");
        }
    }
</script>

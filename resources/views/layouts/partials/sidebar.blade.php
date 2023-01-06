<aside class="main-sidebar sidebar-light-primary">
    <!-- Brand Logo -->
    <a href="/" class="brand-link bg-primary">
        <img src="{{ asset('logo/logo-ajm.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light" style="font-size: 16px"><b>CV. Arsa Jaya Mandiri</b></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('adminlte/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2"
                    alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ auth()->user()->name }}</a>
            </div>
        </div>



        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="/dashboard" class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-header">AKUN</li>
                <li class="nav-item">
                    <a href="{{ route('profil') }}" class="nav-link {{ request()->is('profil*') ? 'active' : '' }}">
                        <i class="nav-icon fa fa-user"></i>
                        <p>
                            Profil Akun
                        </p>
                    </a>
                </li>
                @if (auth()->user()->level == 'owner')
                    <li class="nav-header">MASTER</li>
                    <li class="nav-item">
                        <a href="/unit" class="nav-link {{ request()->is('unit*') ? 'active' : '' }}">
                            <i class="nav-icon fa fa-truck"></i>
                            <p>
                                Unit
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/jenis" class="nav-link {{ request()->is('jenis*') ? 'active' : '' }}">
                            <i class="nav-icon fa fa-list"></i>
                            <p>
                                Jenis Pengiriman
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/biaya_pengiriman"
                            class="nav-link {{ request()->is('biaya_pengiriman*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-money-bill"></i>
                            <p>
                                Biaya Pengiriman
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/syarat_ketentuan"
                            class="nav-link {{ request()->is('syarat_ketentuan*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-file-signature"></i>
                            <p>
                                Syarat & Ketentuan Pengiriman
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/informasi_perusahaan"
                            class="nav-link {{ request()->is('informasi_perusahaan*') ? 'active' : '' }}">
                            <i class="fas fa-city"></i>
                            <p>
                                Informasi Perusahaan
                            </p>
                        </a>
                    </li>

                    <li class="nav-header">TRANSAKSI</li>
                    <li class="nav-item">
                        <a href="{{ route('pengiriman') }}"
                            class="nav-link {{ request()->is('pengiriman*') ? 'active' : '' }}">
                            <i class="nav-icon fa fa-paper-plane"></i>
                            <p>
                                Transaksi Pengiriman
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/pengeluaran" class="nav-link {{ request()->is('pengeluaran*') ? 'active' : '' }}">
                            <i class="nav-icon fa fa-credit-card"></i>
                            <p>
                                Pencatatan Pengeluaran
                            </p>
                        </a>
                    </li>
                @elseif (auth()->user()->level == 'koordinator')
                    <li class="nav-header">MASTER</li>
                    <li class="nav-item">
                        <a href="/pengguna" class="nav-link {{ request()->is('pengguna*') ? 'active' : '' }}">
                            <i class="nav-icon fa fa-users"></i>
                            <p>
                                Manajemen Pengguna
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/unit" class="nav-link {{ request()->is('unit*') ? 'active' : '' }}">
                            <i class="nav-icon fa fa-truck"></i>
                            <p>
                                Unit
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/jenis" class="nav-link {{ request()->is('jenis*') ? 'active' : '' }}">
                            <i class="nav-icon fa fa-list"></i>
                            <p>
                                Jenis Pengiriman
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/biaya_pengiriman"
                            class="nav-link {{ request()->is('biaya_pengiriman*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-money-bill"></i>
                            <p>
                                Biaya Pengiriman
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/syarat_ketentuan"
                            class="nav-link {{ request()->is('syarat_ketentuan*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-file-signature"></i>
                            <p>
                                Syarat & Ketentuan Pengiriman
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/informasi_perusahaan"
                            class="nav-link {{ request()->is('informasi_perusahaan*') ? 'active' : '' }}">
                            <i class="fas fa-city"></i>
                            <p>
                                Informasi Perusahaan
                            </p>
                        </a>
                    </li>
                    <li class="nav-header">TRANSAKSI</li>
                    <li class="nav-item">
                        <a href="{{ route('pengiriman') }}"
                            class="nav-link {{ request()->is('pengiriman*') ? 'active' : '' }}">
                            <i class="nav-icon fa fa-paper-plane"></i>
                            <p>
                                Transaksi Pengiriman
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/pengeluaran" class="nav-link {{ request()->is('pengeluaran*') ? 'active' : '' }}">
                            <i class="nav-icon fa fa-credit-card"></i>
                            <p>
                                Pencatatan Pengeluaran
                            </p>
                        </a>
                    </li>
                @elseif (auth()->user()->level == 'staff')
                    <li class="nav-header">MASTER</li>
                    <li class="nav-item">
                        <a href="/biaya_pengiriman"
                            class="nav-link {{ request()->is('biaya_pengiriman*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-money-bill"></i>
                            <p>
                                Biaya Pengiriman
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/informasi_perusahaan"
                            class="nav-link {{ request()->is('informasi_perusahaan*') ? 'active' : '' }}">
                            <i class="fas fa-city"></i>
                            <p>
                                Informasi Perusahaan
                            </p>
                        </a>
                    </li>
                    <li class="nav-header">TRANSAKSI</li>
                    <li class="nav-item">
                        <a href="{{ route('pengiriman') }}"
                            class="nav-link {{ request()->is('pengiriman*') ? 'active' : '' }}">
                            <i class="nav-icon fa fa-paper-plane"></i>
                            <p>
                                Transaksi Pengiriman
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/pengeluaran" class="nav-link {{ request()->is('pengeluaran*') ? 'active' : '' }}">
                            <i class="nav-icon fa fa-credit-card"></i>
                            <p>
                                Pencatatan Pengeluaran
                            </p>
                        </a>
                    </li>
                @else
                    <li class="nav-header">TRANSAKSI</li>
                    <li class="nav-item">
                        <a href="{{ route('pengiriman') }}"
                            class="nav-link {{ request()->is('pengiriman*') ? 'active' : '' }}">
                            <i class="nav-icon fa fa-paper-plane"></i>
                            <p>
                                Transaksi Pengiriman
                            </p>
                        </a>
                    </li>
                @endif
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>

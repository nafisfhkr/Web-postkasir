<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ada Kasir</title>

    <!-- Menambahkan Bootstrap (CDN) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Menambahkan Font Awesome (CDN) -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <!-- Menambahkan Chart.js (CDN) -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        body {
            display: flex;
            font-family: Arial, sans-serif;
            margin: 0;
            background-color: #F1F8E8; /* Background halaman utama */
        }
        .sidebar {
            width: 250px;
            background-color: #55AD9B; /* Sidebar warna hijau muda */
            color: #fff;
            height: 100vh;
            padding: 15px;
            position: fixed;
            transition: width 0.3s ease; /* Animasi saat sidebar mengecil */
            display: flex;
            flex-direction: column;
        }
        .sidebar.collapsed {
            width: 70px; /* Lebar sidebar saat collapsed */
        }
        .sidebar.collapsed h2 {
            display: none; /* Sembunyikan teks "Ada Kasir" saat collapsed */
        }
        .sidebar.collapsed .menu-text {
            display: none; /* Sembunyikan teks menu saat collapsed */
        }
        .sidebar.collapsed .menu-toggle::after {
            display: none; /* Sembunyikan arrow submenu saat collapsed */
        }
        .sidebar h2 {
            font-size: 1.5em;
            margin-bottom: 20px;
            padding-top: 10px; /* Tambahkan padding atas untuk "Ada Kasir" */
            text-align: center; /* Pusatkan teks "Ada Kasir" */
        }
        .sidebar ul {
            list-style-type: none;
            padding: 0;
            flex-grow: 1; /* Isi ruang kosong di sidebar */
        }
        .sidebar ul li {
            margin-bottom: 10px;
        }
        .sidebar ul li a {
            color: #fff;
            text-decoration: none;
            font-size: 1.1em;
            display: block;
            padding: 10px;
            border-radius: 5px;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }
        .sidebar ul li a:hover {
            background-color: rgba(255, 255, 255, 0.1); /* Efek hover */
            transform: scale(1.05); /* Sedikit membesar saat dihover */
        }
        .sidebar ul li a:active {
            transform: scale(0.95); /* Sedikit mengecil saat diklik */
        }
        .sidebar ul li a.active {
            background-color: rgba(255, 255, 255, 0.2); /* Warna latar belakang saat aktif */
            font-weight: bold; /* Teks lebih tebal */
            border-left: 4px solid #fff; /* Garis vertikal di sebelah kiri */
            padding-left: 6px; /* Sesuaikan padding agar teks tidak terlalu ke kiri */
        }
        .sidebar ul li a.active:hover {
            background-color: rgba(255, 255, 255, 0.3); /* Warna latar belakang saat aktif dan dihover */
        }
        .submenu {
            margin-left: 15px;
            display: none;
            padding-left: 10px;
            transition: all 0.3s ease;
        }
        .menu-item.active .submenu {
            display: block;
        }
        .menu-toggle::after {
            content: "\f107"; /* Font Awesome arrow down */
            font-family: "Font Awesome 5 Free";
            font-weight: 900;
            float: right;
            transition: transform 0.3s ease;
        }
        .menu-item.active .menu-toggle::after {
            content: "\f106"; /* Font Awesome arrow up */
            transform: rotate(180deg);
        }
        .content {
            margin-left: 250px; /* Sesuaikan dengan lebar sidebar */
            flex: 1;
            padding: 20px;
            transition: margin-left 0.3s ease; /* Animasi saat sidebar mengecil */
        }
        .content.collapsed {
            margin-left: 70px; /* Sesuaikan dengan lebar sidebar collapsed */
        }

        /* Tambahkan responsif untuk layar kecil */
        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                height: auto;
            }
            .content {
                margin-left: 0;
            }
        }

        /* Profil di Sidebar Bawah */
        .profile-section {
            margin-top: auto; /* Dorong profil ke bawah */
            padding: 10px;
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 8px;
            text-align: center;
            cursor: pointer; /* Ubah kursor menjadi pointer */
            transition: background-color 0.3s ease;
        }
        .profile-section:hover {
            background-color: rgba(255, 255, 255, 0.2); /* Efek hover pada profil */
        }
        .profile-section img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 10px;
        }
        .profile-section .profile-name {
            font-size: 1em;
            color: #fff;
            margin: 0;
        }

        /* Tombol Toggle Sidebar */
        .toggle-btn {
            position: fixed;
            top: 10px;
            left: 10px;
            z-index: 1050;
            background-color: #55AD9B;
            border: none;
            color: #fff;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .toggle-btn:hover {
            background-color: #4a9c8a;
        }

        /* Responsif untuk layar kecil */
        @media (max-width: 768px) {
            .sidebar {
                width: 100%; /* Sidebar memenuhi lebar layar */
                height: auto;
                position: relative; /* Sidebar menjadi tidak fixed */
            }
            .content {
                margin-left: 0;
                margin-top: 56px; /* Tetap beri jarak untuk navbar */
            }
        }
    </style>
</head>
<body>
    <!-- Tombol Toggle Sidebar -->
    <button class="toggle-btn" id="toggleSidebar">
        <i class="fas fa-bars"></i>
    </button>

    <!-- Sidebar -->
    <div class="sidebar d-flex flex-column" id="sidebar">
        <h2>Ada Kasir</h2>

        <!-- Wrapper untuk menu -->
        <div class="menu-wrapper flex-grow-1">
            <ul class="list-unstyled">
                <!-- Dashboard -->
                <li><a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}"><i class="fas fa-tachometer-alt"></i> <span class="menu-text">Dashboard</span></a></li>

                <!-- Transaksi -->
                <li><a href="{{ route('transactions.index') }}" class="{{ request()->routeIs('transactions.index') ? 'active' : '' }}"><i class="fas fa-shopping-cart"></i> <span class="menu-text">Transaksi</span></a></li>

                <!-- Management (submenu) -->
                <li class="menu-item">
                    <a href="#" class="menu-toggle"><i class="fas fa-cogs"></i> <span class="menu-text">Management</span></a>
                    <ul class="submenu">
                        <li><a href="{{ route('barang.index') }}" class="{{ request()->routeIs('barang.index') ? 'active' : '' }}"><i class="fas fa-box"></i> <span class="menu-text">Manajemen Barang</span></a></li>
                        <li><a href="{{ route('stok.index') }}" class="{{ request()->routeIs('stok.index') ? 'active' : '' }}"><i class="fas fa-warehouse"></i> <span class="menu-text">Manajemen Stok</span></a></li>
                        <li><a href="{{ route('kategori.index') }}" class="{{ request()->routeIs('kategori.index') ? 'active' : '' }}"><i class="fas fa-tags"></i> <span class="menu-text">Kategori</span></a></li>
                    </ul>
                </li>

                <!-- Diskon -->
                <li><a href="{{ route('diskon.index') }}" class="{{ request()->routeIs('diskon.index') ? 'active' : '' }}"><i class="fas fa-percentage"></i> <span class="menu-text">Diskon</span></a></li>

                <!-- Staff -->
                <li><a href="{{ route('staff.index') }}" class="{{ request()->routeIs('staff.index') ? 'active' : '' }}"><i class="fas fa-users"></i> <span class="menu-text">Staff</span></a></li>

                <!-- Suplier -->
                <li><a href="{{ route('suplier.index') }}" class="{{ request()->routeIs('suplier.index') ? 'active' : '' }}"><i class="fas fa-truck"></i> <span class="menu-text">Suplier</span></a></li>

                <!-- Customers -->
                <li><a href="{{ route('customers.index') }}" class="{{ request()->routeIs('customers.index') ? 'active' : '' }}"><i class="fas fa-users"></i> <span class="menu-text">Customers</span></a></li>

                <!-- Hutang Piutang (submenu) -->
                <li class="menu-item">
                    <a href="#" class="menu-toggle"><i class="fas fa-file-invoice-dollar"></i> <span class="menu-text">Hutang Piutang</span></a>
                    <ul class="submenu">
                        <li><a href="{{ route('hutang.index') }}" class="{{ request()->routeIs('hutang.index') ? 'active' : '' }}"><i class="fas fa-money-bill-wave"></i> <span class="menu-text">Hutang</span></a></li>
                        <li><a href="{{ route('piutang.index') }}" class="{{ request()->routeIs('piutang.index') ? 'active' : '' }}"><i class="fas fa-hand-holding-usd"></i> <span class="menu-text">Piutang</span></a></li>
                    </ul>
                </li>

                <!-- Laporan (submenu) -->
                <li class="menu-item">
                    <a href="#" class="menu-toggle"><i class="fas fa-file-alt"></i> <span class="menu-text">Laporan</span></a>
                    <ul class="submenu">
                        <li><a href="{{ route('reports.transactions') }}" class="{{ request()->routeIs('reports.transactions') ? 'active' : '' }}"><i class="fas fa-receipt"></i> <span class="menu-text">Laporan Transaksi</span></a></li>
                        <li><a href="{{ route('reports.financials') }}" class="{{ request()->routeIs('reports.financials') ? 'active' : '' }}"><i class="fas fa-chart-line"></i> <span class="menu-text">Laporan Keuangan</span></a></li>
                    </ul>
                </li>
            </ul>
        </div>

        <!-- Profil di Sidebar Bawah -->
        <div class="profile-section" onclick="window.location.href='{{ route('profile.edit') }}'">
            @if (Auth::user()->profile_picture)
                <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}" alt="Foto Profil">
            @else
                <img src="{{ asset('default-profile.png') }}" alt="Default Profile">
            @endif
            <p class="profile-name">{{ Auth::user()->name }}</p>
        </div>

        <!-- Tombol Logout -->
        <form action="{{ route('logout') }}" method="POST" class="logout-btn">
            @csrf
            <button type="submit" class="btn btn-link text-white text-decoration-none"><i class="fas fa-sign-out-alt"></i> <span class="menu-text">Logout</span></button>
        </form>
    </div>

    <!-- Content Area -->
    <div class="content" id="content">
        @yield('content')
    </div>

    <!-- Menambahkan JavaScript untuk Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

    <script>
        // Toggle Sidebar
        const toggleBtn = document.getElementById('toggleSidebar');
        const sidebar = document.getElementById('sidebar');
        const content = document.getElementById('content');

        toggleBtn.addEventListener('click', () => {
            sidebar.classList.toggle('collapsed');
            content.classList.toggle('collapsed');
        });

        // Toggle submenu ketika menu "Management" atau "Laporan" di klik
        document.querySelectorAll('.menu-toggle').forEach(item => {
            item.addEventListener('click', function (e) {
                e.preventDefault(); // Hindari navigasi default
                const parentLi = item.closest('li');
                parentLi.classList.toggle('active');
            });
        });

        
        document.querySelectorAll('.sidebar ul li a').forEach(item => {
            item.addEventListener('click', function (e) {
            
                this.style.transform = 'scale(0.95)';
                setTimeout(() => {
                    this.style.transform = 'scale(1)';
                }, 200);
            });
        });
    </script>


    @yield('scripts')
</body>
</html>
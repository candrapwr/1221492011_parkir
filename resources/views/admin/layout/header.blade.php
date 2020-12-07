<?php
    use Illuminate\Support\Facades\DB;
    use App\Nav_model;
    $site                 = DB::table('konfigurasi')->first();
    ?>
<style type="text/css" media="screen">
    li.nav-item {
    padding-bottom: 2px !important;
    padding-top: 2px !important;
    }
    a.nav-link {
    margin-bottom: 0 !important;
    margin-top: 0 !important;
    padding-bottom: 5px !important;
    padding-top: 0px !important;
    }
    hr.sidebar-divider {
    margin-bottom: 2px !important;
    margin-top: 2px !important;
    padding-bottom: 5px !important;
    padding-top: 0px !important;
    }
    .sidebar-brand-text, .mx-1, .sidebar-brand-icon {
    font-size: 14px !important;
    }
    span.notif {
    padding: 5px !important;
    font-size: 0.55rem !important;
    font-weight: bold;
    }
    .sidebar .nav-item .nav-link span {
    font-size: 0.75rem !important;
    }
</style>
<!--Page Wrapper -->
<div id="wrapper">
<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-left" href="{{ asset('admin/dasbor') }}">
        <div class="sidebar-brand-icon">
            <i class="fas fa-home"></i>
        </div>
        <div class="sidebar-brand-text mx-1">{{ $site->namaweb }}</div>
    </a>
    <!-- Divider -->
    <hr class="sidebar-divider">
    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="{{ asset('admin/dasbor') }}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Beranda</span></a>
    </li>
    <!-- TRANSAKSI -->
    <hr class="sidebar-divider">
    <div class="sidebar-heading">Ringkasan</div>
    <hr class="sidebar-divider">
    <li class="nav-item">
        <a class="nav-link" href="{{ asset('admin/resume_day') }}">
        <i class="fas fa-fw fa-newspaper"></i> <span>Transaksi Harian</span></a>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider">
    <div class="sidebar-heading">Laporan</div>
    <hr class="sidebar-divider">
    <li class="nav-item">
        <a class="nav-link" href="{{ asset('admin/report_day/v_report_day') }}">
        <i class="fa fa-fw fa-calendar"></i> <span>Laporan Detail Tranasaksi</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ asset('admin/report_day/v_report_rekap') }}">
        <i class="fa fa-fw fa-calendar"></i> <span>Rekap Tranasaksi Bulanan</span></a>
    </li>	
	<?php if(Session()->get('role')=='99'){?>
    <!-- Divider -->
    <hr class="sidebar-divider">
    <div class="sidebar-heading">Device Management</div>
    <hr class="sidebar-divider">
    <li class="nav-item">
        <a class="nav-link" href="{{ asset('admin/userdevices') }}">
        <i class="fa fa-fw fa-user-circle"></i> <span>Perangkat Jukir</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ asset('admin/devices') }}">
        <i class="fa fa-fw fa-mobile"></i> <span>Perangkat</span></a>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider">
    <div class="sidebar-heading">Operation Management</div>
    <hr class="sidebar-divider">
    <li class="nav-item">
        <a class="nav-link" href="{{ asset('admin/assignspengawas') }}">
        <i class="fa fa-fw fa-user-circle"></i> <span>Wilayah Pengawas</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ asset('admin/assigns') }}">
        <i class="fa fa-fw fa-user-circle"></i> <span>Daftar Jukir</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ asset('admin/user') }}">
        <i class="fa fa-fw fa-users"></i> <span>User</span></a>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider">
    <div class="sidebar-heading">Parking Settings</div>
    <hr class="sidebar-divider">
    <li class="nav-item">
        <a class="nav-link" href="{{ asset('admin/fee') }}">
        <i class="fa fa-fw fa-money-bill"></i> <span>Tarif Parkir</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ asset('admin/lot') }}">
        <i class="fa fa-fw fa-map"></i> <span>Area Parkir</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ asset('admin/territory') }}">
        <i class="fa fa-fw fa-sitemap"></i> <span>Wilayah</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ asset('admin/transportation') }}">
        <i class="fa fa-fw fa-car"></i> <span>Kategori Kendaraan</span></a>
    </li>
    <!-- Divider -->
	<?php } ?>
    <hr class="sidebar-divider d-none d-md-block">
    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
<!-- End of Sidebar -->
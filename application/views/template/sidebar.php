<!-- SIDEBAR -->
<section id="sidebar">
    <a href="#" class="brand">
        <img src="<?php echo base_url('assets/img/logo.png') ?>" alt="Garchik Logo" class="img-logo" />
        Garchik
    </a>
    <ul class="side-menu">
        <li><a href="#" class="active"><i class='bx bxs-dashboard icon'></i> Dashboard</a></li>
        <li class="divider" data-text="main">Main</li>
        <li>
            <a href="#"><i class='bx bxs-inbox icon'></i> Master <i class='bx bx-chevron-right icon-right'></i></a>
            <ul class="side-dropdown">
                <li><a href="<?= base_url(); ?>produk">Produk</a></li>
                <li><a href="<?= base_url(); ?>kategori">Kategori</a></li>
                <li><a href="#">Laporan_penjualan</a></li>
            </ul>
        </li>
        <li><a href="#"><i class='bx bxs-chart icon'></i> Manajemen Karyawan</a></li>
        <hr>
        <li>
            <a href="#"><i class='bx bxs-notepad icon'></i> Profile <i class='bx bx-chevron-right icon-right'></i></a>
            <ul class="side-dropdown">
                <li><a href="#">Edit Profile</a></li>
                <li><a href="#">Ganti Password</a></li>
            </ul>
        </li>
    </ul>
</section>

<section id="content">

    <nav>
        <i class='bx bx-menu toggle-sidebar'></i>
        <span class="divider"></span>
    </nav>
    <main>
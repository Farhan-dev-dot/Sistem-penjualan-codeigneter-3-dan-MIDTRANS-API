<header class="header">
    <div class="header__container">

        <img src="" alt="User Image" class="header__img" />


        <div class="header__toggle">
            <i class="bx bx-menu" id="header-toggle"></i>
        </div>
    </div>
</header>

<!--========== NAV ==========-->
<div class="nav" id="navbar">
    <div class="nav__container">
        <div>
            <a href="" class="nav__link nav__logo">
                <img src="<?= base_url(); ?>/assets/img/logo.png" alt="" class="nav__logo-img">

                <span class="nav__logo-name">Garchik</span>
            </a>

            <div class="nav__list">
                <div class="nav__items">
                    <h3 class="nav__subtitle">Profile</h3>

                    <a href="<?= base_url(); ?>" class="nav__link active">
                        <i class="fa fa-chart-pie nav__icon"></i>
                        <span class="nav__name">Dashboard</span>
                    </a>

                    <a href="<?= base_url(); ?>transaksi" class="nav__link active">
                        <i class="fa fa-box nav__icon"></i>
                        <span class="nav__name">Transaksi</span>
                    </a>

                    <a href="<?= base_url(); ?>Laporan_penjualan" class="nav__link active">
                        <i class="fa fa-money-bill nav__icon"></i>
                        <span class="nav__name">Detail Transaksi</span>
                    </a>
                </div>
                <h3 class="nav__subtitle">Menu</h3>

                <div class="nav__dropdown">
                    <a href="#" class="nav__link">
                        <i class="bx bx-user nav__icon"></i>
                        <span class="nav__name">Profile</span>
                        <i
                            class="bx bx-chevron-down nav__icon nav__dropdown-icon"></i>
                    </a>

                    <div class="nav__dropdown-collapse">
                        <div class="nav__dropdown-content">
                            <a href="#" class="nav__dropdown-item">Edit Profile</a>
                            <a href="#" class="nav__dropdown-item">Password</a></a>
                        </div>
                    </div>
                </div>
                <a href="#" class="nav__link nav__logout">
                    <i class="bx bx-log-out nav__icon"></i>
                    <span class="nav__name">Log Out</span>
                </a>

            </div>
        </div>
    </div>
</div>
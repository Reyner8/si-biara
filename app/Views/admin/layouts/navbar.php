<nav class="navbar navbar-expand-lg navbar-dark bg_nav">
    <div class="container">
        <a class="navbar-brand" href="#">
            <img class="logo-navbar" src="/upload/logo.png" alt="Logo" width="50">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">

            <ul class="navbar-nav">

                <!-- admin -->
                <?php if (session()->get('role') == 'admin') : ?>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/admin/beranda">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/admin/kegiatan">Kegiatan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/admin/anggota">Keanggotaan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/admin/kerasulan">Kerasulan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/admin/arsip">Berkas</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/admin/laporan">laporan</a></a>
                    </li>
                <?php endif; ?>
                <!-- // -->
                <?php if (session()->get('role') == 'superadmin') : ?>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/sa/beranda">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/sa/anggota">Keanggotaan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/sa/kegiatan">Kegiatan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/sa/kerasulan">Kerasulan</a></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/sa/arsip">Berkas</a></a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Data
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="dropdown-item" href="/sa/komunitas">Komunitas</a></li>
                            <li><a class="dropdown-item" href="/sa/tahapPembinaan">Tahap Pembinaan</a></li>
                            <li><a class="dropdown-item" href="/sa/jenisKerasulan">Jenis Kerasulan</a></li>
                            <!-- <li><a class="dropdown-item" href="/sa/about">Data About</a></li> -->
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/sa/laporan">laporan</a></a>
                    </li>
                <?php endif; ?>

                <?php if (session()->get('role') == 'superuser') : ?>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/sa/beranda">Beranda</a>
                    </li>
                    <!-- <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/sa/anggota">Keanggotaan</a>
                    </li> -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Keanggotaan
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="/sa/anggota">Anggota</a></li>
                            <li><a class="dropdown-item" href="/sa/pengajuan">Pengajuan Penugasan anggota</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/sa/kegiatan">Kegiatan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/sa/kerasulan">Kerasulan</a></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/sa/arsip">Berkas</a></a>
                    </li>

                    <!-- <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/sa/provinsi">Provinsi</a></a>
                    </li> -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Data
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="dropdown-item" href="/sa/komunitas">Komunitas</a></li>
                            <li><a class="dropdown-item" href="/sa/tahapPembinaan">Tahap Pembinaan</a></li>
                            <li><a class="dropdown-item" href="/sa/jenisKerasulan">Jenis Kerasulan</a></li>
                            <!-- <li><a class="dropdown-item" href="/sa/about">Data About</a></li> -->
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/sa/laporan">laporan</a></a>
                    </li>
                <?php endif; ?>

                <?php if (session()->get('role') == 'user') : ?>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/user/beranda">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/user/kegiatan">Kegiatan</a>
                    </li>
                <?php endif; ?>
            </ul>


        </div>

        <div class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-light" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fa fa-user"></i>
                <?php if (session()->get('role') == 'superuser') : ?>
                    <?= 'Administrator' ?>
                <?php elseif (session()->get('role') == 'superadmin') : ?>
                    <?= 'Pemimpin Provinsi' ?>
                <?php else : ?>
                    <?= 'Pemimpin Komunitas' ?>
                <?php endif; ?>
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="/admin/anggota/profil">Setting</a></li>

                <li>
                    <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="/auth/logout">Log-out</a></li>
            </ul>
        </div>
    </div>
</nav>
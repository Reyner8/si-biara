<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="#">SI-BIARA</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">

            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/beranda">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/kegiatan">Kegiatan</a>
                </li>
                <?php if (session()->get('role') == 'superuser') : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/admin/anggota">Penugasan</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Data
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="dropdown-item" href="/admin/komunitas">Komunitas</a></li>
                            <li><a class="dropdown-item" href="/admin/jenisKerasulan">Jenis Kerasulan</a></li>
                            <li><a class="dropdown-item" href="/admin/tahapPembinaan">Tahap Pembinaan</a></li>
                        </ul>
                    </li>
                <?php endif; ?>

                <?php if (session()->get('role') == 'admin') : ?>
                <?php endif; ?>

                <?php if (session()->get('role') == 'user' || session()->get('role') == 'wakil') : ?>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>
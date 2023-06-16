<?= $this->extend('admin/layouts/default') ?>

<?= $this->section('content') ?>
<div class="container">
    <div class="row mt-5 mb-5">
        <div class="col-md-12">
            <div class="card p-2">
                <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <?php foreach ($galeriKegiatan as $key => $galeri) : ?>
                            <div class="carousel-item <?= ($key) ? 'active' : '' ?>">
                                <img src="/upload/galeri/<?= $galeri['foto'] ?>" class="d-block w-100" alt="<?= $galeri['foto'] ?>">
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>

                <div class="card-body">
                    <h1 class="card-title"><?= $kegiatan['judul'] ?></h1>
                    <span class="text-info"><i class="fa fa-calendar"></i> <?= $kegiatan['tanggal'] ?></span>
                    <p class="card-text mt-4">
                        <?= $kegiatan['deskripsi'] ?>
                    </p>
                </div>
            </div>

        </div>
    </div>



</div>
<?= $this->endSection() ?>
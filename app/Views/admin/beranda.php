<?= $this->extend('admin/layouts/default') ?>

<?= $this->section('content') ?>
<div class="container">
    <div class="row mt-5">
        <div class="col-md-12 text-center mb-3">
            <h2>Kegiatan</h2>
        </div>
        <?php foreach ($listKegiatan as $kegiatan) : ?>
            <div class="col-md-4">
                <div class="card shadow p-3 mb-5 bg-body rounded" style="width: 18rem;">
                    <img src="/upload/galeri/<?= $kegiatan['thumbnail'] ?>" class="card-img-top" alt="<?= $kegiatan['thumbnail'] ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?= $kegiatan['judul'] ?></h5>
                        <p class="card-text mb-0"><?= substr($kegiatan['deskripsi'], 0, 15) . ' . . .'  ?></p>

                        <div class="d-flex flex-column">
                            <span class="text-info mb-2"><?= $kegiatan['tanggal'] ?></span>
                            <a href="/admin/beranda/<?= $kegiatan['id'] ?>" class="btn btn-primary btn-sm">More</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>



</div>
<?= $this->endSection() ?>
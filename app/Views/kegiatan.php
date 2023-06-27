<?= $this->extend('layouts/default') ?>

<?= $this->section('content') ?>
<section class="py-5">
  <div class="container px-5">
    <h1 class="fw-bolder fs-5 mb-4">Kegiatan Kami</h1>
    <div class="card border-0 shadow rounded-3 overflow-hidden">
      <div class="card-body p-0">
        <div class="row gx-0">
          <div class="col-lg-6 col-xl-5 py-lg-5">
            <div class="p-4 p-md-5">
              <div class="badge bg-primary bg-gradient rounded-pill mb-2">Latest</div>
              <div class="h2 fw-bolder"><?= $latest['judul'] ?></div>
              <?php
              $words = explode(' ', $latest['deskripsi']);
              $slice = array_slice($words, 0, 20);
              $newDeskripsi = implode(' ', $slice);
              ?>
              <p><?= $newDeskripsi ?></p>
              <a class="stretched-link text-decoration-none" href="/kegiatan/<?= $latest['id'] ?>">
                Read more
                <i class="bi bi-arrow-right"></i>
              </a>
            </div>
          </div>
          <div class="col-lg-6 col-xl-7">
            <div class="bg-featured-blog" style="background-image: url('/upload/galeri/<?= $latest['thumbnail'] ?>')"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="py-5">
  <div class="container px-5">
    <h2 class="fw-bolder fs-5 mb-4">Featured Stories</h2>
    <div class="row gx-5">
      <?php foreach ($listKegiatan as $kegiatan) : ?>
        <div class="col-lg-4 mb-5">
          <div class="card h-100 shadow border-0">
            <img class="card-img-top" src="/upload/galeri/<?= $kegiatan['thumbnail'] ?>" alt="<?= $kegiatan['thumbnail'] ?>" />
            <div class="card-body p-4">
              <div class="badge bg-primary bg-gradient rounded-pill mb-2">Kegiatan</div>
              <a class="text-decoration-none link-dark stretched-link" href="/kegiatan/<?= $kegiatan['id'] ?>">
                <div class="h5 card-title mb-3"><?= $kegiatan['judul'] ?></div>
              </a>

              <?php

              $words = explode(' ', $kegiatan['deskripsi']);
              $slice = array_slice($words, 0, 10);
              $newDeskripsi = implode(' ', $slice);
              ?>
              <p class="card-text mb-0"><?= $newDeskripsi ?></p>
            </div>
            <div class="card-footer p-4 pt-0 bg-transparent border-top-0">
              <div class="d-flex align-items-end justify-content-between">
                <div class="d-flex align-items-center">
                  <div class="small">
                    <div class="fw-bold"><?= $kegiatan['namaKomunitas'] ?></div>
                    <div class="text-muted"><?= $kegiatan['tanggal'] ?></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?= $this->endSection() ?>
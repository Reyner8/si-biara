<?= $this->extend('layouts/default') ?>

<?= $this->section('content') ?>
<?php
$titleCarousel = 'Aplikasi Pengolahan Data Biara';
$textCarousel = ''; ?>
<!-- Header-->
<header class="py-5" style="background-color: #EDEDED;">

  <div class="container-fluid px-5">
    <div id="carouselExampleIndicators" class="carousel slide carousel-fade" data-bs-ride="carousel">
      <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="3" aria-label="Slide 4"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="4" aria-label="Slide 5"></button>
      </div>

      <div class="carousel-inner">
        <div class="carousel-item drk active">
          <img class="carousel-img" src="/assets/user/carousel/1.jpg" class="d-block w-100" alt="1">
          <div class="carousel-caption d-none d-md-block d-flex flex-column justify-content-center h-100" style="top: 0;">
            <h1><?= $titleCarousel ?></h1>
            <p><?= $textCarousel ?></p>
          </div>
        </div>
        <div class="carousel-item drk">
          <img class="carousel-img" src="/assets/user/carousel/2.jpg" class="d-block w-100" alt="2">
          <div class="carousel-caption d-none d-md-block d-flex flex-column justify-content-center h-100" style="top: 0;">
            <h1><?= $titleCarousel ?></h1>
            <p><?= $textCarousel ?></p>
          </div>
        </div>
        <div class="carousel-item drk">
          <img class="carousel-img" src="/assets/user/carousel/3.jpg" class="d-block w-100" alt="3">
          <div class="carousel-caption d-none d-md-block d-flex flex-column justify-content-center h-100" style="top: 0;">
            <h1><?= $titleCarousel ?></h1>
            <p><?= $textCarousel ?></p>
          </div>
        </div>
        <div class="carousel-item drk">
          <img class="carousel-img" src="/assets/user/carousel/4.jpg" class="d-block w-100" alt="4">
          <div class="carousel-caption d-none d-md-block d-flex flex-column justify-content-center h-100" style="top: 0;">
            <h1><?= $titleCarousel ?></h1>
            <p><?= $textCarousel ?></p>
          </div>
        </div>
        <div class="carousel-item drk">
          <img class="carousel-img" src="/assets/user/carousel/5.jpg" class="d-block w-100" alt="5">
          <div class="carousel-caption d-none d-md-block d-flex flex-column justify-content-center h-100" style="top: 0;">
            <h1><?= $titleCarousel ?></h1>
            <p><?= $textCarousel ?></p>
          </div>
        </div>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
  </div>

</header>
<!-- Testimonial section-->
<div id="tentang" class="py-5" style="background-color: #DAEFE6;">
  <div class="container px-5 my-5">
    <div class="row gx-5 justify-content-center">
      <div class="col-md-6">
        <img class="img-fluid" src="/assets/user/image/tentang.jpg" alt="tentang-kami">
      </div>
      <div class="col-md-6 d-flex align-items-center">
        <div class="my-1">

          <h2 class="fw-bolder mb-5">Tentang Kami</h2>
          <p>Kongregasi Suster-Suster JMJ dipersembahkan dibawah perlindungan Keluarga Kudus. Bagi Kongregasi SJMJ Keluarga Kudus Nazaret; Jesus Maria Joseph adalah tempat yang kudus. Disanalah kesederhanaan, pelayanan, dan penyelamatan dimulai. Di tempat tersembunyi dan hening inilah, Yesus dipersiapkan untuk Panggilan-Nya, Keluarga Kudus menjadi model hidup berkomunitas kami.</p>
          <a class="btn btn-primary btn-md px-4 me-sm-3" href="/about">More</a>
        </div>
      </div>
    </div>
  </div>
</div>


<!-- Testimonial section-->
<div class="py-5">
  <div class="container px-5 my-5">
    <div class="row gx-5 justify-content-center">

      <div class="col-md-6 d-flex align-items-center">
        <div class="my-1 text-end">

          <h2 class="fw-bolder mb-5">Suster Suster di SJMJ</h2>
          <p>Provisial provinsi Jakarta beserta Dewan Provinsial.. Periode 2018-2023</p>
          <a class="btn btn-primary btn-md px-4 me-sm-3" href="/anggota">More</a>
        </div>
      </div>
      <div class="col-md-6">
        <img class="img-fluid" src="/assets/user/image/tentang-kami.jpg" alt="tentang-kami">
      </div>
    </div>
  </div>
</div>

<section class="py-5" style="background-color: #DAEFE6;">
  <div class="container px-5 my-5">
    <div class="row gx-5 justify-content-center">
      <div class="col-lg-8 col-xl-6">
        <div class="text-center">
          <h2 class="fw-bolder">Kegiatan Kami</h2>
          <p class="lead fw-normal text-muted mb-5">Kegiatan biara dari berbagai komunitas.</p>
        </div>
      </div>
    </div>

    <div class="row gx-5">
      <?php foreach ($listKegiatan as $key => $kegiatan) : ?>
        <?php if ($key == 3) {
          break;
        } ?>
        <div class="col-lg-4 mb-5">
          <div class="card h-100 shadow border-0">
            <img class="card-img-top" src="/upload/galeri/<?= $kegiatan['thumbnail'] ?>" alt="thumbnail" />
            <div class="card-body p-4">
              <div class="badge bg-primary bg-gradient rounded-pill mb-2">Kegiatan</div>
              <a class="text-decoration-none link-dark stretched-link" href="#!">
                <h5 class="card-title mb-3"><?= $kegiatan['judul'] ?></h5>
              </a>
              <p class="card-text mb-0"><?= implode(" ", array_slice(explode(" ", $kegiatan['deskripsi']), 0, 10));  ?>
              <div class="card-footer p-4 pt-0 bg-transparent border-top-0">
                <div class="d-flex align-items-end justify-content-between">
                  <div class="d-flex align-items-center">
                    <img class="rounded-circle me-3" width="40" height="40" src="/upload/profil/<?= $kegiatan['foto'] ?>" alt="profil" />
                    <div class="small">
                      <div class="fw-bold"><?= $kegiatan['nama'] ?></div>
                      <div class="text-muted"><?= $kegiatan['tanggal'] ?></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
      <div class="col-md-12 d-flex justify-content-center">
        <a href="/kegiatan" class="btn btn-primary">More</a>
      </div>
    </div>
</section>


<?= $this->endSection() ?>
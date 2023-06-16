<?= $this->extend('layouts/default') ?>

<?= $this->section('content') ?>
<section class="py-5">
  <div class="container px-5 my-5">
    <div class="row gx-5">
      <div class="col-lg-3">

        <div class="d-flex align-items-center mt-lg-5 mb-4">
          <img class="img-fluid rounded-circle" width="50" height="50" src="/upload/profil/<?= $kegiatan['foto'] ?>" alt="<?= $kegiatan['foto'] ?>" />
          <div class="ms-3">
            <div class="fw-bold"><?= $kegiatan['namaAnggota'] ?></div>
            <div class="text-muted">-</div>
          </div>
        </div>
      </div>
      <div class="col-lg-9">
        <!-- Post content-->
        <article>
          <!-- Post header-->
          <header class="mb-4">
            <!-- Post title-->
            <h1 class="fw-bolder mb-1"><?= $kegiatan['judul'] ?></h1>
            <!-- Post meta content-->
            <div class="text-muted fst-italic mb-2"><?= $kegiatan['tanggal'] ?></div>
            <!-- Post categories-->
          </header>
          <!-- Preview image figure-->
          <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img src="/upload/galeri/<?= $kegiatan['thumbnail'] ?>" class="d-block w-100" alt="<?= $kegiatan['thumbnail'] ?>">
              </div>
              <?php foreach ($galeri as $g) : ?>
                <div class="carousel-item">
                  <img src="/upload/galeri/<?= $g['foto'] ?>" class="d-block w-100" alt="<?= $g['foto'] ?>">
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
          <!-- Post content-->
          <section class="my-5">
            <?= $kegiatan['deskripsi'] ?>
          </section>
        </article>

      </div>
    </div>
  </div>
</section>
<?= $this->endSection() ?>
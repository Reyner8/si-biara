<?= $this->extend('layouts/default') ?>

<?= $this->section('content') ?>

<!-- Pricing section-->
<section class="bg-light py-5">
  <div class="container px-5 my-5">
    <div class="text-center mb-5">
      <h1 class="fw-bolder">Data Anggota</h1>
      <p class="lead fw-normal text-muted mb-0">Data anggota seluruh komunitas SJMJ</p>
    </div>
    <div class="row gx-5 justify-content-center">
      <?php foreach ($listAnggota as $anggota) :  ?>
        <div class="col-lg-4 mb-5">
          <div class="card h-100 shadow border-0">
            <img class="card-img-top" src="/upload/profil/<?= $anggota['foto'] ?>" alt="thumbnail" />
            <div class="card-body p-4">
              <div class="badge bg-<?= ($anggota['status'] == 'aktif') ? 'success' : 'danger' ?> bg-gradient rounded-pill mb-2"><?= $anggota['status'] ?></div>
              <a class="text-decoration-none link-dark stretched-link" href="anggota/<?= $anggota['id'] ?>">
                <h5 class="card-title mb-3"><?= $anggota['nomorBaju'] . ' - ' .  $anggota['nama'] ?></h5>
                <div class="text-muted"><?= $anggota['tempatLahir'] . ', ' . $anggota['tanggalLahir'] ?></div>

              </a>

            </div>
          </div>
        </div>
      <?php endforeach;  ?>
    </div>

  </div>
</section>



<?= $this->endSection() ?>
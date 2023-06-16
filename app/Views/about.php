<?= $this->extend('layouts/default') ?>

<?= $this->section('content') ?>
<section class="py-5">
  <div class="text-center mb-5">
    <h1 class="fw-bolder">Tentang Kami</h1>

  </div>
  <div class="container px-5 text-center">
    <?php foreach ($provinsi as $p) : ?>
      <div class="row mt-4">
        <div class="col-md-12">
          <h3>Provinsi <?= $p['nama'] ?></h3>
          <hr>
        </div>
      </div>
      <div class="row mb-5">
        <div class="col-md-12">
          <div class="card border-0 shadow rounded-3 overflow-hidden">
            <div class="card-body p-0">
              <h2>Visi & Misi</h2>
              <hr>
              <div class="row">
                <div class="col-md-12">
                  <h5>Visi</h5>
                  <?= $p['visi'] ?>
                </div>
                <div class="col-md-12">
                  <h5>Misi</h5>
                  <?= $p['misi'] ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-12">
          <div class="card border-0 shadow rounded-3 overflow-hidden">
            <div class="card-body">
              <div class="col-md-12">
                <h2>Sejarah</h2>
                <hr>
                <div class="row">
                  <div class="col-md-12">
                    <?= $p['sejarahSingkat'] ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    <?php endforeach; ?>

  </div>
</section>
<?= $this->endSection() ?>
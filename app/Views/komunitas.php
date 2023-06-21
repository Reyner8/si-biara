<?= $this->extend('layouts/default') ?>

<?= $this->section('content') ?>
<section class="py-5">
  <div class="text-center mb-5">
    <h1 class="fw-bolder">Komunitas</h1>
  </div>
  <div class="container px-5">
    <div class="row">
      <?php foreach ($listKomunitas as $komunitas) : ?>
        <div class="col-lg-6 mb-3">
          <div class="card border-0 shadow rounded-3 overflow-hidden">
            <div class="card-body p-0">
              <div class="row gx-0">
                <div class="col-lg-12 py-lg-5">
                  <div class="p-4 p-md-5">
                    <div class="h2 fw-bolder"><?= $komunitas['nama'] ?></div>
                    <table class="table table-borderless">
                      <tr>
                        <th>Tanggal Berdiri</th>
                        <td><?= $komunitas['tanggalBerdiri'] ?></td>
                      </tr>
                      <tr>
                        <th>Alamat</th>
                        <td><?= $komunitas['alamat'] ?></td>
                      </tr>
                    </table>

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
<?= $this->extend('layouts/default') ?>

<?= $this->section('content') ?>
<section class="py-5">
  <div class="text-center mb-5">
    <h1 class="fw-bolder">Karya Kerasulan</h1>
    <p class="lead fw-normal text-muted mb-0">Seluruh karya kerasulan dari berbagai komunitas. <br>
      karya kerasulan terbagi menjadi
      <?php foreach ($listJenisKerasulan as $key => $jenisKerasulan) : ?>
        <?php if ($key === array_key_last($listJenisKerasulan)) : ?>
          dan
          <a type="button" class="link-dark" data-bs-container="body" title="Keterangan" data-bs-toggle="popover" data-bs-placement="bottom" data-bs-content="<?= $jenisKerasulan['keterangan'] ?>">
            <?= $jenisKerasulan['nama'] ?>
          </a>
        <?php else : ?>
          <a type="button" class="link-dark" data-bs-container="body" title="Keterangan" data-bs-toggle="popover" data-bs-placement="bottom" data-bs-content="<?= $jenisKerasulan['keterangan'] ?>">
            <?= $jenisKerasulan['nama'] ?>
          </a>,
        <?php endif; ?>
      <?php endforeach; ?>
    </p>
  </div>
  <div class="container px-5">
    <div class="row">
      <?php foreach ($listKerasulan as $kerasulan) : ?>
        <div class="col-lg-6">
          <div class="card border-0 shadow rounded-3 overflow-hidden">
            <div class="card-body p-0">
              <div class="row gx-0">
                <div class="col-lg-12 py-lg-5">
                  <div class="p-4 p-md-5">
                    <div class="badge bg-primary bg-gradient rounded-pill mb-2"><?= $kerasulan['namaJenisKerasulan'] ?></div>
                    <div class="h2 fw-bolder"><?= $kerasulan['namaLembaga'] ?></div>
                    <table class="table table-borderless">
                      <tr>
                        <th>Tanggal Berdiri</th>
                        <td><?= $kerasulan['tanggalBerdiri'] ?></td>
                      </tr>
                      <tr>
                        <th>Komunitas</th>
                        <td><?= $kerasulan['namaKomunitas'] ?></td>
                      </tr>
                      <tr>
                        <th>Keterangan</th>
                        <td><?= $kerasulan['keterangan'] ?></td>
                      </tr>
                    </table>

                  </div>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
          </div>

        </div>
    </div>
  </div>
</section>
<?= $this->endSection() ?>
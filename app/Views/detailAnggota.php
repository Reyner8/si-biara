<?= $this->extend('layouts/default') ?>

<?= $this->section('content') ?>

<section class="py-5 bg-light" id="scroll-target">
  <div class="container px-5 my-5">
    <div class="row gx-5 align-items-center">
      <div class="col-lg-6"><img class="img-fluid rounded mb-5 mb-lg-0" src="/upload/profil/<?= $anggota['foto'] ?>" alt="..." /></div>
      <div class="col-lg-6">
        <table class="table table-borderless">
          <tr>
            <th>Nomor Baju</th>
            <td><?= $anggota['nomorBaju'] ?></td>
          </tr>
          <tr>
            <th>Nama</th>
            <td><?= $anggota['nama'] ?></td>
          </tr>
          <tr>
            <th>Tempat, Tanggal Lahir</th>
            <td><?= $anggota['tempatLahir'] ?>, <?= $anggota['tanggalLahir'] ?></td>
          </tr>
          <tr>
            <th>Nomor Telepon</th>
            <td><?= $anggota['nomorTelepon'] ?></td>
          </tr>
          <tr>
            <th>Status</th>
            <td><?= $anggota['status'] ?></td>
          </tr>
        </table>
      </div>

    </div>
    <div class="row gx-5 mt-5">
      <div class="col-xl-8">
        <!-- FAQ Accordion 1-->
        <h2 class="fw-bolder mb-3">Penugasan & Pembinaan</h2>
        <div class="accordion mb-5" id="accordionExample">
          <div class="accordion-item">
            <h3 class="accordion-header" id="headingOne"><button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">Penugasan</button></h3>
            <div class="accordion-collapse collapse show" id="collapseOne" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
              <div class="accordion-body">
                <table class="table table-borderless">
                  <tr>
                    <th>#</th>
                    <th>Komunitas</th>
                    <th>Tanggal Penugasan</th>
                    <th>Keterangan</th>
                  </tr>
                  <?php foreach ($listPenugasan as $penugasan) : ?>
                    <tr>
                      <td> <span class="badge bg-<?= ($penugasan['status'] == 'Y') ? 'success' : 'danger' ?>" role="alert">
                          <i class="fa fa-<?= ($penugasan['status'] == 'Y') ? 'check' : 'xmark' ?>"></i>
                        </span></td>
                      <td><?= $penugasan['nama'] ?></td>
                      <td><?= $penugasan['tanggalPenugasan'] ?></td>
                      <td><?= $penugasan['keterangan'] ?></td>
                    </tr>
                  <?php endforeach; ?>
                </table>
              </div>
            </div>
          </div>
          <div class="accordion-item">
            <h3 class="accordion-header" id="headingTwo"><button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">Pembinaan</button></h3>
            <div class="accordion-collapse collapse" id="collapseTwo" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
              <div class="accordion-body">
                <table class="table table-borderless">
                  <tr>
                    <th>#</th>
                    <th>nama</th>
                    <th>Tanggal Pembinaan</th>
                    <th>Keterangan</th>
                  </tr>
                  <?php foreach ($listPembinaan as $pembinaan) : ?>
                    <tr>
                      <td>
                        <span class="badge bg-<?= ($pembinaan['status'] == 'Y') ? 'success' : 'danger' ?>" role="alert">
                          <i class="fa fa-<?= ($pembinaan['status'] == 'Y') ? 'check' : 'xmark' ?>"></i>
                        </span>
                      </td>
                      <td><?= $pembinaan['nama'] ?></td>
                      <td><?= $pembinaan['tanggalPembinaan'] ?></td>
                      <td><?= $pembinaan['keterangan'] ?></td>
                    </tr>
                  <?php endforeach; ?>
                </table>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
</section>
<?= $this->endSection() ?>
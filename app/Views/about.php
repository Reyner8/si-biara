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
    <div class="row">
      <div class="col-md-12 mt-5">
        <div class="card">
          <div class="card-header">
            <h3>Riwayat Pemimpin Provinsi</h3>
          </div>
          <div class="card-body">

            <table class="table">
              <thead>
                <tr>
                  <th scope="col">Nomor Baju</th>
                  <th scope="col">Nama</th>
                  <th scope="col">Nama Komunitas</th>
                  <th scope="col">Tanggal Penugasan</th>
                  <th scope="col">Keterangan Penugasan</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($riwayatPemimpinProvinsi as $riwayat) : ?>
                  <tr>
                    <td><?= $riwayat['nomorBaju'] ?></td>
                    <td><?= $riwayat['nama'] ?></td>
                    <td><?= $riwayat['namaKomunitas'] ?></td>
                    <td><?= $riwayat['tanggalPenugasan'] ?></td>
                    <td><?= $riwayat['keterangan'] ?></td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

  </div>
</section>
<?= $this->endSection() ?>
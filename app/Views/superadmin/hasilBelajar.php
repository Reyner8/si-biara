<?= $this->extend('admin/layouts/default') ?>

<?= $this->section('content') ?>
<div class="container">
    <div class="row mt-5">
        <div class="col-md-12">
            <?php if (session()->getFlashdata('msg-danger')) : ?>
                <div class="alert alert-danger" role="alert">
                    <?= session()->getFlashdata('msg-danger') ?>
                </div>
            <?php endif; ?>
            <?php if (session()->getFlashdata('msg-success')) : ?>
                <div class="alert alert-success" role="alert">
                    <?= session()->getFlashdata('msg-success') ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-9 mb-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Biodata</h5>
                    <table class="table borderless">
                        <tr>
                            <th>Nama</th>
                            <td><?= $anggota['nama'] ?></td>
                        </tr>
                        <tr>
                            <th>Nomor Baju</th>
                            <td><?= $anggota['nomorBaju'] ?></td>
                        </tr>
                        <tr>
                            <th>Tempat, Tanggal Lahir</th>
                            <td><?= $anggota['tempatLahir'] . ', ' . $anggota['tanggalLahir'] ?></td>
                        </tr>
                        <tr>
                            <th>Telepon</th>
                            <td><?= $anggota['nomorTelepon'] ?></td>
                        </tr>
                        <tr>
                            <th>Status anggota</th>
                            <td><?= $anggota['status'] == 'aktif' ? 'AKTIF' : 'NON AKTIF' ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <img class="img-fluid" src="/upload/profil/<?= $anggota['foto'] ?>" alt="<?= $anggota['foto'] ?>">
        </div>
        <div class="col-md-12 mb-5">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">

                                <h5 class="card-title">Hasil Belajar</h5>
                                <button class="btn btn-primary btn-sm" data-bs-target="#tambah-hasil" data-bs-toggle="modal" <?= ($anggota['status'] == 'eksklaustrasi') ? 'disabled' : '' ?>><i class="fa fa-plus"></i></button>
                            </div>
                            <table class="table borderless">
                                <tr>
                                    <th>Universitas</th>
                                    <th>Fakultas</th>
                                    <th>Program Studi</th>
                                    <th>Jenjang</th>
                                    <th>Semester</th>
                                    <th>Keterangan</th>
                                    <th>File</th>
                                    <th>Action</th>
                                </tr>
                                <?php foreach ($listHasilBelajar as $hb) : ?>
                                    <tr>
                                        <td><?= $hb['universitas'] ?></td>
                                        <td><?= $hb['fakultas'] ?></td>
                                        <td><?= $hb['prodi'] ?></td>
                                        <td><?= $hb['jenjang'] ?></td>
                                        <td><?= $hb['semester'] ?></td>
                                        <td><?= $hb['keterangan'] ?></td>
                                        <td>
                                            <a href="/upload/belajar/<?= $hb['file'] ?>">Download</a>

                                        </td>
                                        <td>
                                            <form action="/sa/anggota/belajar/<?= $hb['id'] ?>" method="post">
                                                <input type="hidden" name="_method" value="DELETE">
                                                <button class="btn btn-outline-danger"><i class="fa fa-trash"></i></button>
                                            </form>
                                        </td>
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


<!-- tambah hasil -->
<div class="modal fade" id="tambah-hasil" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Hasil Belajar</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/sa/anggota/belajar/<?= $anggota['idAnggota'] ?>" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="universitas" class="form-label">Universitas</label>
                        <input type="text" class="form-control" name="universitas" placeholder="Universitas...">
                    </div>
                    <div class="mb-3">
                        <label for="fakultas" class="form-label">Fakultas</label>
                        <input type="text" class="form-control" name="fakultas" placeholder="Fakultas...">
                    </div>

                    <div class="mb-3">
                        <label for="prodi" class="form-label">Prodi</label>
                        <input type="text" class="form-control" name="prodi" placeholder="Prodi...">
                    </div>

                    <div class="mb-3">
                        <label for="jenjang" class="form-label">Jenjang</label>
                        <select name="jenjang" id="jenjang" class="form-control">
                            <option value="D3">D3</option>
                            <option value="D4">D4</option>
                            <option value="S1">S1</option>
                            <option value="S2">S2</option>
                            <option value="S3">S3</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="file" class="form-label">File</label>
                        <input type="file" class="form-control" name="file">
                    </div>

                    <button class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>
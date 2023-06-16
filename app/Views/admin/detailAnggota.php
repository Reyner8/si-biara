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
        <div class="col-md-12 mb-3">
            <div class="card shadow p-3 mb-5 bg-body rounded">
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
        <div class="col-md-12 mb-5">
            <div class="row">
                <div class="col-md-6">
                    <div class="card shadow p-3 mb-5 bg-body rounded">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">

                                <h5 class="card-title">Riwayat Penugasan</h5>
                                <button class="btn btn-primary btn-sm" data-bs-target="#tambah-penugasan" data-bs-toggle="modal"><i class="fa fa-plus"></i></button>
                            </div>
                            <table class="table borderless">
                                <tr>
                                    <th>#</th>
                                    <th>Komunitas</th>
                                    <th>Tanggal (Bertugas)</th>
                                    <th>Action</th>
                                </tr>
                                <?php foreach ($listPenugasan as $lp) : ?>
                                    <tr>
                                        <td><i class="fa fa-<?php if ($lp['status'] == 'T') {
                                                                echo 'times text-danger';
                                                            } elseif ($lp['status'] == 'Y') {
                                                                echo 'check text-success';
                                                            } else {
                                                                echo 'clock text-info';
                                                            } ?>"></i></td>
                                        <td><?= $lp['nama'] ?></td>
                                        <td><?= $lp['tanggalPenugasan'] ?></td>
                                        <td>
                                            <button type="button" class="btn btn-outline-info btn-sm" data-bs-toggle="modal" data-bs-target="#detail-penugasan-<?= $lp['id'] ?>"><i class="fa fa-info"></i></button>
                                            <form class="d-inline-block" action="/admin/anggota/penugasan/<?= $lp['id'] ?>" method="post">
                                                <input type="hidden" name="_method" value="DELETE">
                                                <button class="btn btn-outline-danger btn-sm"><i class="fa fa-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>

                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card shadow p-3 mb-5 bg-body rounded">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <h5 class="card-title">Riwayat Pembinaan</h5>
                                <button class="btn btn-primary btn-sm" data-bs-target="#tambah-pembinaan" data-bs-toggle="modal"><i class="fa fa-plus"></i></button>
                            </div>
                            <table class="table borderless">
                                <tr>
                                    <th>#</th>
                                    <th>Tahap</th>
                                    <th>Tanggal (Pembinaan)</th>
                                    <th>Action</th>
                                </tr>
                                <?php foreach ($listPembinaan as $pembinaan) : ?>
                                    <tr>
                                        <td><i class="fa fa-<?= ($pembinaan['status'] == 'N') ? 'times' : 'check' ?>"></i></td>
                                        <td><?= $pembinaan['nama'] ?></td>
                                        <td><?= $pembinaan['tanggalPembinaan'] ?></td>
                                        <td>
                                            <button type="button" class="btn btn-outline-info btn-sm" data-bs-toggle="modal" data-bs-target="#detail-pembinaan-<?= $pembinaan['id'] ?>"><i class="fa fa-info"></i></button>
                                            <form class="d-inline-block" action="/admin/anggota/pembinaan/<?= $pembinaan['id'] ?>" method="post">
                                                <input type="hidden" name="_method" value="DELETE">
                                                <button class="btn btn-outline-danger btn-sm"><i class="fa fa-trash"></i></button>
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


<!-- tambah modal -->
<div class="modal fade" id="tambah-penugasan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Penugasan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/admin/anggota/penugasan/<?= $anggota['idAnggota'] ?>" method="post">
                    <div class="mb-3">
                        <label for="komunitas" class="form-label">Komunitas</label>
                        <select id="komunitas" class="form-select" aria-label="Default select example" name="idKomunitas">
                            <option selected>Open this select menu</option>
                            <?php foreach ($listKomunitas as $k) : ?>
                                <option value="<?= $k['id'] ?>"><?= $k['nama'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="tanggalPenugasan" class="form-label">Tanggal Ditugaskan</label>
                        <input id="tanggalPenugasan" type="date" class="form-control" name="tanggalPenugasan" value="<?= old('tanggalPenugasan') ?>">
                        <p class="text-danger"><?= $validation->getError('tanggalPenugasan') ?></p>
                    </div>
                    <div class="mb-3">
                        <label for="keterangan" class="form-label">Keterangan</label>
                        <textarea id="editPenugasan-1" class="form-control editPenugasan" name="keteranganPenugasan" cols="30" rows="10"><?= old('keteranganPenugasan') ?></textarea>
                        <p class="text-danger"><?= $validation->getError('keteranganPenugasan') ?></p>
                    </div>
                    <div class="mb-3">
                        <label for="file" class="form-label">Berkas Penugasan</label>
                        <input class="form-control" type="file" id="file" name="file">
                    </div>
                    <button class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php foreach ($listPenugasan as $lpModal) : ?>
    <div class="modal fade" id="detail-penugasan-<?= $lpModal['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Keterangan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>
                        <?= $lp['keterangan'] ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<!-- tambah modal : pembinaan -->
<div class="modal fade" id="tambah-pembinaan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Pembinaan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/admin/anggota/pembinaan/<?= $anggota['idAnggota'] ?>" method="post">
                    <div class="mb-3">
                        <label for="tahapPembinaan" class="form-label">Tahap Pembinaan</label>
                        <select id="tahapPembinaan" class="form-select" aria-label="Default select example" name="idTahapPembinaan">
                            <option selected>Open this select menu</option>
                            <?php foreach ($listTahapPembinaan as $tp) : ?>
                                <option value="<?= $tp['id'] ?>"><?= $tp['nama'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="tanggalPenugasan" class="form-label">Tanggal Pembinaan</label>
                        <input id="tanggalPenugasan" type="date" class="form-control" name="tanggalPembinaan" value="<?= old('tanggalPembinaan') ?>">
                        <p class="text-danger"><?= $validation->getError('tanggalPembinaan') ?></p>
                    </div>
                    <div class="mb-3">
                        <label for="keterangan" class="form-label">Ketarangan</label>
                        <textarea id="editPembinaan-1" class="form-control editPembinaan" name="keteranganPembinaan" cols="30" rows="10"><?= old('keteranganPembinaan') ?></textarea>
                        <p class="text-danger"><?= $validation->getError('keteranganPembinaan') ?></p>
                    </div>
                    <div class="mb-3">
                        <label for="file" class="form-label">Berkas Pembinaan</label>
                        <input class="form-control" type="file" id="file" name="file">
                    </div>
                    <button class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php foreach ($listPembinaan as $pembinaanModal) : ?>
    <div class="modal fade" id="detail-penugasan-<?= $pembinaanModal['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Keterangan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>
                        <?= $pembinaanModal['keterangan'] ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>
<?= $this->endSection(); ?>
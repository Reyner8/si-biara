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


        <!-- table -->
        <div class="col-md-12">
            <div class="card shadow p-3 mb-5 bg-body rounded">
                <div class="card-body">
                    <h5 class="card-title">Data</h5>
                    <table id="datatable" class="table border-dark">
                        <thead class="text-center">
                            <tr>
                                <th>No. Baju</th>
                                <th>Nama</th>
                                <th>Komunitas (Tanggal Penugasan)</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($listAnggota as $anggota) : ?>
                                <tr>
                                    <td><?= $anggota['nomorBaju'] ?></td>
                                    <td><?= $anggota['namaAnggota'] ?></td>
                                    <td><?= $anggota['namaKomunitas'] . '(' . $anggota['tanggalPenugasan'] . ')' ?></td>
                                    <td><?= $anggota['status'] ?></td>
                                    <td>
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#penugasan-<?= $anggota['idAnggota'] ?>">
                                            Mutasi
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>



<!-- Modal -->
<?php foreach ($listAnggota as $modal) : ?>
    <div class="modal fade" id="penugasan-<?= $modal['idAnggota'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Penugasan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <table class="table">
                        <tr>
                            <th>Nama</th>
                            <td>:</td>
                            <td><?= $modal['namaAnggota'] ?></td>
                        </tr>
                        <tr>
                            <th>Nomor Baju</th>
                            <th>:</th>
                            <th><?= $modal['nomorBaju'] ?></th>
                        </tr>
                        <tr>
                            <th>Tempat Tanggal Lahir</th>
                            <th>:</th>
                            <th><?= $modal['tempatLahir'] . ', ' . $modal['tanggalLahir'] ?></th>
                        </tr>
                        <tr>
                            <th>status</th>
                            <th>:</th>
                            <th><?= $modal['status'] ?></th>
                        </tr>
                    </table>
                    <hr>
                    <h5>Riwayat Penugasan</h5>
                    <ul class="list-group borderless">
                        <?php foreach ($riwayatPenugasan as $rp) : ?>
                            <?php if ($rp['idAnggota'] == $modal['idAnggota']) : ?>
                                <li class="list-group-item d-flex justify-content-between align-items-start ">
                                    <div class="ms-2 me-auto">
                                        <div class="fw-bold"><?= $rp['nama'] ?></div>
                                        <?= $rp['tanggalPenugasan'] ?>
                                    </div>
                                    <form action="/admin/penugasan/<?= $rp['id'] ?>" method="POST">
                                        <input type="hidden" name="_method" value="DELETE">

                                        <button class="badge bg-danger rounded-pill"><i class="fa fa-trash"></i></button>
                                    </form>
                                </li>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </ul>
                    <table class="table table-borderless">
                        <tr>
                            <th>Nama Komunitas</th>
                            <th>Tahun Penugasan</th>
                        </tr>
                        <form action="/admin/penugasan/<?= $modal['idAnggota'] ?>" method="POST">
                            <tr>
                                <td>
                                    <select class="form-select form-select-sm" aria-label=".form-select-sm example" name="komunitas">
                                        <option selected>Open this select menu</option>
                                        <?php foreach ($komunitas as $k) : ?>
                                            <option value="<?= $k['id'] ?>"><?= $k['nama'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </td>
                                <td>
                                    <div class="mb-3">
                                        <input type="date" class="form-control form-control-sm" placeholder="Tanggal Penugasan" name="tanggalPenugasan">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>

                                    <button class="btn btn-primary btn-sm">Update</button>
                                </td>
                            </tr>
                    </table>
                </div>
                <!-- <div class="modal-footer">
                    <button type="button" class="btn btn-primary"></button>
                </div> -->
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<?= $this->endSection(); ?>
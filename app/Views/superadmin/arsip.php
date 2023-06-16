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


        <div class="row mb-2">
            <div class="col-md-12">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambah-data">
                    Tambah Arsip
                </button>
            </div>
        </div>
        <!-- table -->
        <div class="col-md-12">
            <div class="card shadow p-3 mb-5 bg-body rounded">
                <div class="card-body">
                    <h5 class="card-title">Data</h5>
                    <table id="datatable" class="table border-dark">
                        <thead class="text-center">
                            <tr>
                                <th>Provinsi</th>
                                <th>Nama</th>
                                <th>Tanggal</th>
                                <th>Jenis File</th>
                                <th>File</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($listArsip as $arsip) : ?>
                                <tr>
                                    <td><?= $arsip['namaProvinsi'] ?></td>
                                    <td><?= $arsip['nama'] ?></td>
                                    <td><?= $arsip['tanggal'] ?></td>
                                    <td><?= $arsip['jenisFile'] ?></td>
                                    <td><a href="/upload/berkas/<?= $arsip['file'] ?>">View</a></td>
                                    <td>
                                        <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#arsip-<?= $arsip['id'] ?>">
                                            <i class="fa fa-pencil"></i>
                                        </button>
                                        <form class="d-inline-block" action="/sa/arsip/<?= $arsip['id'] ?>" method="post">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                                        </form>
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

<!-- tambah data -->
<div class="modal fade" id="tambah-data" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Penambahan Berkas Laporan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form action="/sa/arsip" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input id="nama" type="text" class="form-control" name="nama" placeholder="Nama berkas..." value="<?= old('nama') ?>">
                        <p class="text-danger"><?= $validation->getError('nama') ?></p>
                    </div>
                    <div class="mb-3">
                        <label for="tanggal" class="form-label">Tanggal</label>
                        <input id="tanggal" type="date" class="form-control" name="tanggal" placeholder="Tanggal berkas..." value="<?= old('tanggal') ?>">
                        <p class="text-danger"><?= $validation->getError('tanggal') ?></p>
                    </div>
                    <div class="mb-3">
                        <label for="jenisFile" class="form-label">Jenis Laporan</label>
                        <select class="form-select form-select mb-3" aria-label=".form-select-lg example" name="jenisFile">
                            <option selected>Open this select menu</option>
                            <option value="tahunan">Laporan Tahunan</option>
                            <option value="bulanan">Laporan Bulanan</option>
                            <option value="surat_masuk">Surat Masuk</option>
                            <option value="surat_keluar">Surat Keluar</option>
                        </select>
                    </div>

                    <?php if (session()->get('role') == 'superuser') : ?>
                        <div class="mb-3">
                            <label for="idProvinsi" class="form-label">Provinsi</label>
                            <select class="form-select form-select mb-3" aria-label=".form-select-lg example" name="idProvinsi">
                                <option selected>Open this select menu</option>
                                <?php foreach ($listProvinsi as $provinsi) : ?>
                                    <option value="<?= $provinsi['id'] ?>"><?= $provinsi['nama'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    <?php endif; ?>

                    <?php if (session()->get('role') == 'superadmin') : ?>
                        <div class="mb-3">
                            <label for="idProvinsi" class="form-label">Provinsi</label>
                            <select class="form-select form-select mb-3" aria-label=".form-select-lg example" name="idProvinsi">
                                <option value="<?= $superAdminData['id'] ?>"><?= $superAdminData['nama'] ?></option>
                            </select>
                        </div>
                    <?php endif; ?>

                    <div class="mb-3">
                        <label for="file" class="form-label">File</label>
                        <input class="form-control" type="file" id="file" name="file">
                    </div>

                    <button class="btn btn-primary">Submit</button>
                </form>
            </div>

        </div>
    </div>
</div>

<!-- Modal -->
<?php foreach ($listArsip as $arsip) : ?>
    <div class="modal fade" id="arsip-<?= $arsip['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Berkas Laporan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <form action="/sa/arsip/<?= $arsip['id'] ?>" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="_method" value="PUT">
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input id="nama" type="text" class="form-control" name="nama" placeholder="Nama berkas..." value="<?= old('nama') ? old('nama') : $arsip['nama'] ?>">
                            <p class="text-danger"><?= $validation->getError('nama') ?></p>
                        </div>
                        <div class="mb-3">
                            <label for="tanggal" class="form-label">Tanggal</label>
                            <input id="tanggal" type="date" class="form-control" name="tanggal" placeholder="Tanggal berkas..." value="<?= old('tanggal') ? old('tanggal') : $arsip['tanggal'] ?>">
                            <p class="text-danger"><?= $validation->getError('tanggal') ?></p>
                        </div>
                        <div class="mb-3">
                            <label for="jenisFile" class="form-label">Jenis Laporan</label>
                            <select class="form-select form-select mb-3" aria-label=".form-select-lg example" name="jenisFile">
                                <option selected>Open this select menu</option>
                                <?php if ($arsip['jenisFile'] == 'tahunan') : ?>
                                    <option value="tahunan" selected>Laporan Tahunan</option>
                                    <option value="bulanan">Laporan Bulanan</option>
                                    <option value="surat_masuk">Surat Masuk</option>
                                    <option value="surat_keluar">Surat Keluar</option>

                                <?php elseif ($arsip['jenisFile'] == 'bulanan') : ?>
                                    <option value="tahunan">Laporan Tahunan</option>
                                    <option value="bulanan" selected>Laporan Bulanan</option>
                                    <option value="surat_masuk">Surat Masuk</option>
                                    <option value="surat_keluar">Surat Keluar</option>
                                <?php elseif ($arsip['jenisFile'] == 'surat_masuk') : ?>
                                    <option value="tahunan">Laporan Tahunan</option>
                                    <option value="bulanan">Laporan Bulanan</option>
                                    <option value="surat_masuk" selected>Surat Masuk</option>
                                    <option value="surat_keluar">Surat Keluar</option>
                                <?php else : ?>
                                    <option value="tahunan">Laporan Tahunan</option>
                                    <option value="bulanan">Laporan Bulanan</option>
                                    <option value="surat_masuk">Surat Masuk</option>
                                    <option value="surat_keluar" selected>Surat Keluar</option>
                                <?php endif; ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="idKomunitas" class="form-label">Provinsi</label>
                            <select class="form-select form-select mb-3" aria-label=".form-select-lg example" name="idProvinsi">
                                <?php foreach ($listProvinsi as $Provinsi) : ?>
                                    <?php if ($Provinsi['id'] == $arsip['idProvinsi']) : ?>
                                        <option selected value="<?= $Provinsi['id'] ?>"><?= $Provinsi['nama'] ?></option>
                                    <?php else : ?>
                                        <option value="<?= $Provinsi['id'] ?>"><?= $Provinsi['nama'] ?></option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <?php if (session()->get('role') == 'superadmin') : ?>
                            <div class="mb-3">
                                <label for="idProvinsi" class="form-label">Provinsi</label>
                                <select class="form-select form-select mb-3" aria-label=".form-select-lg example" name="idProvinsi">
                                    <option value="<?= $superAdminData['id'] ?>"><?= $superAdminData['nama'] ?></option>
                                </select>
                            </div>
                        <?php endif; ?>

                        <div class="mb-3">
                            <label for="file" class="form-label">File</label>
                            <input class="form-control" type="file" id="file" name="file">
                            <p>Biarkan kosong jika tidak mengedit!!</p>
                        </div>

                        <button class="btn btn-primary">Submit</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
<?php endforeach; ?>


<?= $this->endSection(); ?>
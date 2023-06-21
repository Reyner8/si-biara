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
                    <h5 class="card-title">Data Pengajuan Penugasan Komunitas</h5>
                    <table id="datatable" class="table border-dark">
                        <thead class="text-center">
                            <tr>
                                <th>No. Baju</th>
                                <th>Nama</th>
                                <th>Komunitas (Tanggal Penugasan)</th>
                                <th>Status Penugasan</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($listAnggota as $anggota) : ?>
                                <tr>
                                    <td><?= $anggota['nomorBaju'] ?></td>
                                    <td><?= $anggota['nama'] ?></td>
                                    <td><?= $anggota['namaKomunitas'] . '(' . $anggota['tanggalPenugasan'] . ')' ?></td>
                                    <td>
                                        <?php if ($anggota['statusPenugasan'] == 'Y') : ?>
                                            <span class="badge bg-success"> <?= 'Disetujui' ?></span>
                                        <?php elseif ($anggota['statusPenugasan'] == 'T') : ?>
                                            <span class="badge bg-danger"> <?= 'Tidak Disetujui' ?></span>
                                        <?php else : ?>
                                            <span class="badge bg-info"> <?= 'Menunggu' ?></span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <span class="badge bg-<?= ($anggota['status'] == 'aktif') ? 'success' : 'danger' ?>"> <?= $anggota['status'] ?></span>
                                    </td>
                                    <td>

                                        <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#penugasan-<?= $anggota['idAnggota'] ?>" <?= ($anggota['status'] == 'eksklaustrasi') ? 'disabled' : '' ?>>
                                            <i class="fa fa-pencil"></i>
                                        </button>

                                        <a class="btn btn-info btn-sm" href="/sa/anggota/detail/<?= $anggota['idAnggota'] ?>">
                                            <i class="fa fa-info"></i>
                                        </a>
                                        <a class="btn btn-secondary btn-sm" href="/sa/anggota/belajar/<?= $anggota['idAnggota'] ?>">
                                            <i class="fa fa-book"></i>
                                        </a>

                                        <form class="d-inline-block" action="/sa/anggota/<?= $anggota['idAnggota'] ?>" method="post">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button class="btn btn-danger btn-sm" <?= ($anggota['status'] == 'eksklaustrasi') ? 'disabled' : '' ?>><i class="fa fa-trash"></i></button>
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

<!-- Modal -->
<?php foreach ($listAnggota as $modal) : ?>
    <div class="modal fade" id="penugasan-<?= $modal['idAnggota'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Biodata</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/sa/anggota/<?= $modal['id'] ?>" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="_method" value="PUT" />
                        <div class="row">
                            <div class="col-md-3">
                                <img width="200" class="mb-2" src="/upload/profil/<?= $modal['foto'] ?>" alt="Person">
                                <input class="form-control form-control-sm" id="formFileSm" type="file" name="foto">
                            </div>
                            <div class="col-md-9">
                                <table class="table table-borderless">
                                    <tbody>
                                        <tr>
                                            <th>Nama</th>
                                            <td>:</td>
                                            <td>
                                                <input class="form-control form-control-sm" type="text" placeholder="Nama..." aria-label=".form-control-sm example" name="nama" value="<?= $modal['nama'] ?>">
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Nomor Baju</th>
                                            <th>:</th>
                                            <td>
                                                <input class="form-control form-control-sm" type="text" placeholder="Nomor baju..." aria-label=".form-control-sm example" name="nomorBaju" value="<?= $modal['nomorBaju'] ?>" disabled>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>TTL</th>
                                            <th>:</th>
                                            <td>
                                                <div class="row g-3">

                                                    <div class="col-auto">
                                                        <input class="form-control form-control-sm" type="text" placeholder="Tempat lahir..." aria-label=".form-control-sm example" name="tempatLahir" value="<?= $modal['tempatLahir'] ?>">
                                                    </div>
                                                    <div class="col-auto">

                                                        <input class="form-control form-control-sm" type="date" placeholder="Tanggal lahir..." aria-label=".form-control-sm example" name="tanggalLahir" value="<?= $modal['tanggalLahir'] ?>">
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Status</th>
                                            <th>:</th>
                                            <td>
                                                <select id="role" class="form-select" aria-label="Default select example" name="status">
                                                    <option selected>Open this select menu</option>
                                                    <?php if ($modal['status'] == 'aktif') : ?>
                                                        <option value="aktif" selected>Aktif</option>
                                                        <option value="non-aktif">Non Aktif</option>
                                                        <option value="eksklaustrasi">Eksklaustrasi</option>
                                                        <option value="meninggal">Meninggal</option>
                                                    <?php elseif ($modal['status'] == 'non-aktif') : ?>
                                                        <option value="aktif">Aktif</option>
                                                        <option value="non-aktif" selected>Non Aktif</option>
                                                        <option value="eksklaustrasi">Eksklaustrasi</option>
                                                        <option value="meninggal">Meninggal</option>
                                                    <?php elseif ($modal['status'] == 'eksklaustrasi') : ?>
                                                        <option value="aktif">Aktif</option>
                                                        <option value="non-aktif">Non Aktif</option>
                                                        <option value="eksklaustrasi" selected>Eksklaustrasi</option>
                                                        <option value="meninggal">Meninggal</option>
                                                    <?php elseif ($modal['status'] == 'meninggal') : ?>
                                                        <option value="aktif">Aktif</option>
                                                        <option value="non-aktif">Non Aktif</option>
                                                        <option value="eksklaustrasi">Eksklaustrasi</option>
                                                        <option value="meninggal" selected>Meninggal</option>
                                                    <?php endif; ?>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Berkas</th>
                                            <th>:</th>
                                            <td>
                                                <input class="form-control form-control-sm" type="file" aria-label=".form-control-sm example" name="file">
                                                <p>Upload sesuai status!!</p>
                                            </td>
                                        </tr>

                                        <tr>
                                            <th>Role</th>
                                            <th>:</th>
                                            <td>
                                                <select id="role" class="form-select" aria-label="Default select example" name="role">
                                                    <option selected>Open this select menu</option>
                                                    <?php if ($modal['role'] == 'admin') : ?>
                                                        <option value="superadmin">Pimpinan Provinsi</option>
                                                        <option selected value="admin">Kepala Komunitas</option>
                                                        <option value="user">Anggota Komunitas</option>
                                                    <?php elseif ($modal['role'] == 'superadmin') : ?>
                                                        <option selected value="superadmin">Pimpinan Provinsi</option>
                                                        <option value="admin">Kepala Komunitas</option>
                                                        <option value="user">Anggota Komunitas</option>
                                                    <?php else : ?>
                                                        <option value="superadmin">Pimpinan Provinsi</option>
                                                        <option value="admin">Kepala Komunitas</option>
                                                        <option selected value="user">Anggota Komunitas</option>
                                                    <?php endif; ?>
                                                </select>
                                            </td>
                                        </tr>

                                        <tr>
                                            <th>Nomor Telepon</th>
                                            <th>:</th>
                                            <td>
                                                <input class="form-control form-control-sm" type="text" placeholder="Nomor telepon..." aria-label=".form-control-sm example" name="nomorTelepon" value="<?= $modal['nomorTelepon'] ?>">
                                            </td>
                                        </tr>


                                        <tr>
                                            <th>Password</th>
                                            <th>:</th>
                                            <td>
                                                <input class="form-control form-control-sm" type="password" placeholder="Biarkan kosong jika tidak mengganti" aria-label=".form-control-sm example" name="password">
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-12 d-flex justify-content-end">
                                <button class="btn btn-primary btn-sm">Submit</button>
                            </div>
                    </form>
                </div>

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
                            </li>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </ul>
                <hr>
                <h5>Tahap Pembinaan</h5>
                <ul class="list-group borderless">
                    <?php foreach ($tahapPembinaan as $tp) : ?>
                        <?php if ($tp['idAnggota'] == $modal['idAnggota']) : ?>
                            <li class="list-group-item d-flex justify-content-between align-items-start ">
                                <div class="ms-2 me-auto">
                                    <div class="fw-bold"><?= $tp['nama'] ?></div>
                                    <?= $tp['tanggalPembinaan'] ?>
                                </div>
                            </li>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </ul>

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
<?= $this->extend('admin/layouts/default') ?>

<?= $this->section('content') ?>
<div class="container">
    <div class="row mt-5">
        <div class="col-md-12">
            <?php

            if (session()->getFlashdata('msg-danger')) : ?>
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
        <!-- forms -->
        <div class="col-md-4">
            <?php if (!$isEdit) : ?>
                <div class="card shadow p-3 mb-5 bg-body rounded">
                    <div class="card-body">
                        <h5 class="card-title">Forms</h5>
                        <form action="/admin/kerasulan" method="post" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="namaLembaga" class="form-label">Nama Lembaga/Instansi</label>
                                <input id="namaLembaga" type="text" class="form-control" name="namaLembaga" placeholder="Nama lembaga..." value="<?= old('namaLembaga') ?>">
                                <p class="text-danger"><?= $validation->getError('namaLembaga') ?></p>
                            </div>
                            <div class="mb-3">
                                <label for="jenisKerasulan" class="form-label">Jenis Kerasulan</label>
                                <select class="form-select" id="jenisKerasulan" name="idJenisKerasulan">
                                    <option selected>Open this select menu</option>
                                    <?php foreach ($listJenisKerasulan as $jenisKerasulan) : ?>
                                        <option value="<?= $jenisKerasulan['id'] ?>"><?= $jenisKerasulan['nama'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="tanggal" class="form-label">Tanggal Berdiri</label>
                                <input id="tanggal" type="date" class="form-control" name="tanggalBerdiri" placeholder="Tanggal Berdiri..." value="<?= old('tanggalBerdiri') ?>">
                                <p class="text-danger"><?= $validation->getError('tanggalBerdiri') ?></p>
                            </div>


                            <div class="mb-3">
                                <label for="keterangan" class="form-label">Keterangan</label>
                                <textarea class="form-control" name="keterangan" id="textarea" cols="30" rows="10"><?= old('keterangan') ?></textarea>
                                <p class="text-danger"><?= $validation->getError('keterangan') ?></p>
                            </div>
                            <button class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                <?php else : ?>
                    <div class="card shadow p-3 mb-5 bg-body rounded">
                        <div class="card-body">
                            <h5 class="card-title">Forms Update</h5>
                            <form action="/admin/kerasulan/edit/<?= $dataEdit['id'] ?>" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="_method" value="PUT">
                                <div class="mb-3">
                                    <label for="namaLembaga" class="form-label">Nama Lembaga/Instansi</label>
                                    <input id="namaLembaga" type="text" class="form-control" name="namaLembaga" placeholder="Nama lembaga..." value=" <?= old('namaLembaga') ? old('namaLembaga') : $dataEdit['namaLembaga'] ?>">
                                    <p class="text-danger"><?= $validation->getError('namaLembaga') ?></p>
                                </div>
                                <div class="mb-3">
                                    <label for="idJenisKerasulan" class="form-label">Jenis Kerasulan</label>
                                    <select class="form-select" aria-label="Default select example" name="idJenisKerasulan">
                                        <option selected>Open this select menu</option>
                                        <?php foreach ($listJenisKerasulan as $jenisKerasulan) : ?>
                                            <?php if ($dataEdit['id'] == $jenisKerasulan['id']) : ?>
                                                <option value="<?= $jenisKerasulan['id'] ?>" selected><?= $jenisKerasulan['nama'] ?></option>
                                            <?php else : ?>
                                                <option value="<?= $jenisKerasulan['id'] ?>"><?= $jenisKerasulan['nama'] ?></option>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="tanggal" class="form-label">Tanggal Berdiri</label>
                                    <input id="tanggal" type="date" class="form-control" name="tanggalBerdiri" placeholder="Tanggal Berdiri..." value="<?= old('tanggalBerdiri') ? old('tanggalBerdiri') : $dataEdit['tanggalBerdiri'] ?>">
                                    <p class="text-danger"><?= $validation->getError('tanggalBerdiri') ?></p>
                                </div>

                                <div class="mb-3">
                                    <label for="keterangan" class="form-label">Keterangan</label>
                                    <textarea class="form-control" name="keterangan" id="textarea" cols="30" rows="10"><?= old('keterangan') ? old('keterangan') : $dataEdit['keterangan'] ?></textarea>
                                    <p class="text-danger"><?= $validation->getError('keterangan') ?></p>
                                </div>
                                <button class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    <?php endif; ?>
                    </div>
                </div>

                <!-- table -->
                <div class="col-md-8">
                    <div class="card shadow p-3 mb-5 bg-body rounded">
                        <div class="card-body">
                            <h5 class="card-title">Data</h5>
                            <table id="datatable" class="display table border-dark">
                                <thead class="text-center">
                                    <tr>
                                        <th>Nama Lembaga</th>
                                        <th>Jenis Kerasulan</th>
                                        <th>Tanggal Berdiri</th>
                                        <th>Keterangan</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($listKerasulan as $kerasulan) : ?>
                                        <tr>
                                            <td><?= $kerasulan['namaLembaga'] ?></td>
                                            <td><?= $kerasulan['namaJenisKerasulan'] ?></td>
                                            <td><?= $kerasulan['tanggalBerdiri'] ?></td>
                                            <td>
                                                <?= $kerasulan['keterangan'] ?>
                                            </td>
                                            <td>
                                                <a class="btn btn-outline-warning btn-sm" href="/admin/kerasulan/edit/<?= $kerasulan['id'] ?>"><i class="fa fa-pencil"></i></a>
                                                <form class="d-inline-block" action="/admin/kerasulan/<?= $kerasulan['id'] ?>" method="post">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <button class="btn btn-outline-danger btn-sm"><i class="fa fa-trash"></i></button>
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
    <?php foreach ($listKerasulan as $kerasulanModal) : ?>
        <div class="modal fade" id="modal-<?= $kerasulanModal['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Foto & Deskripsi</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <h4>Foto</h4>
                            </div>
                            <div class="col-md-12">
                                <img class="img-fluid" src="/upload/kerasulan/<?= $kerasulanModal['foto'] ?>" alt="<?= $kerasulanModal['foto'] ?>">
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <h4>Keterangan</h4>
                            </div>
                            <div class="col-md-12">
                                <p><?= $kerasulanModal['keterangan'] ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>


    <?= $this->endSection(); ?>
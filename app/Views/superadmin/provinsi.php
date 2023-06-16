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
                        <form action="/sa/provinsi" method="post" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama Provinsi</label>
                                <input id="nama" type="text" class="form-control" name="nama" placeholder="Nama provinsi..." value="<?= old('nama') ?>">
                                <p class="text-danger"><?= $validation->getError('nama') ?></p>
                            </div>

                            <div class="mb-3">
                                <label for="visi" class="form-label">visi</label>
                                <textarea class="form-control" name="visi" id="textarea" cols="30" rows="10"><?= old('visi') ?></textarea>
                                <p class="text-danger"><?= $validation->getError('visi') ?></p>
                            </div>
                            <div class="mb-3">
                                <label for="misi" class="form-label">misi</label>
                                <textarea class="form-control" name="misi" id="textarea1" cols="30" rows="10"><?= old('misi') ?></textarea>
                                <p class="text-danger"><?= $validation->getError('misi') ?></p>
                            </div>
                            <div class="mb-3">
                                <label for="sejarahSingkat" class="form-label">Sejarah singkat</label>
                                <textarea class="form-control" name="sejarahSingkat" id="textarea2" cols="30" rows="10"><?= old('sejarahSingkat') ?></textarea>
                                <p class="text-danger"><?= $validation->getError('sejarahSingkat') ?></p>
                            </div>

                            <button class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                <?php else : ?>
                    <div class="card shadow p-3 mb-5 bg-body rounded">
                        <div class="card-body">
                            <h5 class="card-title">Forms Update</h5>
                            <form action="/sa/provinsi/edit/<?= $dataEdit['id'] ?>" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="_method" value="PUT">
                                <div class="mb-3">
                                    <label for="nama" class="form-label">Nama Provinsi</label>
                                    <input id="nama" type="text" class="form-control" name="nama" placeholder="Nama provinsi..." value=" <?= old('nama') ? old('nama') : $dataEdit['nama'] ?>">
                                    <p class="text-danger"><?= $validation->getError('nama') ?></p>
                                </div>

                                <div class="mb-3">
                                    <label for="visi" class="form-label">visi</label>
                                    <textarea class="form-control" name="visi" id="textarea" cols="30" rows="10"><?= old('visi') ? old('visi') : $dataEdit['visi'] ?></textarea>
                                    <p class="text-danger"><?= $validation->getError('visi') ?></p>
                                </div>
                                <div class="mb-3">
                                    <label for="misi" class="form-label">Misi</label>
                                    <textarea class="form-control" name="misi" id="textarea1" cols="30" rows="10"><?= old('misi') ? old('misi') : $dataEdit['misi'] ?></textarea>
                                    <p class="text-danger"><?= $validation->getError('misi') ?></p>
                                </div>
                                <div class="mb-3">
                                    <label for="sejarahSingkat" class="form-label">Sejarah Singkat</label>
                                    <textarea class="form-control" name="sejarahSingkat" id="textarea2" cols="30" rows="10"><?= old('sejarahSingkat') ? old('sejarahSingkat') : $dataEdit['sejarahSingkat'] ?></textarea>
                                    <p class="text-danger"><?= $validation->getError('sejarahSingkat') ?></p>
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
                                        <th>Nama Provinsi</th>
                                        <th>visi</th>
                                        <th>Misi</th>
                                        <th>Sejarah</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($listProvinsi as $provinsi) : ?>
                                        <tr>
                                            <td><?= $provinsi['nama'] ?></td>
                                            <td><?= $provinsi['visi'] ?></td>
                                            <td><?= $provinsi['misi'] ?></td>
                                            <td><?= $provinsi['sejarahSingkat'] ?></td>

                                            <td>
                                                <a class="btn btn-outline-warning btn-sm" href="/sa/provinsi/edit/<?= $provinsi['id'] ?>"><i class="fa fa-pencil"></i></a>
                                                <form class="d-inline-block" action="/sa/provinsi/<?= $provinsi['id'] ?>" method="post">
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



    <?= $this->endSection(); ?>
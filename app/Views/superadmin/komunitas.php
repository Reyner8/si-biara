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
        <!-- forms -->
        <div class="col-md-4">
            <?php if (!$isEdit) : ?>
                <div class="card shadow p-3 mb-5 bg-body rounded">
                    <div class="card-body">
                        <h5 class="card-title">Forms</h5>
                        <form action="/sa/komunitas" method="post">
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama Komunitas</label>
                                <input id="nama" type="text" class="form-control" name="nama" placeholder="Nama komunitas..." value="<?= old('nama') ?>">
                                <p class="text-danger"><?= $validation->getError('nama') ?></p>
                            </div>
                            <div class="mb-3">
                                <label for="alamat" class="form-label">Alamat</label>
                                <textarea id="alamat" class="form-control" name="alamat" cols="30" rows="10"><?= old('alamat') ?></textarea>
                                <p class="text-danger"><?= $validation->getError('alamat') ?></p>
                            </div>
                            <div class="mb-3">
                                <label for="tanggal" class="form-label">Tanggal Berdiri</label>
                                <input type="date" class="form-control" id="tanggal" name="tanggalBerdiri" placeholder="Tanggal berdiri..." value="<?= old('tanggalBerdiri') ?>">
                                <p class="text-danger"><?= $validation->getError('tanggalBerdiri') ?></p>
                            </div>
                            <div class="mb-3">
                                <label for="check" class="form-label">Status</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status" id="status" value="1" checked>
                                    <label for="status" class="form-check-label">Aktif</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status" id="status" value="0">
                                    <label for="status" class="form-check-label">Tidak Aktif</label>
                                </div>
                            </div>
                            <button class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                <?php else : ?>
                    <div class="card shadow p-3 mb-5 bg-body rounded">
                        <div class="card-body">
                            <h5 class="card-title">Forms Update</h5>
                            <form action="/sa/komunitas/edit/<?= $dataEdit['id'] ?>" method="post">
                                <input type="hidden" name="_method" value="PUT">
                                <div class="mb-3">
                                    <label for="nama" class="form-label">Nama Komunitas</label>
                                    <input id="nama" type="text" class="form-control" name="nama" placeholder="Nama komunitas..." value="<?= old('nama') ? old('nama') : $dataEdit['nama'] ?>">
                                    <p class="text-danger"><?= $validation->getError('nama') ?></p>
                                </div>
                                <div class="mb-3">
                                    <label for="alamat" class="form-label">Alamat</label>
                                    <textarea id="alamat" class="form-control" name="alamat" cols="30" rows="10"><?= old('alamat') ? old('alamat') : $dataEdit['alamat'] ?></textarea>
                                    <p class="text-danger"><?= $validation->getError('alamat') ?></p>
                                </div>
                                <div class="mb-3">
                                    <label for="tanggal" class="form-label">Tanggal Berdiri</label>
                                    <input type="date" class="form-control" id="tanggal" name="tanggalBerdiri" placeholder="Tanggal berdiri..." value="<?= old('tanggalBerdiri') ? old('tanggalBerdiri') : $dataEdit['tanggalBerdiri'] ?>">
                                    <p class="text-danger"><?= $validation->getError('tanggalBerdiri') ?></p>
                                </div>
                                <div class="mb-3">
                                    <label for="check" class="form-label">Status</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="status" id="status" value="1" <?= ($dataEdit['status'] == 1) ? 'checked' : ''  ?>>
                                        <label for="status" class="form-check-label">Aktif</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="status" id="status" value="0" <?= ($dataEdit['status'] == 0) ? 'checked' : ''  ?>>
                                        <label for="status" class="form-check-label">Tidak Aktif</label>
                                    </div>
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
                                        <th>Nama Komunitas</th>
                                        <th>Alamat</th>
                                        <th>Tanggal Berdiri</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($listKomunitas as $komunitas) : ?>
                                        <tr>
                                            <td><?= $komunitas['nama'] ?></td>
                                            <td><?= $komunitas['alamat'] ?></td>
                                            <td><?= $komunitas['tanggalBerdiri'] ?></td>
                                            <td><?= ($komunitas['status'] == 1) ? 'Aktif' : 'Non-Aktif' ?></td>
                                            <td>
                                                <a class="btn btn-outline-warning" href="/sa/komunitas/edit/<?= $komunitas['id'] ?>"><i class="fa fa-pencil"></i></a>
                                                <form action="/sa/komunitas/<?= $komunitas['id'] ?>" method="post">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <button class="btn btn-outline-danger"><i class="fa fa-trash"></i></button>
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
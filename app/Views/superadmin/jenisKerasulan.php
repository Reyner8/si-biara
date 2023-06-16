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
                        <form action="" method="post">
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama</label>
                                <input id="nama" type="text" class="form-control" name="nama" placeholder="Nama..." disabled>
                            </div>
                            <div class="mb-3">
                                <label for="keterangan" class="form-label">Keterangan</label>
                                <textarea id="keterangan" class="form-control" name="keterangan" cols="30" rows="10" disabled></textarea>
                            </div>

                            <button class="btn btn-primary" disabled>Submit</button>
                        </form>
                    </div>
                <?php else : ?>
                    <div class="card shadow p-3 mb-5 bg-body rounded">
                        <div class="card-body">
                            <h5 class="card-title">Forms</h5>
                            <form action="/sa/jenisKerasulan/edit/<?= $dataEdit['id'] ?>" method="post">
                                <input type="hidden" name="_method" value="PUT">
                                <div class="mb-3">
                                    <label for="nama" class="form-label">Nama</label>
                                    <input id="nama" type="text" class="form-control" placeholder="Nama..." value="<?= old('nama') ? old('nama') : $dataEdit['nama'] ?>" disabled>
                                </div>
                                <div class="mb-3">
                                    <label for="keterangan" class="form-label">Keterangan</label>
                                    <textarea id="textarea" class="form-control" name="keterangan" cols="30" rows="10"><?= old('keterangan') ? old('keterangan') : $dataEdit['keterangan'] ?></textarea>
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
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Data</h5>
                            <table class="table table-bordered border-dark">
                                <thead class="text-center">
                                    <tr>
                                        <th>Nama Karya</th>
                                        <th>Keterangan</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($listJenisKerasulan as $jenisKerasulan) : ?>
                                        <tr>
                                            <th><?= $jenisKerasulan['nama'] ?></th>
                                            <td><?= $jenisKerasulan['keterangan'] ?></td>
                                            <td>
                                                <a class="btn btn-outline-warning" href="/sa/jenisKerasulan/edit/<?= $jenisKerasulan['id'] ?>"><i class="fa fa-pencil"></i></a>
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
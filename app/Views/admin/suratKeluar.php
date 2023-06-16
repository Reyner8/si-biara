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
                        <form action="/admin/surat/keluar" method="post" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="nomorSurat" class="form-label">Nomor Surat</label>
                                <input id="nomorSurat" type="text" class="form-control" name="nomorSurat" placeholder="Nomor Surat..." value="<?= old('nomorSurat') ?>">
                                <p class="text-danger"><?= $validation->getError('nomorSurat') ?></p>
                            </div>
                            <div class="mb-3">
                                <label for="tanggalSurat" class="form-label">Tanggal Surat</label>
                                <input id="tanggalSurat" type="date" class="form-control" name="tanggalSurat" placeholder="Tanggal Surat..." value="<?= old('tanggalSurat') ?>">
                                <p class="text-danger"><?= $validation->getError('tanggalSurat') ?></p>
                            </div>
                            <div class="mb-3">
                                <label for="tanggalKirim" class="form-label">Tanggal Kirim</label>
                                <input id="tanggalKirim" type="date" class="form-control" name="tanggalKirim" placeholder="Tanggal Surat..." value="<?= old('tanggalKirim') ?>">
                                <p class="text-danger"><?= $validation->getError('tanggalKirim') ?></p>
                            </div>
                            <div class="mb-3">
                                <label for="tujuan" class="form-label">Tujuan</label>
                                <input id="tujuan" type="text" class="form-control" name="tujuan" placeholder="tujuan..." value="<?= old('tujuan') ?>">
                                <p class="text-danger"><?= $validation->getError('pengirim') ?></p>
                            </div>
                            <div class="mb-3">
                                <label for="perihal" class="form-label">Perihal</label>
                                <textarea class="form-control" id="textarea" rows="3" name="perihal"><?= old('perihal') ?></textarea>
                                <p class="text-danger"><?= $validation->getError('perihal') ?></p>
                            </div>
                            <div class="mb-3">
                                <label for="file" class="form-label">file</label>
                                <input class="form-control" type="file" id="file" name="file">
                                <p>Pilih Document...</p>
                            </div>
                            <button class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            <?php else : ?>
                <div class="card shadow p-3 mb-5 bg-body rounded">
                    <div class="card-body">
                        <h5 class="card-title">Forms Update</h5>
                        <form action="/admin/surat/keluar/edit/<?= $dataEdit['id'] ?>" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="_method" value="PUT">
                            <div class="mb-3">
                                <label for="nomorSurat" class="form-label">Nomor Surat</label>
                                <input id="nomorSurat" type="text" class="form-control" name="nomorSurat" placeholder="Nomor Surat..." value="<?= old('nomorSurat') ? old('nomorSurat') : $dataEdit['nomorSurat'] ?>">
                                <p class="text-danger"><?= $validation->getError('nomorSurat') ?></p>
                            </div>
                            <div class="mb-3">
                                <label for="tanggalSurat" class="form-label">Tanggal Surat</label>
                                <input id="tanggalSurat" type="date" class="form-control" name="tanggalSurat" placeholder="Tanggal Surat..." value="<?= old('tanggalSurat') ? old('tanggalSurat') : $dataEdit['tanggalSurat'] ?>">
                                <p class="text-danger"><?= $validation->getError('tanggalSurat') ?></p>
                            </div>
                            <div class="mb-3">
                                <label for="tanggalKirim" class="form-label">Tanggal Kirim</label>
                                <input id="tanggalKirim" type="date" class="form-control" name="tanggalKirim" placeholder="Tanggal Keluar..." value="<?= old('tanggalKirim') ? old('tanggalKirim') : $dataEdit['tanggalKirim'] ?>">
                                <p class="text-danger"><?= $validation->getError('tanggalKirim') ?></p>
                            </div>
                            <div class="mb-3">
                                <label for="tujuan" class="form-label">Tujuan</label>
                                <input id="tujuan" type="text" class="form-control" name="tujuan" placeholder="tujuan..." value="<?= old('tujuan') ? old('tujuan') : $dataEdit['tujuan'] ?>">
                                <p class="text-danger"><?= $validation->getError('tujuan') ?></p>
                            </div>
                            <div class="mb-3">
                                <label for="perihal" class="form-label">Perihal</label>
                                <textarea class="form-control" id="textarea" rows="3" name="perihal"><?= old('perihal') ? old('perihal') : $dataEdit['perihal'] ?></textarea>
                                <p class="text-danger"><?= $validation->getError('perihal') ?></p>
                            </div>
                            <div class="mb-3">
                                <label for="file" class="form-label">file</label>
                                <input class="form-control" type="file" id="file" name="file">
                                <p>Pilih Document... Biarkan kosong jika tidak mengubah!!!</p>
                            </div>
                            <button class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            <?php endif; ?>

        </div>
        <!-- table -->
        <div class="col-md-8">
            <div class="card shadow p-3 mb-5 bg-body rounded">
                <div class="card-body table-responsive">
                    <h5 class="card-title">Data</h5>
                    <table id="datatable" class="display table border-dark">
                        <thead class="text-center">
                            <tr>
                                <th>No.Surat</th>
                                <th>Tanggal Surat</th>
                                <th>Tanggal Kirim</th>
                                <th>Tujuan</th>
                                <th>Perihal</th>
                                <th>Berkas</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($listSuratKeluar as $suratKeluar) : ?>
                                <tr>
                                    <td><?= $suratKeluar['nomorSurat'] ?></td>
                                    <td><?= $suratKeluar['tanggalSurat'] ?></td>
                                    <td><?= $suratKeluar['tanggalKirim'] ?></td>
                                    <td><?= $suratKeluar['tujuan'] ?></td>
                                    <td><?= $suratKeluar['perihal'] ?></td>
                                    <td>
                                        <a href="/upload/surat/<?= $suratKeluar['file'] ?>" class="">View</a>

                                    </td>



                                    <td>
                                        <a class="btn btn-outline-warning btn-sm" href="/admin/surat/keluar/edit/<?= $suratKeluar['id'] ?>"><i class="fa fa-pencil"></i></a>
                                        <form class="d-inline-block" action="/admin/surat/keluar/<?= $suratKeluar['id'] ?>" method="post">
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
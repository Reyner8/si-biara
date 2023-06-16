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
                        <form action="/sa/surat/masuk" method="post" enctype="multipart/form-data">
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
                                <label for="tanggalTerima" class="form-label">Tanggal Terima</label>
                                <input id="tanggalTerima" type="date" class="form-control" name="tanggalTerima" placeholder="Tanggal Surat..." value="<?= old('tanggalTerima') ?>">
                                <p class="text-danger"><?= $validation->getError('tanggalTerima') ?></p>
                            </div>
                            <div class="mb-3">
                                <label for="pengirim" class="form-label">Pengirim</label>
                                <input id="pengirim" type="text" class="form-control" name="pengirim" placeholder="Pengirim..." value="<?= old('pengirim') ?>">
                                <p class="text-danger"><?= $validation->getError('pengirim') ?></p>
                            </div>
                            <div class="mb-3">
                                <label for="perihal" class="form-label">Perihal</label>
                                <textarea class="form-control" id="textarea" rows="3" name="perihal"><?= old('perihal') ?></textarea>
                                <p class="text-danger"><?= $validation->getError('perihal') ?></p>
                            </div>

                            <div class="mb-3">
                                <label for="Komunitas" class="form-label">Komunitas</label>
                                <select class="form-select form-select-sm" aria-label=".form-select-sm example" name="idKomunitas">
                                    <option selected>Open this select menu</option>
                                    <?php foreach ($listKomunitas as $komunitas) : ?>
                                        <option value="<?= $komunitas['id'] ?>"><?= $komunitas['nama'] ?></option>
                                    <?php endforeach; ?>
                                </select>
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
                        <form action="/sa/surat/masuk/edit/<?= $dataEdit['id'] ?>" method="post" enctype="multipart/form-data">
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
                                <label for="tanggalTerima" class="form-label">Tanggal Terima</label>
                                <input id="tanggalTerima" type="date" class="form-control" name="tanggalTerima" placeholder="Tanggal Surat..." value="<?= old('tanggalTerima') ? old('tanggalTerima') : $dataEdit['tanggalTerima'] ?>">
                                <p class="text-danger"><?= $validation->getError('tanggalTerima') ?></p>
                            </div>
                            <div class="mb-3">
                                <label for="pengirim" class="form-label">Pengirim</label>
                                <input id="pengirim" type="text" class="form-control" name="pengirim" placeholder="Pengirim..." value="<?= old('pengirim') ? old('pengirim') : $dataEdit['pengirim'] ?>">
                                <p class="text-danger"><?= $validation->getError('pengirim') ?></p>
                            </div>
                            <div class="mb-3">
                                <label for="perihal" class="form-label">Perihal</label>
                                <textarea class="form-control" id="textarea" rows="3" name="perihal"><?= old('perihal') ? old('perihal') : $dataEdit['perihal'] ?></textarea>
                                <p class="text-danger"><?= $validation->getError('perihal') ?></p>
                            </div>

                            <div class="mb-3">
                                <label for="Komunitas" class="form-label">Komunitas</label>
                                <select class="form-select form-select-sm" aria-label=".form-select-sm example" name="idKomunitas">
                                    <option selected>Open this select menu</option>
                                    <?php foreach ($listKomunitas as $komunitas) : ?>
                                        <?php if ($dataEdit['idKomunitas'] == $komunitas['id']) : ?>
                                            <option value="<?= $komunitas['id'] ?>" selected><?= $komunitas['nama'] ?></option>
                                        <?php else : ?>
                                            <option value="<?= $komunitas['id'] ?>"><?= $komunitas['nama'] ?></option>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </select>
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
                                <th>Tanggal Terima</th>
                                <th>Pengirim</th>
                                <th>Perihal</th>
                                <th>Komunitas</th>
                                <th>Berkas</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($listSuratMasuk as $suratMasuk) : ?>
                                <tr>
                                    <td><?= $suratMasuk['nomorSurat'] ?></td>
                                    <td><?= $suratMasuk['tanggalSurat'] ?></td>
                                    <td><?= $suratMasuk['tanggalTerima'] ?></td>
                                    <td><?= $suratMasuk['pengirim'] ?></td>
                                    <td><?= $suratMasuk['perihal'] ?></td>
                                    <td><?= $suratMasuk['namaKomunitas'] ?></td>
                                    <td>
                                        <a href="/upload/surat/<?= $suratMasuk['file'] ?>" class="">View</a>

                                    </td>



                                    <td>
                                        <a class="btn btn-outline-warning btn-sm" href="/sa/surat/masuk/edit/<?= $suratMasuk['id'] ?>"><i class="fa fa-pencil"></i></a>
                                        <form class="d-inline-block" action="/sa/surat/masuk/<?= $suratMasuk['id'] ?>" method="post">
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
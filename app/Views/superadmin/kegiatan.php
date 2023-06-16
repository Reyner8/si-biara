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
                        <form action="/admin/kegiatan" method="post" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="judul" class="form-label">Judul Kegiatan</label>
                                <input id="judul" type="text" class="form-control" name="judul" placeholder="Judul Kegiatan..." value="<?= old('judul') ?>">
                                <p class="text-danger"><?= $validation->getError('judul') ?></p>
                            </div>
                            <div class="mb-3">
                                <label for="deskripsi" class="form-label">Deskripsi Kegiatan</label>
                                <textarea class="form-control" id="textarea" rows="3" name="deskripsi"><?= old('deskripsi') ?></textarea>
                                <p class="text-danger"><?= $validation->getError('deskripsi') ?></p>
                            </div>
                            <div class="mb-3">
                                <label for="tanggal" class="form-label">Tanggal Kegiatan</label>
                                <input id="tanggal" type="date" class="form-control" name="tanggal" placeholder="Tanggal Kegiatan..." value="<?= old('tanggal') ?>">
                                <p class="text-danger"><?= $validation->getError('tanggal') ?></p>
                            </div>

                            <div class="mb-3">
                                <label for="thumbnail" class="form-label">Thumbnail</label>
                                <input class="form-control" type="file" id="thumbnail" name="thumbnail">
                                <p>Pilih beberapa foto untuk thumbnail...</p>
                            </div>
                            <button class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                <?php else : ?>
                    <div class="card shadow p-3 mb-5 bg-body rounded">
                        <div class="card-body">
                            <h5 class="card-title">Forms Update</h5>
                            <form action="/admin/kegiatan/edit/<?= $dataEdit['id'] ?>" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="_method" value="PUT">
                                <div class="mb-3">
                                    <label for="judul" class="form-label">Judul Kegiatan</label>
                                    <input id="judul" type="text" class="form-control" name="judul" placeholder="Judul Kegiatan..." value="<?= old('judul') ? old('judul') : $dataEdit['judul'] ?>">
                                    <p class="text-danger"><?= $validation->getError('judul') ?></p>
                                </div>
                                <div class="mb-3">
                                    <label for="deskripsi" class="form-label">Deskripsi Kegiatan</label>
                                    <textarea class="form-control" id="textarea" rows="3" name="deskripsi"><?= old('deskripsi') ? old('deskripsi') : $dataEdit['deskripsi'] ?></textarea>
                                    <p class="text-danger"><?= $validation->getError('deskripsi') ?></p>
                                </div>
                                <div class="mb-3">
                                    <label for="tanggal" class="form-label">Tanggal Kegiatan</label>
                                    <input id="tanggal" type="date" class="form-control" name="tanggal" value="<?= old('tanggal') ? old('tanggal') : $dataEdit['tanggal'] ?>">
                                    <p class="text-danger"> <?= $validation->getError('tanggal') ?></p>
                                </div>

                                <div class="mb-3">
                                    <label for="thumbnail" class="form-label">Thumbnail</label>
                                    <input class="form-control" type="file" id="thumbnail" name="thumbnail">
                                    <p>Pilih beberapa foto untuk thumbnail... (biarkan kosong jika tidak update!!)</p>
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
                                        <th>Judul Kegiatan</th>
                                        <th>Tanggal</th>
                                        <th>Deskripsi & Thumbnail</th>
                                        <th>Galeri</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($listKegiatan as $kegiatan) : ?>
                                        <tr>
                                            <td><?= $kegiatan['judul'] ?></td>
                                            <td><?= $kegiatan['tanggal'] ?></td>
                                            <td><button class="btn btn-outline-info btn-sm" data-bs-toggle="modal" data-bs-target="#modal-<?= $kegiatan['id'] ?>"><i class="fa fa-info"></i></button></td>
                                            <td>
                                                <a class="btn btn-outline-info btn-sm" href="/admin/galeri/<?= $kegiatan['id'] ?>"><i class="fa fa-info"></i></a>

                                            </td>

                                            <td>
                                                <a class="btn btn-outline-warning btn-sm" href="/admin/kegiatan/edit/<?= $kegiatan['id'] ?>"><i class="fa fa-pencil"></i></a>
                                                <form class="d-inline-block" action="/admin/kegiatan/<?= $kegiatan['id'] ?>" method="post">
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
    <?php foreach ($listKegiatan as $kegiatanModal) : ?>
        <div class="modal fade" id="modal-<?= $kegiatanModal['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Thumbnail & Deskripsi</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <h4>Thumbnail</h4>
                            </div>
                            <div class="col-md-12">
                                <img class="img-fluid" src="/upload/galeri/<?= $kegiatanModal['thumbnail'] ?>" alt="<?= $kegiatanModal['thumbnail'] ?>">
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <h4>Deskripsi</h4>
                            </div>
                            <div class="col-md-12">
                                <p><?= $kegiatanModal['deskripsi'] ?></p>
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
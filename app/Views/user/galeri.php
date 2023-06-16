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
        <div class="col-md-12 mb-3">
            <a href="/admin/kegiatan" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>
        </div>
        <!-- forms -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Forms</h5>
                    <form action="/admin/galeri/<?= $idKegiatan ?>" method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="foto" class="form-label">Foto</label>
                            <input class="form-control" type="file" id="foto" name="foto[]" multiple>
                            <p>Pilih beberapa foto sekaligus...</p>
                        </div>
                        <button class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- table -->
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Data</h5>
                    <table id="datatable" class="table borderless">
                        <thead class="text-center">
                            <tr>
                                <th>Foto</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($listGaleri as $galeri) : ?>
                                <tr>
                                    <td><img style="width: 250px;" src="/upload/galeri/<?= $galeri['foto'] ?>" alt="<?= $galeri['foto'] ?>"></td>

                                    <td>

                                        <form action="/admin/galeri/<?= $galeri['idKegiatan'] ?>/<?= $galeri['id'] ?>" method="post">
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
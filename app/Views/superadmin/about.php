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
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="/sa/about/<?= $editAbout['id'] ?>" method="post">
                        <input type="hidden" name="_method" value="PUT">
                        <div class="row">
                            <div class="col-md-6">

                                <div class="mb-3">
                                    <label for="sejarah" class="form-label">Sejarah</label>
                                    <textarea id="textarea" class="form-control" name="sejarah" cols="30" rows="25"><?= $editAbout['sejarah'] ? $editAbout['sejarah'] : old('sejarah') ?></textarea>
                                    <p class="text-danger"><?= $validation->getError('sejarah') ?></p>
                                </div>
                            </div>
                            <div class="col-md-6">

                                <div class="mb-3">
                                    <label for="visi" class="form-label">Visi</label>
                                    <textarea id="textarea1" class="form-control" name="visi" cols="30" rows="10"><?= $editAbout['visi'] ? $editAbout['visi'] : old('visi') ?></textarea>
                                    <p class="text-danger"><?= $validation->getError('visi') ?></p>
                                </div>
                                <div class="mb-3">
                                    <label for="misi" class="form-label">Misi</label>
                                    <textarea id="textarea2" class="form-control" name="misi" cols="30" rows="10"><?= $editAbout['misi'] ? $editAbout['misi'] : old('misi') ?></textarea>
                                    <p class="text-danger"><?= $validation->getError('misi') ?></p>
                                </div>
                            </div>

                            <button class="btn btn-primary btn-sm" type="submit">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- </div> -->

<?= $this->endSection(); ?>
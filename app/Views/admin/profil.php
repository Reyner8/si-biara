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
        <div class="col-md-7">
            <div class="card shadow p-3 mb-5 bg-body rounded">
                <div class="card-body">
                    <form method="post" action="/admin/anggota/profil" class="row g-3">
                        <input type="hidden" name="_method" value="PUT">

                        <div class="col-12 mb-2">
                            <label for="nomorBaju" class="form-label">Nomor Baju</label>
                            <input id="nomorBaju" type="text" class="form-control" value="<?= $profil['nomorBaju'] ?>" disabled>
                        </div>
                        <div class="col-12 mb-2">
                            <label for="nama" class="form-label">Nama Lengkap</label>
                            <input id="nama" type="text" class="form-control" value="<?= $profil['nama'] ?>" name="nama">
                        </div>
                        <div class="col-6 mb-2">
                            <label for="tempatLahir" class="form-label">Tempat Lahir</label>
                            <input id="tempatLahir" type="text" class="form-control" value="<?= $profil['tempatLahir'] ?>" name="tempatLahir">
                        </div>
                        <div class="col-6 mb-2">
                            <label for="tanggalLahir" class="form-label">Tanggal Lahir</label>
                            <input id="tanggalLahir" type="date" class="form-control" value="<?= $profil['tanggalLahir'] ?>" name="tanggalLahir">
                        </div>
                        <div class="col-12 mb-2">
                            <label for="nomorTelepon" class="form-label">Nomor Telepon</label>
                            <input id="nomorTelepon" type="text" class="form-control" value="<?= $profil['nomorTelepon'] ?>" name="nomorTelepon">
                        </div>
                        <div class="col-12 mb-2">
                            <label for="password" class="form-label">Password</label>
                            <input id="password" type="text" class="form-control" name="password">
                            <p>Biarkan kosong jika tidak mengubah...</p>
                        </div>
                        <button class="btn btn-primary btn-sm">Update</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="card shadow p-3 mb-5 bg-body rounded">
                <div class="card-body">
                    <?php if ($profil['foto'] != '') : ?>
                        <img width="200px" src="/upload/profil/<?= $profil['foto'] ?>" alt="foto">
                    <?php else : ?>
                        <img width="200px" src="/upload/profil/default.png" alt="default">
                    <?php endif; ?>
                    <form method="post" action="/admin/anggota/profil/image" enctype="multipart/form-data">
                        <input type="hidden" name="_method" value="PUT">
                        <div class="mb-3">
                            <label for="foto" class="form-label">Foto Profil</label>
                            <input class="form-control" type="file" id="foto" name="foto">
                        </div>
                        <button class="btn btn-primary btn-sm">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>


<?= $this->endSection(); ?>
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
    <div class="row mb-5">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h3>Pelaporan Data</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="row mb-5">
        <div class="col-md-3 mb-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Laporan Data Suster</h5>
                    <form action="/sa/laporan/data/suster" method="post">
                        <div class="mb-2">
                            <label for="dataSuster">Data Suster</label>
                            <select class="form-control" name="status" id="status">
                                <option value="semua">Semua Data</option>
                                <option value="aktif">Aktif</option>
                                <option value="non-aktif">Non Aktif</option>
                                <option value="eksklaustrasi">Eksklaustrasi</option>
                                <option value="meninggal">Meninggal</option>
                            </select>
                        </div>
                        <button class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Laporan Data Master</h5>
                    <form action="/sa/laporan/data/komunitas" method="post">
                        <div class="mb-2">
                            <select class="form-control" name="master" id="status">
                                <option value="komunitas" selected>Komunitas</option>
                                <option value="kerasulan" selected>Kerasulan</option>
                            </select>
                        </div>
                        <button class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Laporan Student & Hasil Belajar</h5>
                    <form action="/sa/laporan/data/belajar" method="post">
                        <div class="mb-2">
                            <select class="form-control" name="status" id="status" disabled>
                                <option value="semua" selected>Semua Data</option>
                            </select>
                        </div>
                        <button class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Laporan Penugasan</h5>
                    <form action="/sa/laporan/data/penugasan" method="post">
                        <div class="mb-2">
                            <select class="form-control" name="idKomunitas" id="status">
                                <?php foreach ($komunitas as $k) : ?>
                                    <option value="<?= $k['id'] ?>"><?= $k['nama'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <button class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Laporan Pembinaan</h5>
                    <form action="/sa/laporan/data/pembinaan" method="post">
                        <div class="mb-2">
                            <select class="form-control" name="idPembinaan" id="status">
                                <?php foreach ($tahapPembinaan as $tp) : ?>
                                    <option value="<?= $tp['id'] ?>"><?= $tp['nama'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <button class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>



<?= $this->endSection(); ?>
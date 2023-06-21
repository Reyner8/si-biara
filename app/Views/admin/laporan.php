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
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Laporan Data Suster</h5>
                    <form action="/admin/laporan/data/suster" method="post">
                        <div class="mb-2">
                            <label for="dataSuster">Data Suster</label>
                            <select class="form-control" name="status" id="status">
                                <!-- <option value="semua">Semua Data</option> -->
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
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Laporan Data Kerasulan</h5>
                    <form action="/admin/laporan/data/komunitas" method="post">
                        <div class="mb-2">
                            <select class="form-control" name="kerasulan" id="status" disabled>
                                <option value="kerasulan" selected>Semua Data</option>
                            </select>
                        </div>
                        <button class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Laporan Kegiatan</h5>
                    <form action="/admin/laporan/data/kegiatan" method="post">
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
        <!-- <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Laporan Pembinaan & Penugasan</h5>
                    <form action="/admin/laporan/data/penunjang" method="post">
                        <div class="mb-2">
                            <select class="form-control" name="penunjang" id="status">
                                <option value="pembinaan" selected>Pembinaan</option>
                                <option value="penugasan">Penugasan</option>
                            </select>
                        </div>
                        <button class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div> -->
    </div>
</div>



<?= $this->endSection(); ?>
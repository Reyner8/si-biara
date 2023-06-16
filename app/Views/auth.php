<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="stylesheet" href="/assets/css/style.css">

    <title><?= $judul ?></title>
</head>

<body>
    <div class="row d-flex justify-content-center align-items-center bg_pattern">
        <div class="col-md-5 my-5">
            <div class="card shadow p-3 bg-body rounded border border-success">
                <div class="card-title text-center mt-4">
                    <img width="100px" src="/upload/logo.png" alt="Logo">
                    <h3>Sign in</h3>


                </div>
                <?php if (session()->getFlashdata('msg')) : ?>
                    <div class="alert alert-danger" role="alert">
                        <?= session()->getFlashdata('msg') ?>
                    </div>
                <?php endif; ?>
                <div class="card-body">
                    <form action="/auth/login" method="POST">
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="nomorBaju" placeholder="No Baju..." value="<?= old('nomorBaju') ?>">
                            <p class="text-danger">
                                <?= $validation->getError('nomorBaju') ?>
                            </p>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password anda...">
                        </div>
                        <p class="text-danger">
                            <?= $validation->getError('password') ?>
                        </p>
                        <hr>
                        <div class="mb-3">
                            <label for="role" class="form-label">Hak Akses</label>
                            <select class="form-control" id="role" name="role">
                                <option value="superuser">Administrator</option>
                                <option value="superadmin">Pemimpin Provinsi</option>
                                <option value="admin">Pemimpin Komunitas</option>
                            </select>
                        </div>
                        <button class="btn btn-primary">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

</html>
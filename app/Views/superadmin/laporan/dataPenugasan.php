<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  <title>Data</title>
  <style>
    table,
    td,
    th {
      border: 1px solid black;
    }

    table {
      border-collapse: collapse;
      width: 100%;
    }
  </style>
</head>


<body>
  <h1 style="text-align: center;"><?= $namaLaporan ?></h1>

  <table class="table table-bordered">
    <tr>
      <th>Nomor Baju</th>
      <th>Nama</th>
      <th>TTL</th>
      <th>Tanggal Penugasan</th>
      <th>Keterangan</th>
      <th>Nomor Telp</th>
      <th>Status</th>
    </tr>
    <?php foreach ($listPenugasan as $penugasan) : ?>
      <tr>
        <td><?= $penugasan['nomorBaju'] ?></td>
        <td><?= $penugasan['nama'] ?></td>
        <td><?= $penugasan['tempatLahir'] . ', ' . $penugasan['tanggalLahir'] ?></td>
        <td><?= $penugasan['tanggalPenugasan'] ?></td>
        <td><?= $penugasan['keterangan'] ?></td>
        <td><?= $penugasan['nomorTelepon'] ?></td>
        <td><?= $penugasan['status'] ?></td>
      </tr>
    <?php endforeach; ?>
  </table>
  <!-- Optional JavaScript; choose one of the two! -->

  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

  <!-- Option 2: Separate Popper and Bootstrap JS -->
  <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
</body>

</html>
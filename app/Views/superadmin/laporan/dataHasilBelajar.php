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

    .bord {
      border-left: none;
      border-right: none;
      border-top: none;
      border-bottom: none;
    }
  </style>
</head>


<body>
  <h1 style="text-align: center;"><?= $namaLaporan ?></h1>

  <table class="table table-bordered color">
    <tr>
      <th>Nomor Baju</th>
      <th>Nama</th>
      <th>TTL</th>
      <th>Nomor Telp</th>
      <th>Status</th>
    </tr>
    <?php foreach ($listAnggota as $anggota) : ?>
      <tr>
        <td><?= $anggota['nomorBaju'] ?></td>
        <td><?= $anggota['nama'] ?></td>
        <td><?= $anggota['tempatLahir'] . ', ' . $anggota['tanggalLahir'] ?></td>
        <td><?= $anggota['nomorTelepon'] ?></td>
        <td><?= $anggota['status'] ?></td>
      </tr>
      <?php foreach ($listHasilBelajar as $hasil) : ?>
        <?php if ($hasil['idAnggota'] == $anggota['id']) : ?>
          <tr>
            <td></td>
            <td colspan="4" style="border-style: none;">
              <table>
                <tr>
                  <th>Universitas</th>
                  <th>Fakultas</th>
                  <th>Prodi</th>
                  <th>Jenjang</th>
                  <th>Semester</th>
                  <th>Keterangan</th>
                </tr>
                <tr>
                  <td><?= $hasil['universitas'] ?></td>
                  <td><?= $hasil['fakultas'] ?></td>
                  <td><?= $hasil['prodi'] ?></td>
                  <td><?= $hasil['jenjang'] ?></td>
                  <td><?= $hasil['semester'] ?></td>
                  <td><?= $hasil['keterangan'] ?></td>
                </tr>
              </table>
            </td>
          </tr>
        <?php endif; ?>
      <?php endforeach; ?>
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
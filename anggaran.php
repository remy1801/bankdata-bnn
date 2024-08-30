<?php
$host       = "localhost";
$user       = "root";
$pass       = "";
$db         = "bnnn";

$koneksi    = mysqli_connect($host, $user, $pass, $db);
if (!$koneksi) { //cek koneksi
    die("Tidak bisa terkoneksi ke database");
}
$kegiatan     = "";
$volume       = "";
$pagu         = "";
$realisasi    = "";
$sisa         = "";
$keterangan   = "";
$sukses       = "";
$error        = "";

if (isset($_GET['op'])) {
    $op = $_GET['op'];
} else {
    $op = "";
}

if ($op == 'delete') {
    $id     = $_GET['id'];
    $sql1   = "delete from anggaran where id = '$id'";
    $q1     = mysqli_query($koneksi, $sql1); {
        if ($q1) {
            $sukses = "Berhasil hapus data";
        } else {
            $error = "Gagal melakukan delete data";
        }
    }
}

if ($op == 'edit') {
    $id         = $_GET['id'];
    $sql1       = "select * from anggaran where id = '$id'";
    $q1         = mysqli_query($koneksi, $sql1);
    $r1         = mysqli_fetch_array($q1);
    $kegiatan   = $r1['kegiatan'];
    $volume     = $r1['volume'];
    $pagu       = $r1['pagu'];
    $realisasi  = $r1['realisasi'];
    $sisa       = $r1['sisa'];
    $keterangan = $r1['keterangan'];

    if ($kegiatan == '') {
        $error = "Data tidak ditemukan";
    }
}

if (isset($_POST['simpan'])) { //untuk create
    $kegiatan       = $_POST['kegiatan'];
    $volume         = $_POST['volume'];
    $pagu           = $_POST['pagu'];
    $realisasi      = $_POST['realisasi'];
    $sisa           = $_POST['sisa'];
    $keterangan     = $_POST['keterangan'];

    if ($kegiatan && $volume && $pagu && $realisasi && $sisa && $keterangan) {
        if ($op == 'edit') { //untuk update
            $sql1 = "update anggaran set kegiatan='$kegiatan',volume='$volume',pagu='$pagu',realisasi='$realisasi', sisa='$sisa', keterangan='$keterangan' where id='$id'";
            $q1   = mysqli_query($koneksi, $sql1);
            if ($q1) {
                $sukses = "Data berhasil diupdate";
            } else {
                $error  = "Data gagal diupdate";
            }
        } else { //untuk insert
            $sql1 = "insert into anggaran(kegiatan,volume,pagu,realisasi,sisa,keterangan) values ('$kegiatan','$volume','$pagu','$realisasi','$sisa','$keterangan')";
            $q1   = mysqli_query($koneksi, $sql1);
            if ($q1) {
                $sukses = "Berhasil memasukkan data baru";
            } else {
                $error  = "Gagal memasukkan data";
            }
        }
    } else {
        $error = "Silahkan masukkan semua data";
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anggaran</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!--<title> Drop Down Sidebar Menu | CodingLab </title>-->
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- Fontawesome CDN Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- Boxiocns CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <style>
        .mx-auto {
            width: 1000px
        }
        .card {
            margin-top: 20px
        }
    </style>
</head>

<body data-open="click">
  <?php require_once 'sidebar.php' ?>

  <div class="sidenav-overlay"></div>
  <div class="drag-target"></div>
    <div class="mx-auto">
    <div class="card">
            <div class="card-header">
                -
            </div>

        <!--untuk memasukkan data-->
        <div class="card">
            <div class="card-header">
                Anggaran
            </div>
            <div class="card-body">

                <?php
                if ($error) {
                ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $error ?>
                    </div>
                <?php

                }
                ?>

                <?php
                if ($sukses) {
                ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo $sukses ?>
                    </div>
                <?php

                }
                ?>

                <form action="" method="POST">
                    <div class="mb-3 row">
                        <label for="kegiatan" class="form-label">Kegiatan</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="kegiatan" name="kegiatan" value="<?php echo $kegiatan ?>">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="volume" class="form-label">Volume</label>
                        <div class="col-sm-10">
                            <input type="year" class="form-control" id="volume" name="volume" value="<?php echo $volume ?>">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="pagu" class="form-label">Pagu</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="pagu" name="pagu" value="<?php echo $pagu ?>">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="realisasi" class="form-label">Realisasi</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="realisasi" name="realisasi" value="<?php echo $realisasi ?>">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="sisa" class="form-label">Sisa Anggaran</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="sisa" name="sisa" value="<?php echo $sisa ?>">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="keterangan" class="form-label">Keterangan</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="keterangan" name="keterangan" value="<?php echo $keterangan ?>">
                        </div>
                    </div>
                    <div class="col-12">
                        <input type="submit" name="simpan" value="Simpan Data" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>

        <!--untuk mengeluarkan data-->
        <div class="card">
            <div class="card-header text-white bg-secondary">
                Anggaran BNN Kota Banda Aceh
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Kegiatan</th>
                            <th scope="col">Volume</th>
                            <th scope="col">Pagu</th>
                            <th scope="col">Realisasi</th>
                            <th scope="col">Sisa Anggaran</th>
                            <th scope="col">Keterangan</th>
                            <th scope="col">Aksi</th>
                        </tr>

                    <tbody>
                        <?php
                        $sql2   = "select * from anggaran order by id desc";
                        $q2     = mysqli_query($koneksi, $sql2);
                        $urut   = 1;
                        while ($r2 = mysqli_fetch_array($q2)) {
                            $id         = $r2['id'];
                            $kegiatan   = $r2['kegiatan'];
                            $volume     = $r2['volume'];
                            $pagu       = $r2['pagu'];
                            $realisasi  = $r2['realisasi'];
                            $sisa       = $r2['sisa'];
                            $keterangan = $r2['keterangan'];

                        ?>
                            <tr>
                                <th scope="row"><?php echo $urut++ ?></th>
                                <td scope="row"><?php echo $kegiatan ?></td>
                                <td scope="row"><?php echo $volume ?></td>
                                <td scope="row"><?php echo $pagu ?></td>
                                <td scope="row"><?php echo $realisasi ?></td>
                                <td scope="row"><?php echo $sisa ?></td>
                                <td scope="row"><?php echo $keterangan ?></td>
                                <td scope="row">
                                    <a href="anggaran.php?op=edit&id=<?php echo $id ?>"><button type="button" class="btn btn-warning">Edit</button></a>
                                    <a href="anggaran.php?op=delete&id=<?php echo $id ?>" onclick="return confirm('Yakin mau delete data?')"><button type="button" class="btn btn-danger">Delete</button></a>


                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                    </thead>
                </table>
            </div>
            <div class="card">
            <div class="card-header">
                <h1>-</h1>
            </div>
        </div>
        <?php require_once 'footer.php'; ?>
        </div>
    </div>
</body>

</html>
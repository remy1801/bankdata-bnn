<?php
$host       = "localhost";
$user       = "root";
$pass       = "";
$db         = "bnnn";

$koneksi    = mysqli_connect($host, $user, $pass, $db);
if (!$koneksi) { //cek koneksi
    die("Tidak bisa terkoneksi ke database");
}
$target       = "";
$tahun        = "";
$terlaksana   = "";
$capaian      = "";
$persen       = "";
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
    $sql1   = "delete from capaian_program where id = '$id'";
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
    $sql1       = "select * from capaian_program where id = '$id'";
    $q1         = mysqli_query($koneksi, $sql1);
    $r1         = mysqli_fetch_array($q1);
    $target     = $r1['target'];
    $tahun      = $r1['tahun'];
    $terlaksana = $r1['terlaksana'];
    $capaian    = $r1['capaian'];
    $persen     = $r1['persen'];
    $keterangan = $r1['keterangan'];

    if ($target == '') {
        $error = "Data tidak ditemukan";
    }
}

if (isset($_POST['simpan'])) { //untuk create
    $target       = $_POST['target'];
    $tahun        = $_POST['tahun'];
    $terlaksana   = $_POST['terlaksana'];
    $capaian      = $_POST['capaian'];
    $persen       = $_POST['persen'];
    $keterangan   = $_POST['keterangan'];

    if ($target && $tahun && $terlaksana && $capaian && $persen && $keterangan) {
        if ($op == 'edit') { //untuk update
            $sql1 = "update capaian_program set target='$target',tahun='$tahun',terlaksana='$terlaksana',capaian='$capaian', persen='$persen', keterangan='$keterangan' where id='$id'";
            $q1   = mysqli_query($koneksi, $sql1);
            if ($q1) {
                $sukses = "Data berhasil diupdate";
            } else {
                $error  = "Data gagal diupdate";
            }
        } else { //untuk insert
            $sql1 = "insert into capaian_program(target,tahun,terlaksana,capaian,persen,keterangan) values ('$target','$tahun','$terlaksana','$capaian','$persen','$keterangan')";
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
    <title>Capaian Program</title>
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
                Capaian Program
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
                        <label for="target" class="form-label">Target</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="target" name="target" value="<?php echo $target ?>">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="tahun" class="form-label">Tahun</label>
                        <div class="col-sm-10">
                            <input type="year" class="form-control" id="tahun" name="tahun" value="<?php echo $tahun ?>">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="terlaksana" class="form-label">Terlaksana</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="terlaksana" name="terlaksana" value="<?php echo $terlaksana ?>">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="capaian" class="form-label">Capaian</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="capaian" name="capaian" value="<?php echo $capaian ?>">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="persen" class="form-label">%</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="persen" name="persen" value="<?php echo $persen ?>">
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
                Capaian Program BNN Kota Banda Aceh
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Target</th>
                            <th scope="col">Tahun</th>
                            <th scope="col">Terlaksana</th>
                            <th scope="col">Capaian</th>
                            <th scope="col">%</th>
                            <th scope="col">Keterangan</th>
                            <th scope="col">Aksi</th>
                        </tr>

                    <tbody>
                        <?php
                        $sql2   = "select * from capaian_program order by id desc";
                        $q2     = mysqli_query($koneksi, $sql2);
                        $urut   = 1;
                        while ($r2 = mysqli_fetch_array($q2)) {
                            $id         = $r2['id'];
                            $target     = $r2['target'];
                            $tahun      = $r2['tahun'];
                            $terlaksana = $r2['terlaksana'];
                            $capaian    = $r2['capaian'];
                            $persen     = $r2['persen'];
                            $keterangan = $r2['keterangan'];

                        ?>
                            <tr>
                                <th scope="row"><?php echo $urut++ ?></th>
                                <td scope="row"><?php echo $target ?></td>
                                <td scope="row"><?php echo $tahun ?></td>
                                <td scope="row"><?php echo $terlaksana ?></td>
                                <td scope="row"><?php echo $capaian ?></td>
                                <td scope="row"><?php echo $persen ?></td>
                                <td scope="row"><?php echo $keterangan ?></td>
                                <td scope="row">
                                    <a href="capaian_program.php?op=edit&id=<?php echo $id ?>"><button type="button" class="btn btn-warning">Edit</button></a>
                                    <a href="capaian_program.php?op=delete&id=<?php echo $id ?>" onclick="return confirm('Yakin mau delete data?')"><button type="button" class="btn btn-danger">Delete</button></a>


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
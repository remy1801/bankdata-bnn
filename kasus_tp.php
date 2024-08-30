<?php
$host       = "localhost";
$user       = "root";
$pass       = "";
$db         = "bnnn";

$koneksi    = mysqli_connect($host, $user, $pass, $db);
if (!$koneksi) { //cek koneksi
    die("Tidak bisa terkoneksi ke database");
}
$inisial            = "";
$alamat             = "";
$jenis_kelamin      = "";
$umur               = "";
$bb                 = "";
$tuntutan           = "";
$bb_narkotika       = "";
$bb_non_narkotika   = "";
$keterangan         = "";
$sukses             = "";
$error              = "";

if (isset($_GET['op'])) {
    $op = $_GET['op'];
} else {
    $op = "";
}

if ($op == 'delete') {
    $id     = $_GET['id'];
    $sql1   = "delete from kasus_tp where id = '$id'";
    $q1     = mysqli_query($koneksi, $sql1); {
        if ($q1) {
            $sukses = "Berhasil hapus data";
        } else {
            $error = "Gagal melakukan delete data";
        }
    }
}

if ($op == 'edit') {
    $id                 = $_GET['id'];
    $sql1               = "select * from kasus_tp where id    = '$id'";
    $q1                 = mysqli_query($koneksi, $sql1);
    $r1                 = mysqli_fetch_array($q1);
    $inisial            = $r1['inisial'];
    $alamat             = $r1['alamat'];
    $jenis_kelamin      = $r1['jenis_kelamin'];
    $umur               = $r1['umur'];
    $bb                 = $r1['bb'];
    $tuntutan           = $r1['tuntutan'];
    $bb_narkotika       = $r1['bb_narkotika'];
    $bb_non_narkotika   = $r1['bb_non_narkotika'];
    $keterangan         = $r1['keterangan'];

    if ($inisial == '') {
        $error = "Data tidak ditemukan";
    }
}

if (isset($_POST['simpan'])) { //untuk create
    $inisial                = $_POST['inisial'];
    $alamat                 = $_POST['alamat'];
    $jenis_kelamin          = $_POST['jenis_kelamin'];
    $umur                   = $_POST['umur'];
    $bb                     = $_POST['bb'];
    $tuntutan               = $_POST['tuntutan'];
    $bb_narkotika           = $_POST['bb_narkotika'];
    $bb_non_narkotika       = $_POST['bb_non_narkotika'];
    $keterangan             = $_POST['keterangan'];

    if ($inisial && $alamat && $jenis_kelamin && $umur && $bb && $tuntutan && $bb_narkotika && $bb_non_narkotika && $keterangan) {
        if ($op == 'edit') { //untuk update
            $sql1 = "update kasus_tp set inisial='$inisial', alamat='$alamat', jenis_kelamin='$jenis_kelamin', umur='$umur', bb='$bb',tuntutan='$tuntutan',bb_narkotika='$bb_narkotika', bb_non_narkotika='$bb_non_narkotika', keterangan='$keterangan' where id='$id'";
            $q1   = mysqli_query($koneksi, $sql1);
            if ($q1) {
                $sukses = "Data berhasil diupdate";
            } else {
                $error  = "Data gagal diupdate";
            }
        } else { //untuk insert
            $sql1 = "insert into kasus_tp(inisial,alamat,jenis_kelamin,umur,bb,tuntutan,bb_narkotika,bb_non_narkotika,keterangan) values ('$inisial','$alamat','$jenis_kelamin','$umur','$bb','$tuntutan','$bb_narkotika', '$bb_non_narkotika', '$keterangan')";
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
    <title>Kasus</title>
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
            margin-top: 10px
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
            Pengungkapan Kasus TP Narkotika BNN Kota Banda Aceh
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
                        <label for="inisial" class="form-label">Inisial TSK</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="inisial" name="inisial" value="<?php echo $inisial ?>">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="alamat" class="form-label">Alamat</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="alamat" name="alamat" value="<?php echo $alamat ?>">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="jenis_kelamin" name="jenis_kelamin" value="<?php echo $jenis_kelamin ?>">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="umur" class="form-label">Umur/Usia</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="umur" name="umur" value="<?php echo $umur ?>">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="bb" class="form-label">BB (ons)</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="bb" name="bb" value="<?php echo $bb ?>">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="tuntutan" class="form-label">Tuntutan</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="tuntutan" name="tuntutan" value="<?php echo $tuntutan ?>">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="bb_narkotika" class="form-label">BB Narkotika</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="bb_narkotika" name="bb_narkotika" value="<?php echo $bb_narkotika ?>">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="bb_non_narkotika" class="form-label">BB Non Narkotika</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="bb_non_narkotika" name="bb_non_narkotika" value="<?php echo $bb_non_narkotika ?>">
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
                Data Pengungkapan Kasus TP Narkotika BNN Kota Banda Aceh
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Inisial TSK</th>
                            <th scope="col">Alamat</th>
                            <th scope="col">Jenis Kelamin</th>
                            <th scope="col">Umur/Usia</th>
                            <th scope="col">BB (Ons)</th>
                            <th scope="col">Tuntutan</th>
                            <th scope="col">BB Narkotika</th>
                            <th scope="col">BB Non Narkotika</th>
                            <th scope="col">Keterangan</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    <tbody>
                        <?php
                        $sql2   = "select * from kasus_tp order by id desc";
                        $q2     = mysqli_query($koneksi, $sql2);
                        $urut   = 1;
                        while ($r2 = mysqli_fetch_array($q2)) {
                            $id                     = $r2['id'];
                            $inisial                = $r2['inisial'];
                            $alamat                 = $r2['alamat'];
                            $jenis_kelamin          = $r2['jenis_kelamin'];
                            $umur                   = $r2['umur'];
                            $bb                     = $r2['bb'];
                            $tuntutan               = $r2['tuntutan'];
                            $bb_narkotika           = $r2['bb_narkotika'];
                            $bb_non_narkotika       = $r2['bb_non_narkotika'];
                            $keterangan             = $r2['keterangan'];

                        ?>
                            <tr>
                                <th scope="row"><?php echo $urut++ ?></th>
                                <td scope="row"><?php echo $inisial ?></td>
                                <td scope="row"><?php echo $alamat ?></td>
                                <td scope="row"><?php echo $jenis_kelamin ?></td>
                                <td scope="row"><?php echo $umur ?></td>
                                <td scope="row"><?php echo $bb ?></td>
                                <td scope="row"><?php echo $tuntutan ?></td>
                                <td scope="row"><?php echo $bb_narkotika ?></td>
                                <td scope="row"><?php echo $bb_non_narkotika ?></td>
                                <td scope="row"><?php echo $keterangan ?></td>
                                <td scope="row">
                                    <a href="kasus_tp.php?op=edit&id=<?php echo $id ?>"><button type="button" class="btn btn-warning">Edit</button></a>
                                    <a href="kasus_tp.php?op=delete&id=<?php echo $id ?>" onclick="return confirm('Yakin mau delete data?')"><button type="button" class="btn btn-danger">Delete</button></a>


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
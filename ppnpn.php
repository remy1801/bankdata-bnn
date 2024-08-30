<?php
$host       = "localhost";
$user       = "root";
$pass       = "";
$db         = "bnnn";

$koneksi    = mysqli_connect($host, $user, $pass, $db);
if (!$koneksi) { //cek koneksi
    die("Tidak bisa terkoneksi ke database");
}
$nama       = "";
$jabatan    = "";
$penempatan = "";
$tmt        = "";
$lama_kerja = "";
$ppnpn      = "";
$sukses     = "";
$error      = "";

if (isset($_GET['op'])) {
    $op = $_GET['op'];
} else {
    $op = "";
}

if ($op == 'delete') {
    $id     = $_GET['id'];
    $sql1   = "delete from ppnpn where id = '$id'";
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
    $sql1       = "select * from ppnpn where id = '$id'";
    $q1         = mysqli_query($koneksi, $sql1);
    $r1         = mysqli_fetch_array($q1);
    $nama       = $r1['nama'];
    $jabatan    = $r1['jabatan'];
    $penempatan = $r1['penempatan'];
    $tmt        = $r1['tmt'];
    $lama_kerja = $r1['lama_kerja'];
    $ppnpn      = $r1['ppnpn'];

    if ($nama == '') {
        $error = "Data tidak ditemukan";
    }
}

if (isset($_POST['simpan'])) { //untuk create
    $nama       = $_POST['nama'];
    $jabatan    = $_POST['jabatan'];
    $penempatan = $_POST['penempatan'];
    $tmt        = $_POST['tmt'];
    $lama_kerja = $_POST['lama_kerja'];
    $ppnpn      = $_POST['ppnpn'];

    if ($nama && $jabatan && $penempatan && $tmt && $lama_kerja && $ppnpn) {
        if ($op == 'edit') { //untuk update
            $sql1 = "update ppnpn set nama='$nama',jabatan='$jabatan',penempatan='$penempatan',tmt='$tmt', lama_kerja='$lama_kerja', ppnpn='$ppnpn' where id='$id'";
            $q1   = mysqli_query($koneksi, $sql1);
            if ($q1) {
                $sukses = "Data berhasil diupdate";
            } else {
                $error  = "Data gagal diupdate";
            }
        } else { //untuk insert
            $sql1 = "insert into ppnpn(nama,jabatan,penempatan,tmt,lama_kerja,ppnpn) values ('$nama','$jabatan','$penempatan','$tmt','$lama_kerja','$ppnpn')";
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
    <title>PPNPN</title>
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
                PPNPN
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
                        <label for="nama" class="form-label">Nama</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $nama ?>">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="jabatan" class="form-label">Jabatan</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="jabatan" name="jabatan" value="<?php echo $jabatan ?>">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="penempatan" class="form-label">Penempatan</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="penempatan" name="penempatan" value="<?php echo $penempatan ?>">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="tmt" class="form-label">TMT</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="tmt" name="tmt" value="<?php echo $tmt ?>">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="lama_kerja" class="form-label">Lama Kerja</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="lama_kerja" name="lama_kerja" value="<?php echo $lama_kerja ?>">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="ppnpn" class="form-label">PPNPN</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="ppnpn" name="ppnpn" value="<?php echo $ppnpn ?>">
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
                Daftar Nama PPNPN BNN Kota Banda Aceh
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Jabatan</th>
                            <th scope="col">Penempatan</th>
                            <th scope="col">TMT</th>
                            <th scope="col">Lama Kerja</th>
                            <th scope="col">PPNPN</th>
                            <th scope="col">Aksi</th>
                        </tr>

                    <tbody>
                        <?php
                        $sql2   = "select * from ppnpn order by id desc";
                        $q2     = mysqli_query($koneksi, $sql2);
                        $urut   = 1;
                        while ($r2 = mysqli_fetch_array($q2)) {
                            $id         = $r2['id'];
                            $nama       = $r2['nama'];
                            $jabatan    = $r2['jabatan'];
                            $penempatan = $r2['penempatan'];
                            $tmt        = $r2['tmt'];
                            $lama_kerja = $r2['lama_kerja'];
                            $ppnpn      = $r2['ppnpn'];

                        ?>
                            <tr>
                                <th scope="row"><?php echo $urut++ ?></th>
                                <td scope="row"><?php echo $nama ?></td>
                                <td scope="row"><?php echo $jabatan ?></td>
                                <td scope="row"><?php echo $penempatan ?></td>
                                <td scope="row"><?php echo $tmt ?></td>
                                <td scope="row"><?php echo $lama_kerja ?></td>
                                <td scope="row"><?php echo $ppnpn ?></td>
                                <td scope="row">
                                    <a href="ppnpn.php?op=edit&id=<?php echo $id ?>"><button type="button" class="btn btn-warning">Edit</button></a>
                                    <a href="ppnpn.php?op=delete&id=<?php echo $id ?>" onclick="return confirm('Yakin mau delete data?')"><button type="button" class="btn btn-danger">Delete</button></a>


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
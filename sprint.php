<?php
$host       = "localhost";
$user       = "root";
$pass       = "";
$db         = "bnnn";

$koneksi    = mysqli_connect($host, $user, $pass, $db);
if (!$koneksi) { //cek koneksi
    die("Tidak bisa terkoneksi ke database");
}
$tanggal_terima  = "";
$nomor           = "";
$sifat           = "";
$jenis           = "";
$isi             = "";
$dari            = "";
$kepada          = "";
$keterangan      = "";
$sukses          = "";
$error           = "";

if (isset($_GET['op'])) {
    $op = $_GET['op'];
} else {
    $op = "";
}

if ($op == 'delete') {
    $id     = $_GET['id'];
    $sql1   = "delete from sprint where id = '$id'";
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
    $sql1               = "select * from sprint where id    = '$id'";
    $q1                 = mysqli_query($koneksi, $sql1);
    $r1                 = mysqli_fetch_array($q1);
    $tanggal_terima     = $r1['tanggal_terima'];
    $nomor              = $r1['nomor'];
    $sifat              = $r1['sifat'];
    $jenis              = $r1['jenis'];
    $isi                = $r1['isi'];
    $dari               = $r1['dari'];
    $kepada             = $r1['kepada'];
    $keterangan         = $r1['keterangan'];

    if ($tanggal_terima == '') {
        $error = "Data tidak ditemukan";
    }
}

if (isset($_POST['simpan'])) { //untuk create
    $tanggal_terima = $_POST['tanggal_terima'];
    $nomor          = $_POST['nomor'];
    $sifat          = $_POST['sifat'];
    $jenis          = $_POST['jenis'];
    $isi            = $_POST['isi'];
    $dari           = $_POST['dari'];
    $kepada         = $_POST['kepada'];
    $keterangan      = $_POST['keterangan'];

    if ($tanggal_terima && $nomor && $sifat && $jenis && $isi && $dari && $kepada && $keterangan) {
        if ($op == 'edit') { //untuk update
            $sql1 = "update sprint set tanggal_terima='$tanggal_terima', nomor='$nomor', sifat='$sifat', jenis='$jenis',isi='$isi',dari='$dari', kepada='$kepada', keterangan='$keterangan' where id='$id'";
            $q1   = mysqli_query($koneksi, $sql1);
            if ($q1) {
                $sukses = "Data berhasil diupdate";
            } else {
                $error  = "Data gagal diupdate";
            }
        } else { //untuk insert
            $sql1 = "insert into sprint(tanggal_terima,nomor,sifat,jenis,isi,dari,kepada,keterangan) values ('$tanggal_terima','$nomor', '$sifat','$jenis','$isi','$dari', '$kepada', '$keterangan')";
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
    <title>Sprint</title>
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
                Sprint
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
                        <label for="tanggal_terima" class="form-label">Tanggal Penerimaan Surat</label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control" id="tanggal_terima" name="tanggal_terima" value="<?php echo $tanggal_terima ?>">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="nomor" class="form-label">Nomor Surat</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nomor" name="nomor" value="<?php echo $nomor ?>">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="sifat" class="form-label">Sifat Surat</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="sifat" name="sifat" value="<?php echo $sifat ?>">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="jenis" class="form-label">Jenis Surat</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="jenis" name="jenis" value="<?php echo $jenis ?>">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="isi" class="form-label">Isi Ringkas</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="isi" name="isi" value="<?php echo $isi ?>">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="dari" class="form-label">Dari</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="dari" name="dari" value="<?php echo $dari ?>">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="kepada" class="form-label">Kepada</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="kepada" name="kepada" value="<?php echo $kepada ?>">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="keterangan" class="form-label">keterangan</label>
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
                Surat Keluar BNN Kota Banda Aceh
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Tanggal Penerimaan Surat</th>
                            <th scope="col">Nomor Surat</th>
                            <th scope="col">Sifat Surat</th>
                            <th scope="col">Jenis Surat</th>
                            <th scope="col">Isi Ringkas</th>
                            <th scope="col">Dari</th>
                            <th scope="col">Kepada</th>
                            <th scope="col">keterangan</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    <tbody>
                        <?php
                        $sql2   = "select * from sprint order by id desc";
                        $q2     = mysqli_query($koneksi, $sql2);
                        $urut   = 1;
                        while ($r2 = mysqli_fetch_array($q2)) {
                            $id                 = $r2['id'];
                            $tanggal_terima     = $r2['tanggal_terima'];
                            $nomor              = $r2['nomor'];
                            $sifat              = $r2['sifat'];
                            $jenis              = $r2['jenis'];
                            $isi                = $r2['isi'];
                            $dari               = $r2['dari'];
                            $kepada             = $r2['kepada'];
                            $keterangan         = $r2['keterangan'];

                        ?>
                            <tr>
                                <th scope="row"><?php echo $urut++ ?></th>
                                <td scope="row"><?php echo $tanggal_terima ?></td>
                                <td scope="row"><?php echo $nomor ?></td>
                                <td scope="row"><?php echo $sifat ?></td>
                                <td scope="row"><?php echo $jenis ?></td>
                                <td scope="row"><?php echo $isi ?></td>
                                <td scope="row"><?php echo $dari ?></td>
                                <td scope="row"><?php echo $kepada ?></td>
                                <td scope="row"><?php echo $keterangan ?></td>
                                <td scope="row">
                                    <a href="sprint.php?op=edit&id=<?php echo $id ?>"><button type="button" class="btn btn-warning">Edit</button></a>
                                    <a href="sprint.php?op=delete&id=<?php echo $id ?>" onclick="return confirm('Yakin mau delete data?')"><button type="button" class="btn btn-danger">Delete</button></a>


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
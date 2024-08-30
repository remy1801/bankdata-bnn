<?php
$host       = "localhost";
$user       = "root";
$pass       = "";
$db         = "bnnn";

$koneksi    = mysqli_connect($host, $user, $pass, $db);
if (!$koneksi) { //cek koneksi
    die("Tidak bisa terkoneksi ke database");
}
$nama               = "";
$jenis_kelamin      = "";
$tempat             = "";
$tanggal            = "";
$nip                = "";
$jabatan            = "";
$pangkat            = "";
$golongan           = "";
$status             = "";
$kenaikan_pangkat   = "";
$alamat             = "";
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
    $sql1   = "delete from biodata where id = '$id'";
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
    $sql1               = "select * from biodata where id    = '$id'";
    $q1                 = mysqli_query($koneksi, $sql1);
    $r1                 = mysqli_fetch_array($q1);
    $nama               = $r1['nama'];
    $jenis_kelamin      = $r1['jenis_kelamin'];
    $tempat             = $r1['tempat'];
    $tanggal            = $r1['tanggal'];
    $nip                = $r1['nip'];
    $jabatan            = $r1['jabatan'];
    $pangkat            = $r1['pangkat'];
    $golongan           = $r1['golongan'];
    $status             = $r1['status'];
    $kenaikan_pangkat   = $r1['kenaikan_pangkat'];
    $alamat             = $r1['alamat'];
    $keterangan         = $r1['keterangan'];

    if ($nama == '') {
        $error = "Data tidak ditemukan";
    }
}

if (isset($_POST['simpan'])) { //untuk create
    $nama               = $_POST['nama'];
    $jenis_kelamin      = $_POST['jenis_kelamin'];
    $tempat             = $_POST['tempat'];
    $tanggal            = $_POST['tanggal'];
    $nip                = $_POST['nip'];
    $jabatan            = $_POST['jabatan'];
    $pangkat            = $_POST['pangkat'];
    $golongan           = $_POST['golongan'];
    $status             = $_POST['status'];
    $kenaikan_pangkat   = $_POST['kenaikan_pangkat'];
    $alamat             = $_POST['alamat'];
    $keterangan         = $_POST['keterangan'];

    if ($nama && $jenis_kelamin && $tempat && $tanggal && $nip && $jabatan && $pangkat && $golongan && $status  && $kenaikan_pangkat && $alamat && $keterangan) {
        if ($op == 'edit') { //untuk update
            $sql1 = "update biodata set nama='$nama', jenis_kelamin='$jenis_kelamin', tempat='$tempat', tanggal='$tanggal', nip='$nip',jabatan='$jabatan',pangkat='$pangkat', golongan='$golongan', status='$status', kenaikan_pangkat='$kenaikan_pangkat', alamat='$alamat', keterangan='$keterangan' where id='$id'";
            $q1   = mysqli_query($koneksi, $sql1);
            if ($q1) {
                $sukses = "Data berhasil diupdate";
            } else {
                $error  = "Data gagal diupdate";
            }
        } else { //untuk insert
            $sql1 = "insert into biodata(nama,jenis_kelamin,tempat,tanggal,nip,jabatan,pangkat,golongan,status,kenaikan_pangkat,alamat,keterangan) values ('$nama','$jenis_kelamin', '$tempat', '$tanggal','$nip','$jabatan','$pangkat', '$golongan', '$status', '$kenaikan_pangkat', '$alamat', '$keterangan')";
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
    <title>Biodata</title>
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
                Biodata Pegawai
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
                        <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="jenis_kelamin" name="jenis_kelamin" value="<?php echo $jenis_kelamin ?>">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="tempat" class="form-label">Tempat Lahir</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="tempat" name="tempat" value="<?php echo $tempat ?>">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="tanggal" class="form-label">Tanggal Lahir</label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control" id="tanggal" name="tanggal" value="<?php echo $tanggal ?>">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="nip" class="form-label">NIP/NRP</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nip" name="nip" value="<?php echo $nip ?>">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="jabatan" class="form-label">Jabatan</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="jabatan" name="jabatan" value="<?php echo $jabatan ?>">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="pangkat" class="form-label">Pangkat</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="pangkat" name="pangkat" value="<?php echo $pangkat ?>">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="golongan" class="form-label">Golongan</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="golongan" name="golongan" value="<?php echo $golongan ?>">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="status" class="form-label">Status</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="status" name="status" value="<?php echo $status ?>">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="kenaikan_pangkat" class="form-label"> Kenaikan Pangkat Selanjutnya</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="kenaikan_pangkat" name="kenaikan_pangkat" value="<?php echo $kenaikan_pangkat ?>">
                        </div>
                    </div>


                    <div class="mb-3 row">
                        <label for="alamat" class="form-label">Alamat</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="alamat" name="alamat" value="<?php echo $alamat ?>">
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
                Biodata Personel BNN Kota Banda Aceh
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Jenis Kelamin</th>
                            <th scope="col">Tempat Lahir</th>
                            <th scope="col">Tanggal Lahir</th>
                            <th scope="col">NIP/NRP</th>
                            <th scope="col">Jabatan</th>
                            <th scope="col">Pangkat</th>
                            <th scope="col">Golongan</th>
                            <th scope="col">Status</th>
                            <th scope="col">Kenaikan Pangkat Selanjutnya</th>
                            <th scope="col">Alamat</th>
                            <th scope="col">Keterangan</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    <tbody>
                        <?php
                        $sql2   = "select * from biodata order by id desc";
                        $q2     = mysqli_query($koneksi, $sql2);
                        $urut   = 1;
                        while ($r2 = mysqli_fetch_array($q2)) {
                            $id                 = $r2['id'];
                            $nama               = $r2['nama'];
                            $jenis_kelamin      = $r2['jenis_kelamin'];
                            $tempat             = $r2['tempat'];
                            $tanggal            = $r2['tanggal'];
                            $nip                = $r2['nip'];
                            $jabatan            = $r2['jabatan'];
                            $pangkat            = $r2['pangkat'];
                            $golongan           = $r2['golongan'];
                            $status             = $r2['status'];
                            $kenaikan_pangkat   = $r2['kenaikan_pangkat'];
                            $alamat             = $r2['alamat'];
                            $keterangan         = $r2['keterangan'];

                        ?>
                            <tr>
                                <th scope="row"><?php echo $urut++ ?></th>
                                <td scope="row"><?php echo $nama ?></td>
                                <td scope="row"><?php echo $jenis_kelamin ?></td>
                                <td scope="row"><?php echo $tempat ?></td>
                                <td scope="row"><?php echo $tanggal ?></td>
                                <td scope="row"><?php echo $nip ?></td>
                                <td scope="row"><?php echo $jabatan ?></td>
                                <td scope="row"><?php echo $pangkat ?></td>
                                <td scope="row"><?php echo $golongan ?></td>
                                <td scope="row"><?php echo $status ?></td>
                                <td scope="row"><?php echo $kenaikan_pangkat ?></td>
                                <td scope="row"><?php echo $alamat ?></td>
                                <td scope="row"><?php echo $keterangan ?></td>
                                <td scope="row">
                                    <a href="biodata.php?op=edit&id=<?php echo $id ?>"><button type="button" class="btn btn-warning">Edit</button></a>
                                    <a href="biodata.php?op=delete&id=<?php echo $id ?>" onclick="return confirm('Yakin mau delete data?')"><button type="button" class="btn btn-danger">Delete</button></a>


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
<?php
$host       = "localhost";
$user       = "root";
$pass       = "";
$db         = "bnnn";

$koneksi    = mysqli_connect($host, $user, $pass, $db);
if (!$koneksi) { //cek koneksi
    die("Tidak bisa terkoneksi ke database");
}
$tahun      = "";
$periode    = "";
$semester   = "";
$nilai      = "";
$mutu       = "";
$kinerja    = "";
$keterangan = "";
$sukses     = "";
$error      = "";

if (isset($_GET['op'])) {
    $op = $_GET['op'];
} else {
    $op = "";
}

if ($op == 'delete') {
    $id     = $_GET['id'];
    $sql1   = "delete from kepuasan_masyarakat where id = '$id'";
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
    $sql1       = "select * from kepuasan_masyarakat where id = '$id'";
    $q1         = mysqli_query($koneksi, $sql1);
    $r1         = mysqli_fetch_array($q1);
    $tahun      = $r1['tahun'];
    $periode    = $r1['periode'];
    $semester   = $r1['semester'];
    $nilai      = $r1['nilai'];
    $mutu       = $r1['mutu'];
    $kinerja    = $r1['kinerja'];
    $keterangan = $r1['keterangan'];

    if ($tahun == '') {
        $error = "Data tidak ditemukan";
    }
}

if (isset($_POST['simpan'])) { //untuk create
    $tahun       = $_POST['tahun'];
    $periode     = $_POST['periode'];
    $semester    = $_POST['semester'];
    $nilai       = $_POST['nilai'];
    $mutu        = $_POST['mutu'];
    $kinerja     = $_POST['kinerja'];
    $keterangan  = $_POST['keterangan'];

    if ($tahun && $periode && $semester && $nilai && $mutu && $kinerja && $keterangan) {
        if ($op == 'edit') { //untuk update
            $sql1 = "update kepuasan_masyarakat set tahun='$tahun',periode='$periode',semester='$semester',nilai='$nilai',mutu='$mutu',kinerja='$kinerja',keterangan='$keterangan' where id='$id'";
            $q1   = mysqli_query($koneksi, $sql1);
            if ($q1) {
                $sukses = "Data berhasil diupdate";
            } else {
                $error  = "Data gagal diupdate";
            }
        } else { //untuk insert
            $sql1 = "insert into kepuasan_masyarakat(tahun,periode,semester,nilai,mutu,kinerja,keterangan) values ('$tahun','$periode','$semester','$nilai','$mutu','$kinerja','$keterangan')";
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
    <title>Survey Kepuasan Masyarakat</title>
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
                Survey Kepuasan Masyarakat
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
                        <label for="tahun" class="form-label">Tahun</label>
                        <div class="col-sm-10">
                            <input type="year" class="form-control" id="tahun" name="tahun" value="<?php echo $tahun ?>">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="periode" class="form-label">Periode</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="periode" name="periode" value="<?php echo $periode ?>">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="semester" class="form-label">Semester</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="semester" name="semester" value="<?php echo $semester ?>">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="nilai" class="form-label">Nilai Interval</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nilai" name="nilai" value="<?php echo $nilai ?>">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="mutu" class="form-label">Mutu Pelayanan</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="mutu" name="mutu" value="<?php echo $mutu ?>">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="kinerja" class="form-label">Kinerja Unit Pelayanan</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="kinerja" name="kinerja" value="<?php echo $kinerja ?>">
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
                Hasil Survei Kepuasan Masyarakat BNN Kota Banda Aceh
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Tahun</th>
                            <th scope="col">Periode</th>
                            <th scope="col">Semester</th>
                            <th scope="col">Nilai Interval</th>
                            <th scope="col">Mutu Pelayanan</th>
                            <th scope="col">Kinerja Unit Pelayanan</th>
                            <th scope="col">Keterangan</th>
                            <th scope="col">Aksi</th>
                        </tr>

                    <tbody>
                        <?php
                        $sql2   = "select * from kepuasan_masyarakat order by id desc";
                        $q2     = mysqli_query($koneksi, $sql2);
                        $urut   = 1;
                        while ($r2 = mysqli_fetch_array($q2)) {
                            $id          = $r2['id'];
                            $tahun       = $r2['tahun'];
                            $periode     = $r2['periode'];
                            $semester    = $r2['semester'];
                            $nilai       = $r2['nilai'];
                            $mutu        = $r2['mutu'];
                            $kinerja     = $r2['kinerja'];
                            $keterangan  = $r2['keterangan'];

                        ?>
                            <tr>
                                <th scope="row"><?php echo $urut++ ?></th>
                                <td scope="row"><?php echo $tahun ?></td>
                                <td scope="row"><?php echo $periode ?></td>
                                <td scope="row"><?php echo $semester ?></td>
                                <td scope="row"><?php echo $nilai ?></td>
                                <td scope="row"><?php echo $mutu ?></td>
                                <td scope="row"><?php echo $kinerja ?></td>
                                <td scope="row"><?php echo $keterangan ?></td>
                                <td scope="row">
                                    <a href="kepuasan_masyarakat.php?op=edit&id=<?php echo $id ?>"><button type="button" class="btn btn-warning">Edit</button></a>
                                    <a href="kepuasan_masyarakat.php?op=delete&id=<?php echo $id ?>" onclick="return confirm('Yakin mau delete data?')"><button type="button" class="btn btn-danger">Delete</button></a>


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
<?php
$host       = "localhost";
$user       = "root";
$pass       = "";
$db         = "bnnn";

$koneksi    = mysqli_connect($host, $user, $pass, $db);
if (!$koneksi) {
    die("tidak bisa terkoneksi");
}
$lembaga       = "";
$lokasi     = "";
$klienri   = "";
$klienrj      = "";
$sukses     = "";
$error      = "";

if (isset($_GET['op'])) {
    $op = $_GET['op'];
} else {
    $op = "";
}

if ($op == 'delete') {
    $id         = $_GET['id'];
    $sql1       = "DELETE FROM rehab_masy WHERE id=" . $id;
    $q1         = mysqli_query($koneksi, $sql1); {
        if ($q1) {
            $sukses = "Berhasil Hapus Data";
        } else {
            $error  = "Gagal Hapus Data";
        }
    }
}

if ($op == 'edit') {
    $id             = $_GET['id'];
    $sql1           = "select * from rehab_masy where id = '$id'";
    $q1             = mysqli_query($koneksi, $sql1);
    $r1             = mysqli_fetch_array($q1);
    $lembaga           = $r1['lembaga'];
    $lokasi         = $r1['lokasi'];
    $klienri       = $r1['klienri'];
    $klienrj          = $r1['klienrj'];

    if ($lembaga == '') {
        $error = "Data tidak ditemukan";
    }
}

if (isset($_POST['simpan'])) { // untuk create
    $lembaga       = $_POST['lembaga'];
    $lokasi     = $_POST['lokasi'];
    $klienri   = $_POST['klienri'];
    $klienrj       = $_POST['klienrj'];
    $keterangan     = $_POST['keterangan'];

    if ($lembaga && $lokasi && $klienri && $klienrj) {
        if ($op == 'edit') { //untuk update
            $sql1   = "update rehab_masy set lembaga = '$lembaga', lokasi ='$lokasi', klienri ='$klienri', klienrj = '$klienrj',  where id = '$id' ";
            $q1 = mysqli_query($koneksi, $sql1);
            if ($q1) {
                $sukses = "Data berhasil di update";
            } else {
                $error = "Data gagal diupdate";
            }
        } else { //untul insert
            $sql1 = "insert into rehab_masy(lembaga,lokasi,klienri,klienrj) values ('$lembaga','$lokasi', '$klienri', '$klienrj')";
            $q1   = mysqli_query($koneksi, $sql1);
            if ($q1) {
                $sukses     = "Berhasil Memasukkan Data Baru";
            } else {
                $error      = "Gagal Memasukkan Data";
            }
        }
    } else {
        $error = "Silahkan Masukkan Semua Data";
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LRKM</title>
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
        <!-- untuk masukkan data -->
        <div class="card">
            <div class="card-header">
                <h3>Lembaga Rehabilitasi Komponen Masyarakat</h3>
            </div>
            <div class="card-body">
                <?php
                if ($error) {
                ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $error ?>
                </div>
                <?php
                    header("refresh:5;url=lembaga.php"); // 5= detik
                }
                ?>

                <?php
                if ($sukses) {
                ?>
                <div class="alert alert-success" role="alert">
                    <?php echo $sukses ?>
                </div>
                <?php
                    header("refresh:5;url=lembaga.php"); // 5= detik
                }
                ?>
                <form action="" method="POST">
                    <div class="mb-1 row">
                        <label for="lembaga" class="col-sm-4 col-form-label">Lembaga Rehabilitasi</label>
                        <input type="text" class="form-control" id="lembaga" name="lembaga"
                            value="<?php echo $lembaga  ?>" placeholder="Masukkan Lembaga Rehabilitasi">
                    </div>

                    <div class="mb-1 row">
                        <label for="lokasi" class="col-sm-4 col-form-label">Lokasi Rehabilitasi</label>
                        <input type="text" class="form-control" id="lokasi" name="lokasi" value="<?php echo $lokasi  ?>"
                            placeholder="Masukkan lokasi Rehabilitasi">
                    </div>

                    <div class="mb-1 row">
                        <label for="klienri" class="col-sm-4 col-form-label">Jumlah Klien Rawat Inap</label>
                        <input type="text" class="form-control" id="klienri" name="klienri"
                            value="<?php echo $klienri  ?>" placeholder="Masukkan Jumlah Klien Rawat Inap">
                    </div>

                    <div class="mb-1 row">
                        <label for="klienrj" class="col-sm-4 col-form-label">Jumlah Klien Rawat Jalan</label>
                        <input type="text" class="form-control" id="klienrj" name="klienrj"
                            value="<?php echo $klienrj  ?>" placeholder="Masukkan Jumlah Klien Rawat Jalan">
                    </div>
                    <div class="col-12">
                        <input type="submit" name="simpan" value="Simpan Data" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>

        <!-- untuk mengeluarkan data -->
        <div class="card">
            <div class="card-header text-white bg-secondary">
                Data Rehabilitasi
            </div>
            <div class="card-body">
                <!--<form action="" method="POST"> -->
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Nama Lembaga</th>
                            <th scope="col">Lokasi</th>
                            <th scope="col">Jumlah Klien Rawat Inap</th>
                            <th scope="col">Jumlah Klien Rawat Jalan</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    <tbody>
                        <?php
                        $sql2   = "select * from rehab_masy order by id desc";
                        $q2 = mysqli_query($koneksi, $sql2);
                        $urut = 1;
                        while ($r2 = mysqli_fetch_array($q2)) {
                            $id = $r2['id'];
                            $lembaga = $r2['lembaga'];
                            $lokasi = $r2['lokasi'];
                            $klienri = $r2['klienri'];
                            $klien = $r2['klienrj'];

                        ?>
                        <tr>
                            <th scope="row"><?php echo $urut++ ?></th>
                            <td scope="row"><?php echo $lembaga ?></td>
                            <td scope="row"><?php echo $lokasi ?></td>
                            <td scope="row"><?php echo $klienri ?></td>
                            <td scope="row"><?php echo $klienrj ?></td>
                            <td scope="row">
                                <a href="lembaga.php?op=edit&id=<?php echo $id ?>"><button type="button"
                                        class="btn btn-warning">Edit</button></a>
                                <a href="lembaga.php?op=delete&id=<?php echo $id ?>"
                                    onclick="return confirm('Yakin mau delete data?')"><button type="button"
                                        class="btn btn-danger" value="delete">Hapus</button></a>

                            </td>
                        </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                    </thead>
                </table>
                </form>
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
<?php
$host       = "localhost";
$user       = "root";
$pass       = "";
$db         = "bnnn";

$koneksi    = mysqli_connect($host, $user, $pass, $db);
if (!$koneksi) {
    die("tidak bisa terkoneksi");
}
$tanggal       = "";
$nourut     = "";
$pukul   = "";
$nama      = "";
$dari    = "";
$keperluan     = "";
$keterangan = "";
$sukses     = "";
$error      = "";

if (isset($_GET['op'])) {
    $op = $_GET['op'];
} else {
    $op = "";
}

if ($op == 'delete') {
    $id         = $_GET['id'];
    $sql1       = "DELETE FROM tamu WHERE id=" . $id;
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
    $sql1           = "select * from tamu where id = '$id'";
    $q1             = mysqli_query($koneksi, $sql1);
    $r1             = mysqli_fetch_array($q1);
    $tanggal           = $r1['tanggal'];
    $nourut         = $r1['nourut'];
    $pukul       = $r1['pukul'];
    $nama          = $r1['nama'];
    $dari        = $r1['dari'];
    $keperluan         = $r1['keperluan'];
    $keterangan     = $r1['keterangan'];

    if ($tanggal == '') {
        $error = "Data tidak ditemukan";
    }
}

if (isset($_POST['simpan'])) { // untuk create
    $tanggal       = $_POST['tanggal'];
    $nourut     = $_POST['nourut'];
    $pukul   = $_POST['pukul'];
    $nama       = $_POST['nama'];
    $dari        = $_POST['dari'];
    $keperluan        = $_POST['keperluan'];
    $keterangan     = $_POST['keterangan'];



    if ($tanggal && $nourut && $pukul && $nama && $dari && $keperluan && $keterangan) {
        if ($op == 'edit') { //untuk update
            $sql1   = "update tamu set tanggal = '$tanggal', nourut ='$nourut', pukul ='$pukul', nama = '$nama', dari = '$dari', keperluan = '$keperluan', keterangan = '$keterangan' where id = '$id' ";
            $q1 = mysqli_query($koneksi, $sql1);
            if ($q1) {
                $sukses = "Data berhasil di update";
            } else {
                $error = "Data gagal diupdate";
            }
        } else { //untul insert
            $sql1 = "insert into tamu(tanggal,nourut,pukul,nama,dari,keperluan,keterangan) values ('$tanggal','$nourut', '$pukul', '$nama', '$dari', '$keperluan', '$keterangan')";
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
    <title>Surat Keluar</title>
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
                <h1>Daftar tamu</h1>
            </div>
            <div class="card-body">
                <?php
                if ($error) {
                ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $error ?>
                </div>
                <?php
                    header("refresh:5;url=tamu.php"); // 5= detik
                }
                ?>

                <?php
                if ($sukses) {
                ?>
                <div class="alert alert-success" role="alert">
                    <?php echo $sukses ?>
                </div>
                <?php
                    header("refresh:5;url=tamu.php"); // 5= detik
                }
                ?>
                <form action="" method="POST">
                    <div class="mb-1 row">
                        <label for="tanggal" class="col-sm-4 col-form-label">Tanggal</label>
                        <input type="text" class="form-control" id="tanggal" name="tanggal"
                            value="<?php echo $tanggal  ?>" placeholder="Masukkan Tanggal">
                    </div>

                    <div class="mb-1 row">
                        <label for="nourut" class="col-sm-4 col-form-label">Nomor Urut</label>
                        <input type="text" class="form-control" id="nourut" name="nourut" value="<?php echo $nourut  ?>"
                            placeholder="Masukkan Nomor Urut">
                    </div>

                    <div class="mb-1 row">
                        <label for="pukul" class="col-sm-4 col-form-label">Pukul</label>
                        <input type="text" class="form-control" id="pukul" name="pukul" value="<?php echo $pukul  ?>"
                            placeholder="Masukkan Jam">
                    </div>

                    <div class="mb-1 row">
                        <label for="nama" class="col-sm-4 col-form-label">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $nama  ?>"
                            placeholder="Masukkan Nama">
                    </div>

                    <div class="mb-1 row">
                        <label for="dari" class="col-sm-4 col-form-label">Dari</label>
                        <input type="text" class="form-control" id="dari" name="dari" value="<?php echo $dari  ?>"
                            placeholder="Masukkan Dari">
                    </div>

                    <div class="mb-1 row">
                        <label for="keperluan" class="col-sm-4 col-form-label">Keperluan</label>
                        <input type="text" class="form-control" id="keperluan" name="keperluan"
                            value="<?php echo $keperluan  ?>" placeholder="Masukkan Keperluan">
                    </div>

                    <div class="mb-1 row">
                        <label for="keterangan" class="col-sm-4 col-form-label">keterangan</label>
                        <input type="text" class="form-control" id="keterangan" name="keterangan"
                            value="<?php echo $keterangan  ?>" placeholder="Masukkan Keterangan">
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
                Data tamu
            </div>
            <div class="card-body">
                <!--<form action="" method="POST"> -->
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">tanggal</th>
                            <th scope="col">nourut</th>
                            <th scope="col">pukul</th>
                            <th scope="col">nama</th>
                            <th scope="col">dari</th>
                            <th scope="col">keperluan</th>
                            <th scope="col">keterangan</th>
                        </tr>
                    <tbody>
                        <?php
                        $sql2   = "select * from tamu order by id desc";
                        $q2 = mysqli_query($koneksi, $sql2);
                        $urut = 1;
                        while ($r2 = mysqli_fetch_array($q2)) {
                            $id = $r2['id'];
                            $tanggal = $r2['tanggal'];
                            $nourut = $r2['nourut'];
                            $pukul = $r2['pukul'];
                            $nama = $r2['nama'];
                            $dari = $r2['dari'];
                            $keperluan = $r2['keperluan'];
                            $keterangan = $r2['keterangan'];

                        ?>
                        <tr>
                            <th scope="row"><?php echo $urut++ ?></th>
                            <td scope="row"><?php echo $tanggal ?></td>
                            <td scope="row"><?php echo $nourut ?></td>
                            <td scope="row"><?php echo $pukul ?></td>
                            <td scope="row"><?php echo $nama ?></td>
                            <td scope="row"><?php echo $dari ?></td>
                            <td scope="row"><?php echo $keperluan ?></td>
                            <td scope="row"><?php echo $keterangan ?></td>
                            <td scope="row">
                                <a href="tamu.php?op=edit&id=<?php echo $id ?>"><button type="button"
                                        class="btn btn-warning">Edit</button></a>
                                <a href="tamu.php?op=delete&id=<?php echo $id ?>"
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
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
$nomor     = "";
$perihal   = "";
$tanggal      = "";
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
    $sql1       = "DELETE FROM mou WHERE id=" . $id;
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
    $sql1           = "select * from mou where id = '$id'";
    $q1             = mysqli_query($koneksi, $sql1);
    $r1             = mysqli_fetch_array($q1);
    $lembaga           = $r1['lembaga'];
    $nomor         = $r1['nomor'];
    $perihal       = $r1['perihal'];
    $tanggal          = $r1['tanggal'];
    $keterangan     = $r1['keterangan'];

    if ($lembaga == '') {
        $error = "Data tidak ditemukan";
    }
}

if (isset($_POST['simpan'])) { // untuk create
    $lembaga       = $_POST['lembaga'];
    $nomor     = $_POST['nomor'];
    $perihal   = $_POST['perihal'];
    $tanggal       = $_POST['tanggal'];
    $keterangan     = $_POST['keterangan'];

    if ($lembaga && $nomor && $perihal && $tanggal && $keterangan) {
        if ($op == 'edit') { //untuk update
            $sql1   = "update mou set lembaga = '$lembaga', nomor ='$nomor', perihal ='$perihal', tanggal = '$tanggal', keterangan ='$keterangan', where id = '$id' ";
            $q1 = mysqli_query($koneksi, $sql1);
            if ($q1) {
                $sukses = "Data berhasil di update";
            } else {
                $error = "Data gagal diupdate";
            }
        } else { //untul insert
            $sql1 = "insert into mou(lembaga,nomor,perihal,tanggal,keterangan) values ('$lembaga','$nomor', '$perihal', '$tanggal', '$keterangan')";
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
    <title>MOU</title>
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
        width: 1000px;
    }

    .card {
        margin-top: 10px;
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
                <h1>MOU</h1>
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
                    <div class="mb-1 row">
                        <label for="lembaga" class="col-sm-4 col-form-label">Lembaga MOU</label>
                        <input type="text" class="form-control" id="lembaga" name="lembaga"
                            value="<?php echo $lembaga  ?>" placeholder="Masukkan Nama Lembaga MOU">
                    </div>

                    <div class="mb-1 row">
                        <label for="nomor" class="col-sm-4 col-form-label">Nomor MOU</label>
                        <input type="text" class="form-control" id="nomor" name="nomor" value="<?php echo $nomor  ?>"
                            placeholder="Masukkan Nomor MOU">
                    </div>

                    <div class="mb-1 row">
                        <label for="perihal" class="col-sm-4 col-form-label">Perihal MOU</label>
                        <input type="text" class="form-control" id="perihal" name="perihal"
                            value="<?php echo $perihal  ?>" placeholder="Masukkan Perihal MOU">
                    </div>

                    <div class="mb-1 row">
                        <label for="tanggal" class="col-sm-4 col-form-label">Tanggal Penandatanganan MOU</label>
                        <input type="date" class="form-control" id="tanggal" name="tanggal"
                            value="<?php echo $tanggal  ?>" placeholder="Masukkan Tanggal Penandatanganan MOU">
                    </div>

                    <div class="mb-1 row">
                        <label for="keterangan" class="col-sm-4 col-form-label">Keterangan</label>
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
                Data MOU
            </div>
            <div class="card-body">
                <!--<form action="" method="POST"> -->
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Nama Lembaga</th>
                            <th scope="col">Nomor MOU</th>
                            <th scope="col">Perihal MOU</th>
                            <th scope="col">Tanggal Penandatanganan MOU</th>
                            <th scope="col">Keterangan</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    <tbody>
                        <?php
                        $sql2   = "select * from mou order by id desc";
                        $q2 = mysqli_query($koneksi, $sql2);
                        $urut = 1;
                        while ($r2 = mysqli_fetch_array($q2)) {
                            $id = $r2['id'];
                            $lembaga = $r2['lembaga'];
                            $nomor = $r2['nomor'];
                            $perihal = $r2['perihal'];
                            $klien = $r2['tanggal'];
                            $keterangan = $r2['keterangan'];

                        ?>
                        <tr>
                            <th scope="row"><?php echo $urut++ ?></th>
                            <td scope="row"><?php echo $lembaga ?></td>
                            <td scope="row"><?php echo $nomor ?></td>
                            <td scope="row"><?php echo $perihal ?></td>
                            <td scope="row"><?php echo $tanggal ?></td>
                            <td scope="row"><?php echo $keterangan ?></td>
                            <td scope="row">
                                <a href="mou.php?op=edit&id=<?php echo $id ?>"><button type="button"
                                        class="btn btn-warning">Edit</button></a>
                                <a href="mou.php?op=delete&id=<?php echo $id ?>"
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
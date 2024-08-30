<?php
$host       = "localhost";
$user       = "root";
$pass       = "";
$db         = "bnnn";

$koneksi    = mysqli_connect($host, $user, $pass, $db);
if (!$koneksi) {
    die("tidak bisa terkoneksi");
}
$nama       = "";
$lokasi     = "";
$jumlahap   = "";
$klien      = "";
$sukses     = "";
$error      = "";

if (isset($_GET['op'])) {
    $op = $_GET['op'];
} else {
    $op = "";
}

if ($op == 'delete') {
    $id         = $_GET['id'];
    $sql1       = "DELETE FROM ibm WHERE id=" . $id;
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
    $sql1           = "select * from ibm where id = '$id'";
    $q1             = mysqli_query($koneksi, $sql1);
    $r1             = mysqli_fetch_array($q1);
    $nama           = $r1['nama'];
    $lokasi         = $r1['lokasi'];
    $jumlahap       = $r1['jumlahap'];
    $klien          = $r1['klien'];

    if ($nama == '') {
        $error = "Data tidak ditemukan";
    }
}

if (isset($_POST['simpan'])) { // untuk create
    $nama       = $_POST['nama'];
    $lokasi     = $_POST['lokasi'];
    $jumlahap   = $_POST['jumlahap'];
    $klien       = $_POST['klien'];

    if ($nama && $lokasi && $jumlahap && $klien) {
        if ($op == 'edit') { //untuk update
            $sql1   = "update ibm set nama = '$nama', lokasi ='$lokasi', jumlahap ='$jumlahap', klien = '$klien' where id = '$id' ";
            $q1 = mysqli_query($koneksi, $sql1);
            if ($q1) {
                $sukses = "Data berhasil di update";
            } else {
                $error = "Data gagal diupdate";
            }
        } else { //untul insert
            $sql1 = "insert into ibm(nama,lokasi,jumlahap,klien) values ('$nama','$lokasi', '$jumlahap', '$klien')";
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
    <title>IBM</title>
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
                <h3>IBM</h3>
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
                        <label for="nama" class="col-sm-2 col-form-label">Nama IBM</label>
                        <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $nama  ?>"
                            placeholder="Masukkan Nama">
                    </div>

                    <div class="mb-1 row">
                        <label for="lokasi" class="col-sm-2 col-form-label">Lokasi IBM</label>
                        <input type="text" class="form-control" id="lokasi" name="lokasi" value="<?php echo $lokasi  ?>"
                            placeholder="Masukkan Lokasi">
                    </div>

                    <div class="mb-1 row">
                        <label for="jumlahap" class="col-sm-2 col-form-label">Jumlah AP</label>
                        <input type="text" class="form-control" id="jumlahap" name="jumlahap"
                            value="<?php echo $jumlahap  ?>" placeholder="Masukkan Jumlah AP">
                    </div>

                    <div class="mb-1 row">
                        <label for="klien" class="col-sm-2 col-form-label">Jumlah Klien</label>
                        <input type="text" class="form-control" id="klien" name="klien" value="<?php echo $klien  ?>"
                            placeholder="Masukkan Jumlah Klien">
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
                Data IBM
            </div>
            <div class="card-body">
                <!--<form action="" method="POST"> -->
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Lokasi</th>
                            <th scope="col">Jumlah AP</th>
                            <th scope="col">Jumlah Klien</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    <tbody>
                        <?php
                        $sql2   = "select * from ibm order by id desc";
                        $q2 = mysqli_query($koneksi, $sql2);
                        $urut = 1;
                        while ($r2 = mysqli_fetch_array($q2)) {
                            $id = $r2['id'];
                            $nama = $r2['nama'];
                            $lokasi = $r2['lokasi'];
                            $jumlahap = $r2['jumlahap'];
                            $klien = $r2['klien'];

                        ?>
                        <tr>
                            <th scope="row"><?php echo $urut++ ?></th>
                            <td scope="row"><?php echo $nama ?></td>
                            <td scope="row"><?php echo $lokasi ?></td>
                            <td scope="row"><?php echo $jumlahap ?></td>
                            <td scope="row"><?php echo $klien ?></td>
                            <td scope="row">
                                <a href="ibm.php?op=edit&id=<?php echo $id ?>"><button type="button"
                                        class="btn btn-warning">Edit</button></a>
                                <a href="ibm.php?op=delete&id=<?php echo $id ?>"
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
        </div>

        <div class="card">
            <div class="card-header">
                <h1>-</h1>
            </div>
        </div>
        <?php require_once 'footer.php'; ?>
    </div>
</body>

</html>
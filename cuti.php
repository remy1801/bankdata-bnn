<?php
$host       = "localhost";
$user       = "root";
$pass       = "";
$db         = "bnnn";

$koneksi    = mysqli_connect($host, $user, $pass, $db);
if (!$koneksi) {
    die("tidak bisa terkoneksi");
}
$nama        = "";
$pangkat     = "";
$nip         = "";
$jabatan     = "";
$alamat      = "";
$lama        = "";
$jenis       = "";
$tmt         = "";
$keperluan   = "";
$lokasi      = "";
$cutitahun  = "";
$keterangan  = "";
$sukses      = "";
$error       = "";

if (isset($_GET['op'])) {
    $op = $_GET['op'];
} else {
    $op = "";
}

if ($op == 'delete') {
    $id         = $_GET['id'];
    $sql1       = "DELETE FROM cuti WHERE id=" . $id;
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
    $sql1           = "select * from cuti where id = '$id'";
    $q1             = mysqli_query($koneksi, $sql1);
    $r1             = mysqli_fetch_array($q1);
    $nama           = $r1['nama'];
    $pangkat        = $r1['pangkat'];
    $nip            = $r1['nip'];
    $jabatan        = $r1['jabatan'];
    $alamat         = $r1['alamat'];
    $lama           = $r1['lama'];
    $jenis          = $r1['jenis'];
    $tmt            = $r1['tmt'];
    $keperluan      = $r1['keperluan'];
    $lokasi         = $r1['lokasi'];
    $cutitahun     = $r1['cutitahun'];
    $keterangan     = $r1['keterangan'];

    if ($nama == '') {
        $error = "Data tidak ditemukan";
    }
}

if (isset($_POST['simpan'])) { // untuk create
    $nama          = $_POST['nama'];
    $pangkat       = $_POST['pangkat'];
    $nip           = $_POST['nip'];
    $jabatan       = $_POST['jabatan'];
    $alamat        = $_POST['alamat'];
    $lama          = $_POST['lama'];
    $jenis         = $_POST['jenis'];
    $tmt           = $_POST['tmt'];
    $keperluan     = $_POST['keperluan'];
    $lokasi        = $_POST['lokasi'];
    $cutitahun    = $_POST['cutitahun'];
    $keterangan    = $_POST['keterangan'];

    if ($nama && $pangkat && $nip && $jabatan && $alamat && $lama && $jenis && $tmt && $keperluan && $lokasi && $cutitahun && $keterangan) {
        if ($op == 'edit') { //untuk update
            $sql1   = "update cuti set nama = '$nama', pangkat ='$pangkat', nip ='$nip', jabatan = '$jabatan', alamat = '$alamat', lama = '$lama', jenis = '$jenis', tmt = '$tmt', keperluan = '$keperluan', lokasi = '$lokasi', cutitahun = '$cutitahun', keterangan ='$keterangan', where id = '$id' ";
            $q1 = mysqli_query($koneksi, $sql1);
            if ($q1) {
                $sukses = "Data berhasil di update";
            } else {
                $error = "Data gagal diupdate";
            }
        } else { //untul insert
            $sql1 = "insert into cuti(nama,pangkat,nip,jabatan,alamat,lama,jenis,tmt,keperluan,lokasi,cutitahun,keterangan) values ('$nama','$pangkat', '$nip', '$jabatan', '$alamat', '$lama', '$jenis', '$tmt', '$keperluan', '$lokasi', '$cutitahun', '$keterangan')";
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
    <title>Cuti</title>
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
                <h1>Daftar Cuti</h1>
            </div>
            <div class="card-body">
                <?php
                if ($error) {
                ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $error ?>
                </div>
                <?php
                    header("refresh:5;url=cuti.php"); // 5= detik
                }
                ?>

                <?php
                if ($sukses) {
                ?>
                <div class="alert alert-success" role="alert">
                    <?php echo $sukses ?>
                </div>
                <?php
                    header("refresh:5;url=cuti.php"); // 5= detik
                }
                ?>

                <form action="" method="POST">
                    <div class="mb-1 row">
                        <label for="nama" class="col-sm-4 col-form-label">Nama Pegawai</label>
                        <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $nama  ?>"
                            placeholder="Masukkan Nama Pegawai">
                    </div>

                    <div class="mb-1 row">
                        <label for="pangkat" class="col-sm-4 col-form-label">Pangkat/Golongan</label>
                        <input type="text" class="form-control" id="pangkat" name="pangkat"
                            value="<?php echo $pangkat  ?>" placeholder="Masukkan Pangkat/Golongan Pegawai">
                    </div>

                    <div class="mb-1 row">
                        <label for="nip" class="col-sm-4 col-form-label">NIP</label>
                        <input type="text" class="form-control" id="nip" name="nip" value="<?php echo $nip  ?>"
                            placeholder="Masukkan NIP Pegawai">
                    </div>

                    <div class="mb-1 row">
                        <label for="jabatan" class="col-sm-4 col-form-label">Jabatan</label>
                        <input type="text" class="form-control" id="jabatan" name="jabatan"
                            value="<?php echo $jabatan  ?>" placeholder="Masukkan Jabatan Pegawai">
                    </div>

                    <div class="mb-1 row">
                        <label for="alamat" class="col-sm-4 col-form-label">Alamat</label>
                        <input type="text" class="form-control" id="alamat" name="alamat" value="<?php echo $alamat  ?>"
                            placeholder="Masukkan Alamat Pegawai">
                    </div>

                    <div class="mb-1 row">
                        <label for="lama" class="col-sm-4 col-form-label">Lama Cuti</label>
                        <input type="text" class="form-control" id="lama" name="lama" value="<?php echo $lama  ?>"
                            placeholder="Masukkan Lama Cuti Pegawai">
                    </div>

                    <div class="mb-1 row">
                        <label for="jenis" class="col-sm-4 col-form-label">Jenis Cuti</label>
                        <input type="text" class="form-control" id="jenis" name="jenis" value="<?php echo $jenis  ?>"
                            placeholder="Masukkan Jenis Cuti Pegawai">
                    </div>

                    <div class="mb-1 row">
                        <label for="tmt" class="col-sm-4 col-form-label">TMT s.d Tanggal</label>
                        <input type="text" class="form-control" id="tmt" name="tmt" value="<?php echo $tmt  ?>"
                            placeholder="Masukkan Jadwal TMT">
                    </div>

                    <div class="mb-1 row">
                        <label for="keperluan" class="col-sm-4 col-form-label">Keperluan</label>
                        <input type="text" class="form-control" id="keperluan" name="keperluan"
                            value="<?php echo $keperluan  ?>" placeholder="Masukkan Keperluan">
                    </div>

                    <div class="mb-1 row">
                        <label for="lokasi" class="col-sm-4 col-form-label">Lokasi</label>
                        <input type="text" class="form-control" id="lokasi" name="lokasi" value="<?php echo $lokasi  ?>"
                            placeholder="Masukkan Lokasi">
                    </div>

                    <div class="mb-1 row">
                        <label for="cutitahun" class="col-sm-4 col-form-label">Cuti tahun</label>
                        <input type="text" class="form-control" id="cutitahun" name="cutitahun"
                            value="<?php echo $cutitahun  ?>" placeholder="Masukkan Tahun cuti">
                    </div>

                    <div class="mb-1 row">
                        <label for="keterangan" class="col-sm-4 col-form-label">keterangan</label>
                        <input type="text" class="form-control" id="keterangan" name="keterangan"
                            value="<?php echo $keterangan  ?>" placeholder="Masukkan keterangan">
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
                Data Cuti
            </div>
            <div class="table-responsive">
                <!--<form action="" method="POST"> -->
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Nama</th>
                            <th scope="col">pangkat</th>
                            <th scope="col">NIP</th>
                            <th scope="col">Jabatan</th>
                            <th scope="col">Alamat</th>
                            <th scope="col">Lama Cuti</th>
                            <th scope="col">Jenis Cuti</th>
                            <th scope="col">TMT</th>
                            <th scope="col">Keperluan</th>
                            <th scope="col">Lokasi</th>
                            <th scope="col">Tahun Cuti</th>
                            <th scope="col">Keterangan</th>
                        </tr>
                    <tbody>
                        <?php
                        $sql2   = "select * from cuti order by id desc";
                        $q2 = mysqli_query($koneksi, $sql2);
                        $urut = 1;
                        while ($r2 = mysqli_fetch_array($q2)) {
                            $id = $r2['id'];
                            $nama = $r2['nama'];
                            $pangkat = $r2['pangkat'];
                            $nip = $r2['nip'];
                            $jabatan = $r2['jabatan'];
                            $alamat = $r2['alamat'];
                            $lama = $r2['lama'];
                            $jenis = $r2['jenis'];
                            $tmt = $r2['tmt'];
                            $keperluan = $r2['keperluan'];
                            $lokasi = $r2['lokasi'];
                            $cutitahun = $r2['cutitahun'];
                            $keterangan = $r2['keterangan'];

                        ?>
                        <tr>
                            <th scope="row"><?php echo $urut++ ?></th>
                            <td scope="row"><?php echo $nama ?></td>
                            <td scope="row"><?php echo $pangkat ?></td>
                            <td scope="row"><?php echo $nip ?></td>
                            <td scope="row"><?php echo $jabatan ?></td>
                            <td scope="row"><?php echo $alamat ?></td>
                            <td scope="row"><?php echo $lama ?></td>
                            <td scope="row"><?php echo $jenis ?></td>
                            <td scope="row"><?php echo $tmt ?></td>
                            <td scope="row"><?php echo $keperluan ?></td>
                            <td scope="row"><?php echo $lokasi ?></td>
                            <td scope="row"><?php echo $cutitahun ?></td>
                            <td scope="row"><?php echo $keterangan ?></td>
                            <td scope="row">
                                <a href="cuti.php?op=edit&id=<?php echo $id ?>"><button type="button"
                                        class="btn btn-warning">Edit</button></a>
                                <a href="cuti.php?op=delete&id=<?php echo $id ?>"
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
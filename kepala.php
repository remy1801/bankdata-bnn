<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kepala</title>
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
            margin-top: 40px
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
</head>

<body>
    <h1 align="center">Biodata Kepala Sub Bagian Umum</h1>
    <table border="1" cellspacing="0" cellpadding="5" align="center" width="800>
        <tr align=" center">
        <td colspan="2" width="400">Data Diri</td>
        <td width="200">Foto</td>
        </tr>
        <tr>
            <td>Nama</td>
            <td>ABCDEFGHIJKLMN</td>
            <td rowspan="7"><img src="foto.jpeg" width="200"></td>
        </tr>

        <tr>
            <td>Pangkat/Golongan</td>
            <td>.....</td>
        </tr>

        <tr>
            <td>NIP/NRP</td>
            <td>.....</td>
        </tr>

        <tr>
            <td>Tempat Tanggal Lahir</td>
            <td>.....</td>
        </tr>

        <tr>
            <td>Jenis Kelamin</td>
            <td>.....</td>
        </tr>

        <tr>
            <td>Rentang Waktu Menjabat</td>
            <td>.....</td>
        </tr>
    </table>
        <?php require_once 'footer.php'; ?>
</body>

</html>
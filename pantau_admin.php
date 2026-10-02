<?php
session_start();
include "../koneksi.php";

// Cek login pimpinan
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'pimpinan') {
    header("Location: ../index.php");
    exit;
}

// Ambil data pelanggan
$data = mysqli_query($koneksi, "
    SELECT *
    FROM pelanggan
    ORDER BY id_pelanggan DESC
");

if (!$data) {
    die("Query gagal: " . mysqli_error($koneksi));
}
?>

<!DOCTYPE html>
<html lang="id">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Pantau Admin</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
    margin:0;
    background:#f4f7fa;
    font-family:Arial, sans-serif;
}

/* LOGO SAMAR DI TENGAH */
.logo-samar{
    position:fixed;
    width:300px;
    height:auto;
    opacity:0.12;
    top:50%;
    left:62%;
    transform:translate(-50%, -50%);
    pointer-events:none;
    z-index:0;
}

/* SIDEBAR */
.sidebar{
    position:fixed;
    width:230px;
    height:100vh;
    background:#0d6efd;
    z-index:2;
}

/* LOGO KECIL SIDEBAR */
.logo-tirtanadi{
    display:block;
    width:75px;
    height:75px;
    object-fit:contain;
    margin:15px auto 10px;
}

.sidebar h2{
    color:white;
    text-align:center;
    padding:10px 20px 20px;
    margin:0;
}

.sidebar a{
    display:block;
    color:white;
    padding:15px 20px;
    text-decoration:none;
}

.sidebar a:hover{
    background:white;
    color:#0d6efd;
}

/* HALAMAN UTAMA */
.main{
    margin-left:230px;
    padding:30px;
    min-height:100vh;
    position:relative;
    z-index:1;
}

/* CARD */
.card{
    border:none;
    border-radius:12px;
    box-shadow:0 4px 10px rgba(0,0,0,.1);
    background:rgba(255,255,255,0.92);
}

</style>

</head>

<body>

<!-- LOGO SAMAR DI TENGAH -->
<img src="../assets/logo-tirtanadi.jpg"
     class="logo-samar"
     alt="Logo Tirtanadi">

<!-- SIDEBAR -->
<div class="sidebar">

    <!-- LOGO KECIL -->
    <img src="../assets/logo-tirtanadi.jpg"
         alt="Logo Tirtanadi"
         class="logo-tirtanadi">

    <h2>PIMPINAN</h2>

    <a href="dashboard.php">🏠 Dashboard</a>

    <a href="data_umum.php">👥 Data Umum</a>

    <a href="pantau_admin.php">👨‍💼 Pantau Admin</a>

    <a href="pantau_teknisi.php">🔧 Pantau Teknisi</a>

    <a href="../logout.php">🚪 Logout</a>

</div>

<!-- CONTENT -->
<div class="main">

    <div class="card">

        <div class="card-body">

            <h3 class="mb-4">👨‍💼 Pantau Admin</h3>

            <p class="text-muted">
                Data pelanggan yang dikelola oleh Admin.
            </p>

            <div class="table-responsive">

                <table class="table table-bordered table-hover">

                    <thead class="table-primary">

                        <tr>
                            <th>No</th>
                            <th>NPA</th>
                            <th>Nama Pelanggan</th>
                            <th>Alamat</th>
                            <th>No. HP</th>
                            <th>Kelurahan</th>
                            <th>Jenis Pelanggan</th>
                        </tr>

                    </thead>

                    <tbody>

                    <?php

                    $no = 1;

                    if (mysqli_num_rows($data) > 0) {

                        while ($row = mysqli_fetch_assoc($data)) {

                    ?>

                        <tr>

                            <td><?= $no++; ?></td>

                            <td><?= htmlspecialchars($row['no_pelanggan']); ?></td>

                            <td><?= htmlspecialchars($row['nama_pelanggan']); ?></td>

                            <td><?= htmlspecialchars($row['alamat']); ?></td>

                            <td><?= htmlspecialchars($row['no_hp']); ?></td>

                            <td><?= htmlspecialchars($row['Kelurahan']); ?></td>

                            <td><?= htmlspecialchars($row['Jenis_Pelanggan']); ?></td>

                        </tr>

                    <?php

                        }

                    } else {

                    ?>

                        <tr>

                            <td colspan="7" class="text-center">
                                Belum ada data pelanggan.
                            </td>

                        </tr>

                    <?php } ?>

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

</body>
</html>
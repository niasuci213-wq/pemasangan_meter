<?php
session_start();
include "../koneksi.php";

/* =====================================================
   FILTER STATUS
===================================================== */

$status_filter = "";

if (isset($_GET['status'])) {
    $status_filter = $_GET['status'];
}


/* =====================================================
   QUERY DATA
===================================================== */

if ($status_filter == "Menunggu") {

    $data = mysqli_query($koneksi, "
        SELECT * FROM pelanggan
        WHERE status_pemasangan = 'Menunggu'
        ORDER BY id_pelanggan DESC
    ");

}
elseif ($status_filter == "Proses Pemasangan") {

    $data = mysqli_query($koneksi, "
        SELECT * FROM pelanggan
        WHERE status_pemasangan = 'Proses Pemasangan'
        ORDER BY id_pelanggan DESC
    ");

}
elseif ($status_filter == "Sudah Dipasang") {

    $data = mysqli_query($koneksi, "
        SELECT * FROM pelanggan
        WHERE status_pemasangan = 'Sudah Dipasang'
        ORDER BY id_pelanggan DESC
    ");

}
else {

    $data = mysqli_query($koneksi, "
        SELECT * FROM pelanggan
        ORDER BY id_pelanggan DESC
    ");

}


if (!$data) {
    die("Query gagal: " . mysqli_error($koneksi));
}

?>

<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">

<meta name="viewport"
      content="width=device-width, initial-scale=1.0">

<title>Status Pemasangan - Teknisi</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet">


<style>

/* =====================================================
   RESET
===================================================== */

*{
    box-sizing:border-box;
}


/* =====================================================
   BODY
===================================================== */

body{
    margin:0;
    font-family:Arial, sans-serif;
    background:#eef7ff;
    color:#173b67;
}


/* =====================================================
   SIDEBAR
===================================================== */

.sidebar{
    position:fixed;
    left:0;
    top:0;
    width:245px;
    height:100vh;
    background:linear-gradient(180deg,#0876d9,#0053ad);
    color:white;
    z-index:1000;
    padding-top:25px;
    box-shadow:4px 0 15px rgba(0,0,0,.12);
}


/* =====================================================
   LOGO SIDEBAR
===================================================== */

.logo-tirtanadi{
    display:block;
    width:90px;
    height:90px;
    object-fit:contain;
    margin:0 auto 10px;
}


/* =====================================================
   JUDUL SIDEBAR
===================================================== */

.sidebar-title{
    text-align:center;
    font-size:23px;
    font-weight:bold;
    margin-bottom:30px;
}


/* =====================================================
   MENU SIDEBAR
===================================================== */

.sidebar a{
    display:flex;
    align-items:center;
    gap:14px;
    color:white;
    text-decoration:none;
    padding:16px 25px;
    margin:6px 14px;
    border-radius:12px;
    font-size:16px;
    transition:.3s;
}


.sidebar a:hover,
.sidebar a.active{
    background:rgba(255,255,255,.20);
    transform:translateX(3px);
}


.sidebar-icon{
    font-size:22px;
    width:25px;
    text-align:center;
}


/* =====================================================
   MAIN
===================================================== */

.main{
    margin-left:245px;
    min-height:100vh;
    padding:25px 35px;
    position:relative;
    overflow:hidden;
}


/* =====================================================
   BACKGROUND BUBBLES
===================================================== */

.bubble{
    position:absolute;
    border-radius:50%;
    background:rgba(80,180,255,.13);
    border:1px solid rgba(255,255,255,.5);
    pointer-events:none;
}


.b1{
    width:130px;
    height:130px;
    right:50px;
    top:90px;
}


.b2{
    width:70px;
    height:70px;
    right:220px;
    top:170px;
}


.b3{
    width:45px;
    height:45px;
    left:300px;
    bottom:100px;
}


.b4{
    width:90px;
    height:90px;
    right:100px;
    bottom:60px;
}


/* =====================================================
   TOP BAR
===================================================== */

.topbar{
    height:60px;
    display:flex;
    justify-content:flex-end;
    align-items:center;
    position:relative;
    z-index:2;
}


.admin-box{
    display:flex;
    align-items:center;
    gap:12px;
    background:white;
    padding:9px 18px;
    border-radius:30px;
    box-shadow:0 3px 12px rgba(0,0,0,.08);
}


.admin-icon{
    width:38px;
    height:38px;
    border-radius:50%;
    background:#096dcc;
    color:white;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:20px;
}


/* =====================================================
   HEADER
===================================================== */

.page-header{
    position:relative;
    z-index:2;
    background:linear-gradient(110deg,#e8f6ff,#ffffff);
    border-radius:20px;
    padding:25px 30px;
    margin-bottom:22px;
    box-shadow:0 5px 18px rgba(0,95,170,.10);
    overflow:hidden;
}


.page-header:after{
    content:"";
    position:absolute;
    right:-80px;
    top:-100px;
    width:270px;
    height:270px;
    border-radius:50%;
    background:rgba(24,143,231,.10);
}


.page-header h1{
    position:relative;
    z-index:1;
    color:#0755a0;
    font-size:29px;
    font-weight:bold;
    margin-bottom:8px;
}


.page-header p{
    position:relative;
    z-index:1;
    margin:0;
    color:#657b94;
    font-size:15px;
}


/* =====================================================
   FILTER CARD
===================================================== */

.filter-card{
    position:relative;
    z-index:2;
    background:white;
    border-radius:16px;
    padding:16px 20px;
    margin-bottom:20px;
    box-shadow:0 5px 15px rgba(0,80,150,.08);
    display:flex;
    align-items:center;
    justify-content:space-between;
    gap:15px;
}


.filter-text{
    font-size:15px;
    color:#496681;
}


.filter-text strong{
    color:#0755a0;
}


.btn-semua{
    text-decoration:none;
    background:#0878d8;
    color:white;
    padding:9px 16px;
    border-radius:9px;
    font-size:14px;
    font-weight:bold;
    transition:.3s;
}


.btn-semua:hover{
    background:#0053ad;
    color:white;
}


/* =====================================================
   TABLE CARD
===================================================== */

.table-card{
    position:relative;
    z-index:2;
    background:rgba(255,255,255,.94);
    border-radius:20px;
    padding:25px;
    box-shadow:0 5px 18px rgba(0,80,150,.10);
}


.table-title{
    display:flex;
    align-items:center;
    justify-content:space-between;
    margin-bottom:20px;
}


.table-title h3{
    margin:0;
    color:#174879;
    font-size:22px;
    font-weight:bold;
}


/* =====================================================
   TABLE
===================================================== */

.table-responsive{
    border-radius:12px;
}


.table{
    vertical-align:middle;
    white-space:nowrap;
    margin-bottom:0;
}


.table thead th{
    padding:14px 12px;
    font-size:14px;
    color:#174879;
}


.table tbody td{
    padding:13px 12px;
    font-size:14px;
}


.table tbody tr{
    transition:.2s;
}


.table tbody tr:hover{
    background:#f0f8ff;
}


/* =====================================================
   STATUS BADGE
===================================================== */

.status-badge{
    padding:7px 12px;
    border-radius:20px;
    font-size:12px;
    font-weight:bold;
}


.status-menunggu{
    background:#fff0bd;
    color:#9a7200;
}


.status-proses{
    background:#d9e9ff;
    color:#0755a0;
}


.status-selesai{
    background:#d5f6e6;
    color:#137346;
}


.status-kosong{
    background:#e9ecef;
    color:#66717d;
}


/* =====================================================
   KONDISI METER
===================================================== */

.meter-hilang{
    background:#ffe0e0;
    color:#b42318;
    padding:7px 11px;
    border-radius:20px;
    font-size:12px;
    font-weight:bold;
}


.meter-pecah{
    background:#fff0bd;
    color:#8a6800;
    padding:7px 11px;
    border-radius:20px;
    font-size:12px;
    font-weight:bold;
}


.meter-kosong{
    background:#e9ecef;
    color:#66717d;
    padding:7px 11px;
    border-radius:20px;
    font-size:12px;
}


/* =====================================================
   TOMBOL UBAH
===================================================== */

.btn-ubah{
    background:#0878d8;
    border:none;
    border-radius:8px;
    padding:8px 13px;
    color:white;
    font-size:13px;
    font-weight:bold;
    text-decoration:none;
    display:inline-block;
    transition:.3s;
}


.btn-ubah:hover{
    background:#0053ad;
    color:white;
    transform:translateY(-1px);
}


/* =====================================================
   DATA KOSONG
===================================================== */

.empty-data{
    padding:35px !important;
    text-align:center;
    color:#71859b;
}


/* =====================================================
   RESPONSIVE
===================================================== */

@media(max-width:900px){

    .sidebar{
        width:200px;
    }

    .main{
        margin-left:200px;
        padding:20px;
    }

}


@media(max-width:700px){

    .sidebar{
        position:relative;
        width:100%;
        height:auto;
    }

    .main{
        margin-left:0;
        padding:15px;
    }

    .filter-card{
        flex-direction:column;
        align-items:flex-start;
    }

}

</style>

</head>


<body>


<!-- =====================================================
     SIDEBAR
===================================================== -->

<div class="sidebar">


    <img
        src="../assets/logo-tirtanadi.jpg"
        class="logo-tirtanadi"
        alt="Logo Tirtanadi"
    >


    <div class="sidebar-title">
        👥 TEKNISI
    </div>


    <a href="dashboard.php">

        <span class="sidebar-icon">
            ⌂
        </span>

        Dashboard

    </a>


    <a href="data_umum.php">

        <span class="sidebar-icon">
            👥
        </span>

        Data Umum

    </a>


    <a href="status_pemasangan.php"
       class="active">

        <span class="sidebar-icon">
            ▣
        </span>

        Status Pemasangan

    </a>


    <a href="../logout.php">

        <span class="sidebar-icon">
            ⇥
        </span>

        Logout

    </a>

</div>



<!-- =====================================================
     MAIN
===================================================== -->

<div class="main">


    <!-- BACKGROUND BUBBLES -->

    <div class="bubble b1"></div>
    <div class="bubble b2"></div>
    <div class="bubble b3"></div>
    <div class="bubble b4"></div>



    <!-- =================================================
         TOP BAR
    ================================================== -->

    <div class="topbar">

        <div class="admin-box">

            <div class="admin-icon">
                👤
            </div>

            <strong>
                Teknisi
            </strong>

            <span>
                ⌄
            </span>

        </div>

    </div>



    <!-- =================================================
         HEADER
    ================================================== -->

    <div class="page-header">

        <h1>
            📋 Status Pemasangan Meter
        </h1>

        <p>
            Pantau status pemasangan meter pelanggan
            Perumda Tirtanadi Cabang Medan Denai.
        </p>

    </div>



    <!-- =================================================
         FILTER
    ================================================== -->

    <div class="filter-card">

        <div class="filter-text">

            <?php

            if ($status_filter == "Menunggu") {

                echo '🟡 Menampilkan data pelanggan dengan status <strong>Menunggu Pemasangan</strong>';

            }
            elseif ($status_filter == "Proses Pemasangan") {

                echo '🔵 Menampilkan data pelanggan dengan status <strong>Proses Pemasangan</strong>';

            }
            elseif ($status_filter == "Sudah Dipasang") {

                echo '🟢 Menampilkan data pelanggan dengan status <strong>Sudah Dipasang</strong>';

            }
            else {

                echo '📋 Menampilkan <strong>seluruh data pelanggan</strong>';

            }

            ?>

        </div>


        <?php if ($status_filter != "") { ?>

            <a
                href="status_pemasangan.php"
                class="btn-semua"
            >
                ↻ Lihat Semua Status
            </a>

        <?php } ?>

    </div>



    <!-- =================================================
         TABLE CARD
    ================================================== -->

    <div class="table-card">


        <div class="table-title">

            <h3>
                📊 Data Status Pemasangan
            </h3>

        </div>



        <div class="table-responsive">


            <table class="table table-bordered table-hover">


                <!-- HEADER -->

                <thead class="table-primary">

                    <tr>

                        <th>No</th>

                        <th>NPA</th>

                        <th>Nama Pelanggan</th>

                        <th>Alamat</th>

                        <th>Kelurahan</th>

                        <th>Kondisi Meter</th>

                        <th>Jenis Pelanggan</th>

                        <th>Status</th>

                        <th>Aksi</th>

                    </tr>

                </thead>



                <!-- BODY -->

                <tbody>

                <?php

                $no = 1;


                if (mysqli_num_rows($data) > 0) {


                    while($row = mysqli_fetch_assoc($data)){

                ?>

                <tr>


                    <!-- NO -->

                    <td>
                        <?= $no++; ?>
                    </td>


                    <!-- NPA -->

                    <td>
                        <?= htmlspecialchars(
                            $row['no_pelanggan']
                        ); ?>
                    </td>


                    <!-- NAMA -->

                    <td>
                        <?= htmlspecialchars(
                            $row['nama_pelanggan']
                        ); ?>
                    </td>


                    <!-- ALAMAT -->

                    <td>
                        <?= htmlspecialchars(
                            $row['alamat']
                        ); ?>
                    </td>


                    <!-- KELURAHAN -->

                    <td>
                        <?= htmlspecialchars(
                            $row['Kelurahan']
                        ); ?>
                    </td>


                    <!-- KONDISI METER -->

                    <td>

                        <?php

                        if (
                            $row['Kondisi_Meter']
                            == "Meter Hilang"
                        ){

                            echo '
                            <span class="meter-hilang">
                                Meter Hilang
                            </span>
                            ';

                        }

                        elseif (
                            $row['Kondisi_Meter']
                            == "Meter Pecah"
                        ){

                            echo '
                            <span class="meter-pecah">
                                Meter Pecah
                            </span>
                            ';

                        }

                        else{

                            echo '
                            <span class="meter-kosong">
                                Belum Ada Kondisi
                            </span>
                            ';

                        }

                        ?>

                    </td>


                    <!-- JENIS PELANGGAN -->

                    <td>

                        <?= htmlspecialchars(
                            $row['Jenis_Pelanggan']
                        ); ?>

                    </td>


                    <!-- STATUS -->

                    <td>

                        <?php

                        if (
                            $row['status_pemasangan']
                            == "Menunggu"
                        ){

                            echo '
                            <span class="status-badge status-menunggu">
                                Menunggu
                            </span>
                            ';

                        }

                        elseif (
                            $row['status_pemasangan']
                            == "Proses Pemasangan"
                        ){

                            echo '
                            <span class="status-badge status-proses">
                                Proses Pemasangan
                            </span>
                            ';

                        }

                        elseif (
                            $row['status_pemasangan']
                            == "Sudah Dipasang"
                        ){

                            echo '
                            <span class="status-badge status-selesai">
                                Sudah Dipasang
                            </span>
                            ';

                        }

                        else{

                            echo '
                            <span class="status-badge status-kosong">
                                Belum Ada Status
                            </span>
                            ';

                        }

                        ?>

                    </td>


                    <!-- AKSI -->

                    <td>

                        <a
                            href="ubah_status.php?id=<?= $row['id_pelanggan']; ?>"
                            class="btn-ubah"
                        >
                            ✏️ Ubah Status
                        </a>

                    </td>


                </tr>

                <?php

                    }

                }
                else{

                ?>

                    <tr>

                        <td
                            colspan="9"
                            class="empty-data"
                        >

                            😔 Tidak ada data pelanggan
                            dengan status tersebut.

                        </td>

                    </tr>

                <?php

                }

                ?>

                </tbody>

            </table>

        </div>

    </div>

</div>


</body>

</html>
<?php
session_start();
include "../koneksi.php";

$query = mysqli_query($koneksi, "
    SELECT
        id_pelanggan,
        no_pelanggan,
        nama_pelanggan,
        alamat,
        kelurahan,
        Kondisi_Meter,
        jenis_pelanggan
    FROM pelanggan
    ORDER BY id_pelanggan DESC
");

if (!$query) {
    die("Query gagal: " . mysqli_error($koneksi));
}
?>

<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">

<meta name="viewport"
      content="width=device-width, initial-scale=1.0">

<title>Data Umum - Teknisi</title>

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
   LOGO SAMAR
===================================================== */

.logo-samar{
    position:fixed;
    width:330px;
    height:auto;
    opacity:0.09;
    top:55%;
    left:63%;
    transform:translate(-50%,-50%);
    pointer-events:none;
    z-index:0;
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
    padding:28px 32px;
    margin-bottom:22px;
    box-shadow:0 5px 18px rgba(0,95,170,.10);
    overflow:hidden;
}


.page-header:after{
    content:"";
    position:absolute;
    right:-80px;
    top:-100px;
    width:280px;
    height:280px;
    border-radius:50%;
    background:rgba(24,143,231,.10);
}


.page-header h1{
    position:relative;
    z-index:1;
    color:#0755a0;
    font-size:30px;
    font-weight:bold;
    margin-bottom:8px;
}


.page-header p{
    position:relative;
    z-index:1;
    margin:0;
    color:#657b94;
    font-size:15px;
    line-height:1.6;
}


/* =====================================================
   TABLE CARD
===================================================== */

.table-card{
    position:relative;
    z-index:2;
    background:rgba(255,255,255,.95);
    border-radius:20px;
    padding:25px;
    box-shadow:0 5px 18px rgba(0,80,150,.10);
}


/* =====================================================
   TABLE HEADER
===================================================== */

.table-heading{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:20px;
}


.table-heading h3{
    margin:0;
    color:#174879;
    font-size:22px;
    font-weight:bold;
}


.table-heading p{
    margin:5px 0 0;
    color:#71859b;
    font-size:13px;
}


/* =====================================================
   JUMLAH DATA
===================================================== */

.data-count{
    background:#e8f4ff;
    color:#0755a0;
    padding:9px 15px;
    border-radius:20px;
    font-size:13px;
    font-weight:bold;
}


/* =====================================================
   TABLE
===================================================== */

.table-responsive{
    border-radius:13px;
    overflow:auto;
}


.table{
    vertical-align:middle;
    white-space:nowrap;
    margin-bottom:0;
}


/* HEADER TABLE */

.table thead th{
    background:#0878d8;
    color:white;
    border-color:#0878d8;
    padding:14px 13px;
    font-size:14px;
    font-weight:bold;
}


/* ISI TABLE */

.table tbody td{
    padding:14px 13px;
    font-size:14px;
    color:#354f6b;
    border-color:#e1edf7;
}


.table tbody tr{
    background:white;
    transition:.2s;
}


.table tbody tr:hover{
    background:#f0f8ff;
    transform:scale(1.001);
}


/* =====================================================
   NOMOR
===================================================== */

.nomor{
    width:50px;
    text-align:center;
    font-weight:bold;
    color:#0755a0 !important;
}


/* =====================================================
   NPA
===================================================== */

.npa{
    font-weight:bold;
    color:#0755a0 !important;
}


/* =====================================================
   NAMA
===================================================== */

.nama{
    font-weight:bold;
    color:#294e73 !important;
}


/* =====================================================
   BADGE KONDISI METER
===================================================== */

.meter-hilang{
    display:inline-block;
    background:#ffe1e1;
    color:#b42318;
    padding:7px 12px;
    border-radius:20px;
    font-size:12px;
    font-weight:bold;
}


.meter-pecah{
    display:inline-block;
    background:#fff0bd;
    color:#8a6800;
    padding:7px 12px;
    border-radius:20px;
    font-size:12px;
    font-weight:bold;
}


.meter-kosong{
    display:inline-block;
    background:#e9eef3;
    color:#687787;
    padding:7px 12px;
    border-radius:20px;
    font-size:12px;
    font-weight:bold;
}


/* =====================================================
   FOOTER INFO
===================================================== */

.table-footer{
    margin-top:18px;
    padding-top:15px;
    border-top:1px solid #e2edf6;
    color:#71859b;
    font-size:13px;
}


.table-footer span{
    color:#0755a0;
    font-weight:bold;
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

    .table-heading{
        flex-direction:column;
        align-items:flex-start;
        gap:12px;
    }

}

</style>

</head>


<body>


<!-- =====================================================
     LOGO SAMAR
===================================================== -->

<img
    src="../assets/logo-tirtanadi.jpg"
    class="logo-samar"
    alt="Logo Tirtanadi"
>


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


    <a href="data_umum.php"
       class="active">

        <span class="sidebar-icon">
            👥
        </span>

        Data Umum

    </a>


    <a href="status_pemasangan.php">

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


    <!-- BACKGROUND -->

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
            👥 Data Umum Pelanggan
        </h1>

        <p>
            Informasi data pelanggan yang terdaftar
            pada Sistem Informasi Pemasangan Meter.
            <br>
            Data ditampilkan secara terhubung dengan data pelanggan.
        </p>

    </div>



    <!-- =================================================
         TABLE CARD
    ================================================== -->

    <div class="table-card">


        <div class="table-heading">

            <div>

                <h3>
                    📊 Daftar Data Pelanggan
                </h3>

                <p>
                    Data pelanggan Perumda Tirtanadi Cabang Medan Denai
                </p>

            </div>


            <?php

            $jumlah_data = mysqli_num_rows($query);

            ?>

            <div class="data-count">

                👥 <?= $jumlah_data; ?> Data Pelanggan

            </div>

        </div>



        <!-- =================================================
             TABLE
        ================================================== -->

        <div class="table-responsive">

            <table class="table table-bordered table-hover">


                <thead>

                    <tr>

                        <th>
                            No
                        </th>

                        <th>
                            NPA
                        </th>

                        <th>
                            Nama Pelanggan
                        </th>

                        <th>
                            Alamat
                        </th>

                        <th>
                            Kelurahan
                        </th>

                        <th>
                            Kondisi Meter
                        </th>

                        <th>
                            Jenis Pelanggan
                        </th>

                    </tr>

                </thead>


                <tbody>

                <?php

                $no = 1;

                if(mysqli_num_rows($query) > 0){

                    while ($row = mysqli_fetch_assoc($query)) {

                ?>

                    <tr>


                        <!-- NO -->

                        <td class="nomor">

                            <?= $no++; ?>

                        </td>


                        <!-- NPA -->

                        <td class="npa">

                            <?= htmlspecialchars(
                                $row['no_pelanggan']
                            ); ?>

                        </td>


                        <!-- NAMA -->

                        <td class="nama">

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
                                $row['kelurahan']
                            ); ?>

                        </td>


                        <!-- KONDISI METER -->

                        <td>

                            <?php

                            if(
                                $row['Kondisi_Meter']
                                == "Meter Hilang"
                            ){

                                echo '
                                <span class="meter-hilang">
                                    🔴 Meter Hilang
                                </span>
                                ';

                            }

                            elseif(
                                $row['Kondisi_Meter']
                                == "Meter Pecah"
                            ){

                                echo '
                                <span class="meter-pecah">
                                    🟡 Meter Pecah
                                </span>
                                ';

                            }

                            else{

                                echo '
                                <span class="meter-kosong">
                                    ⚪ Belum Ada Kondisi
                                </span>
                                ';

                            }

                            ?>

                        </td>


                        <!-- JENIS PELANGGAN -->

                        <td>

                            <?= htmlspecialchars(
                                $row['jenis_pelanggan']
                            ); ?>

                        </td>


                    </tr>

                <?php

                    }

                }
                else{

                ?>

                    <tr>

                        <td
                            colspan="7"
                            style="text-align:center;padding:35px;color:#71859b;"
                        >

                            😔 Belum ada data pelanggan.

                        </td>

                    </tr>

                <?php

                }

                ?>

                </tbody>

            </table>

        </div>



        <!-- =================================================
             FOOTER TABLE
        ================================================== -->

        <div class="table-footer">

            💡 Data yang ditampilkan merupakan data pelanggan
            yang tersimpan pada sistem.

            <br>

            Total data saat ini:
            <span><?= $jumlah_data; ?> pelanggan</span>

        </div>


    </div>

</div>


</body>

</html>
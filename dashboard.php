<?php
session_start();
include "../koneksi.php";

/* =====================================================
   HITUNG JUMLAH STATUS PEMASANGAN
===================================================== */

$jumlah_menunggu = 0;
$jumlah_proses = 0;
$jumlah_selesai = 0;


/* MENUNGGU */

$query_menunggu = mysqli_query($koneksi, "
    SELECT COUNT(*) AS jumlah
    FROM pelanggan
    WHERE status_pemasangan = 'Menunggu'
");

if ($query_menunggu) {
    $hasil = mysqli_fetch_assoc($query_menunggu);
    $jumlah_menunggu = $hasil['jumlah'];
}


/* PROSES */

$query_proses = mysqli_query($koneksi, "
    SELECT COUNT(*) AS jumlah
    FROM pelanggan
    WHERE status_pemasangan = 'Proses Pemasangan'
");

if ($query_proses) {
    $hasil = mysqli_fetch_assoc($query_proses);
    $jumlah_proses = $hasil['jumlah'];
}


/* SUDAH DIPASANG */

$query_selesai = mysqli_query($koneksi, "
    SELECT COUNT(*) AS jumlah
    FROM pelanggan
    WHERE status_pemasangan = 'Sudah Dipasang'
");

if ($query_selesai) {
    $hasil = mysqli_fetch_assoc($query_selesai);
    $jumlah_selesai = $hasil['jumlah'];
}

?>

<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">

<meta name="viewport"
      content="width=device-width, initial-scale=1.0">

<title>Dashboard Teknisi</title>


<style>

/* =====================================================
   RESET
===================================================== */

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:Arial, sans-serif;
}


/* =====================================================
   BODY
===================================================== */

body{
    background:#eef7ff;
    color:#173b67;
}


/* =====================================================
   LOGO SAMAR DI BERANDA
===================================================== */

.logo-samar{
    position:fixed;

    width:350px;
    height:auto;

    opacity:0.10;

    top:50%;
    left:60%;

    transform:translate(-50%, -50%);

    pointer-events:none;

    z-index:0;
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

    background:linear-gradient(
        180deg,
        #0876d9,
        #0053ad
    );

    color:white;

    z-index:1000;

    padding-top:20px;

    box-shadow:
        4px 0 15px rgba(0,0,0,.12);
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

    padding:15px 22px;

    margin:6px 14px;

    border-radius:12px;

    font-size:16px;

    transition:.3s;
}


.sidebar a:hover{
    background:rgba(255,255,255,.20);

    transform:translateX(3px);
}


.sidebar a.active{
    background:rgba(255,255,255,.20);

    border-left:5px solid white;
}


.sidebar-icon{
    width:27px;

    text-align:center;

    font-size:21px;
}


/* =====================================================
   MAIN
===================================================== */

.main{
    margin-left:245px;

    min-height:100vh;

    padding:20px 35px;

    position:relative;

    overflow:hidden;
}


/* =====================================================
   BUBBLE BACKGROUND
===================================================== */

.bubble{
    position:absolute;

    border-radius:50%;

    background:rgba(80,180,255,.13);

    border:1px solid
        rgba(255,255,255,.6);

    pointer-events:none;
}


.b1{
    width:130px;
    height:130px;

    right:45px;
    top:100px;
}


.b2{
    width:65px;
    height:65px;

    right:210px;
    top:170px;
}


.b3{
    width:45px;
    height:45px;

    left:290px;
    bottom:90px;
}


.b4{
    width:85px;
    height:85px;

    right:100px;
    bottom:50px;
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

    z-index:5;
}


.user-box{
    display:flex;

    align-items:center;

    gap:10px;

    background:white;

    padding:8px 18px;

    border-radius:30px;

    box-shadow:
        0 3px 12px rgba(0,0,0,.08);
}


.user-icon{
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
   WELCOME
===================================================== */

.welcome{
    position:relative;

    z-index:2;

    background:
        linear-gradient(
            110deg,
            #e5f5ff,
            #ffffff
        );

    border-radius:20px;

    padding:32px 40px;

    margin-bottom:25px;

    box-shadow:
        0 5px 18px
        rgba(0,95,170,.10);

    overflow:hidden;
}


.welcome:after{
    content:"";

    position:absolute;

    right:-70px;
    top:-110px;

    width:280px;
    height:280px;

    border-radius:50%;

    background:
        rgba(24,143,231,.10);
}


.welcome h1{
    color:#0755a0;

    font-size:32px;

    margin-bottom:10px;

    position:relative;

    z-index:2;
}


.welcome p{
    font-size:15px;

    line-height:1.7;

    color:#45647f;

    position:relative;

    z-index:2;
}


/* =====================================================
   JUDUL BAGIAN
===================================================== */

.section-title{
    position:relative;

    z-index:2;

    margin:25px 0 16px;

    font-size:22px;

    font-weight:bold;

    color:#174879;
}


/* =====================================================
   KARTU STATUS
===================================================== */

.status-row{
    position:relative;

    z-index:2;

    display:grid;

    grid-template-columns:
        repeat(3, 1fr);

    gap:20px;

    width:100%;
}


.status-link{
    text-decoration:none;

    color:inherit;

    display:block;

    width:100%;
}


.status-card{
    background:white;

    border-radius:18px;

    padding:22px;

    min-height:180px;

    position:relative;

    overflow:hidden;

    box-shadow:
        0 5px 15px
        rgba(0,80,150,.10);

    transition:.3s;
}


.status-card:hover{
    transform:translateY(-6px);

    box-shadow:
        0 10px 25px
        rgba(0,80,150,.18);
}


/* =====================================================
   ICON STATUS
===================================================== */

.status-icon{
    width:55px;
    height:55px;

    border-radius:50%;

    display:flex;

    align-items:center;

    justify-content:center;

    font-size:27px;

    margin-bottom:14px;
}


.wait-icon{
    background:#fff0bd;
}


.process-icon{
    background:#dceaff;
}


.done-icon{
    background:#d8f6e7;
}


/* =====================================================
   JUMLAH
===================================================== */

.jumlah{
    font-size:32px;

    font-weight:bold;

    color:#174879;

    margin-bottom:4px;
}


/* =====================================================
   JUDUL STATUS
===================================================== */

.status-card h4{
    font-size:16px;

    margin-bottom:7px;

    color:#174879;
}


/* =====================================================
   KETERANGAN
===================================================== */

.status-card p{
    color:#6b8196;

    font-size:13px;
}


/* =====================================================
   PANAH
===================================================== */

.arrow{
    position:absolute;

    right:20px;
    top:22px;

    width:35px;
    height:35px;

    border-radius:50%;

    background:#e8f3fc;

    display:flex;

    align-items:center;

    justify-content:center;

    color:#0876d9;

    font-size:19px;
}


/* =====================================================
   MENU UTAMA
===================================================== */

.menu-area{
    position:relative;

    z-index:2;

    background:rgba(255,255,255,.80);

    border-radius:20px;

    padding:25px;

    margin-top:28px;

    box-shadow:
        0 5px 18px
        rgba(0,80,150,.08);
}


.menu-title{
    font-size:22px;

    font-weight:bold;

    color:#174879;

    margin-bottom:18px;
}


.menu-row{
    display:grid;

    grid-template-columns:
        repeat(2, 1fr);

    gap:20px;
}


.menu-link{
    text-decoration:none;

    color:inherit;

    display:block;
}


.menu-card{
    background:white;

    border-radius:17px;

    padding:23px;

    min-height:150px;

    position:relative;

    border:1px solid #e1edf7;

    transition:.3s;

    box-shadow:
        0 4px 12px
        rgba(0,80,150,.06);
}


.menu-card:hover{
    transform:translateY(-5px);

    box-shadow:
        0 8px 20px
        rgba(0,80,150,.14);
}


.menu-icon{
    width:52px;

    height:52px;

    border-radius:50%;

    display:flex;

    align-items:center;

    justify-content:center;

    font-size:25px;

    margin-bottom:13px;
}


.blue{
    background:#dceeff;
}


.purple{
    background:#e8e0ff;
}


.menu-card h4{
    color:#15518d;

    font-size:18px;

    margin-bottom:7px;
}


.menu-card p{
    color:#6a8196;

    font-size:13px;
}


.menu-arrow{
    position:absolute;

    right:20px;

    bottom:20px;

    width:34px;
    height:34px;

    border-radius:50%;

    background:#0878d8;

    color:white;

    display:flex;

    align-items:center;

    justify-content:center;
}


/* =====================================================
   RESPONSIVE
===================================================== */

@media(max-width:850px){

    .sidebar{
        width:210px;
    }

    .main{
        margin-left:210px;

        padding:20px;
    }

    .status-row{
        gap:12px;
    }

    .status-card{
        padding:16px;
    }

}


@media(max-width:650px){

    .sidebar{
        position:relative;

        width:100%;

        height:auto;
    }

    .main{
        margin-left:0;
    }

    .status-row{
        grid-template-columns:1fr;
    }

    .menu-row{
        grid-template-columns:1fr;
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


    <a
        href="dashboard.php"
        class="active"
    >

        <span class="sidebar-icon">
            🏠
        </span>

        Dashboard

    </a>


    <a href="data_umum.php">

        <span class="sidebar-icon">
            👥
        </span>

        Data Umum

    </a>


    <a href="status_pemasangan.php">

        <span class="sidebar-icon">
            📋
        </span>

        Status Pemasangan

    </a>


    <a href="../logout.php">

        <span class="sidebar-icon">
            🚪
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

        <div class="user-box">

            <div class="user-icon">
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
         WELCOME
    ================================================== -->

    <div class="welcome">

        <h1>
            👋 Selamat Datang, Teknisi
        </h1>

        <p>
            Sistem Informasi Pemasangan Meter bagi Teknisi
            Perumda Tirtanadi Cabang Medan Denai.
        </p>

        <p>
            Kelola data pelanggan dan pantau status pemasangan
            meter dengan lebih mudah dan cepat.
        </p>

    </div>



    <!-- =================================================
         RINGKASAN STATUS
    ================================================== -->

    <div class="section-title">

        📊 Ringkasan Status Pemasangan

    </div>


    <div class="status-row">


        <!-- MENUNGGU -->

        <a
            href="status_pemasangan.php?status=Menunggu"
            class="status-link"
        >

            <div class="status-card">

                <div class="status-icon wait-icon">
                    🕐
                </div>

                <div class="arrow">
                    →
                </div>

                <div class="jumlah">
                    <?php echo $jumlah_menunggu; ?>
                </div>

                <h4>
                    Menunggu Pemasangan
                </h4>

                <p>
                    Pelanggan yang menunggu pemasangan.
                </p>

            </div>

        </a>



        <!-- PROSES -->

        <a
            href="status_pemasangan.php?status=Proses%20Pemasangan"
            class="status-link"
        >

            <div class="status-card">

                <div class="status-icon process-icon">
                    🔧
                </div>

                <div class="arrow">
                    →
                </div>

                <div class="jumlah">
                    <?php echo $jumlah_proses; ?>
                </div>

                <h4>
                    Proses Pemasangan
                </h4>

                <p>
                    Pemasangan sedang berlangsung.
                </p>

            </div>

        </a>



        <!-- SUDAH DIPASANG -->

        <a
            href="status_pemasangan.php?status=Sudah%20Dipasang"
            class="status-link"
        >

            <div class="status-card">

                <div class="status-icon done-icon">
                    ✓
                </div>

                <div class="arrow">
                    →
                </div>

                <div class="jumlah">
                    <?php echo $jumlah_selesai; ?>
                </div>

                <h4>
                    Sudah Dipasang
                </h4>

                <p>
                    Pelanggan yang sudah dipasang.
                </p>

            </div>

        </a>


    </div>



    <!-- =================================================
         MENU UTAMA
    ================================================== -->

    <div class="menu-area">


        <div class="menu-title">
            📌 Menu Utama
        </div>


        <div class="menu-row">


            <!-- DATA UMUM -->

            <a
                href="data_umum.php"
                class="menu-link"
            >

                <div class="menu-card">

                    <div class="menu-icon blue">
                        👥
                    </div>

                    <h4>
                        Data Umum
                    </h4>

                    <p>
                        Melihat data pelanggan.
                    </p>

                    <div class="menu-arrow">
                        →
                    </div>

                </div>

            </a>



            <!-- STATUS PEMASANGAN -->

            <a
                href="status_pemasangan.php"
                class="menu-link"
            >

                <div class="menu-card">

                    <div class="menu-icon purple">
                        📋
                    </div>

                    <h4>
                        Status Pemasangan
                    </h4>

                    <p>
                        Memantau seluruh status pemasangan.
                    </p>

                    <div class="menu-arrow">
                        →
                    </div>

                </div>

            </a>


        </div>

    </div>


</div>


</body>

</html>
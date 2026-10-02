<?php
session_start();
include "../koneksi.php";

if (isset($_POST['simpan'])) {

    $no_pelanggan    = $_POST['no_pelanggan'];
    $nama_pelanggan  = $_POST['nama_pelanggan'];
    $alamat          = $_POST['alamat'];
    $no_hp           = $_POST['no_hp'];
    $kelurahan       = $_POST['kelurahan'];
    $kondisi_meter   = $_POST['Kondisi_Meter'];
    $jenis_pelanggan = $_POST['jenis_pelanggan'];

    $query = mysqli_query($koneksi, "
        INSERT INTO pelanggan
        (
            no_pelanggan,
            nama_pelanggan,
            alamat,
            no_hp,
            kelurahan,
            Kondisi_Meter,
            jenis_pelanggan
        )
        VALUES
        (
            '$no_pelanggan',
            '$nama_pelanggan',
            '$alamat',
            '$no_hp',
            '$kelurahan',
            '$kondisi_meter',
            '$jenis_pelanggan'
        )
    ");

    if ($query) {

        echo "<script>
            alert('Data pelanggan berhasil disimpan');
            window.location='data_umum.php';
        </script>";

        exit;

    } else {

        echo "Data gagal disimpan: " . mysqli_error($koneksi);

    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Input Data Pelanggan</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
    margin:0;
    font-family:Arial, sans-serif;
    background:#f4f6f9;
}

/* SIDEBAR */

.sidebar{
    position:fixed;
    left:0;
    top:0;
    width:250px;
    height:100vh;
    background:#0d6efd;
    padding:15px;
    box-sizing:border-box;
    z-index:10;
}

/* LOGO */

.logo-tirtanadi{
    display:block;
    width:75px;
    height:75px;
    object-fit:contain;
    margin:15px auto 10px;
}

/* JUDUL SIDEBAR */

.sidebar h2{
    color:white;
    text-align:center;
    margin:0 0 20px 0;
    font-size:28px;
}

/* MENU */

.sidebar a{
    display:block;
    color:white;
    text-decoration:none;
    padding:13px 15px;
    margin-bottom:5px;
    border-radius:8px;
}

.sidebar a:hover{
    background:rgba(255,255,255,0.2);
}

/* HALAMAN UTAMA */

.main{
    margin-left:250px;
    padding:30px;
    min-height:100vh;
    position:relative;
    overflow:hidden;
}

/* LOGO SAMAR */

.main::before{
    content:"";
    position:fixed;
    top:50%;
    left:calc(50% + 125px);

    width:350px;
    height:350px;

    transform:translate(-50%, -50%);

    background-image:url('/pemasangan_meter/assets/logo-tirtanadi.jpg');

    background-repeat:no-repeat;
    background-position:center;
    background-size:contain;

    opacity:0.30;

    pointer-events:none;

    z-index:0;
}

/* CARD */

.card{
    position:relative;
    z-index:1;

    border:none;
    border-radius:12px;

    box-shadow:0 4px 10px rgba(0,0,0,0.1);

    background:rgba(255,255,255,0.82);
}

/* INPUT */

.form-control{
    background:rgba(255,255,255,0.90);
}

</style>

</head>

<body>


<!-- SIDEBAR -->

<div class="sidebar">

    <img
        src="/pemasangan_meter/assets/logo-tirtanadi.jpg"
        alt="Logo Tirtanadi"
        class="logo-tirtanadi"
    >

    <h2>ADMIN</h2>

    <a href="dashboard.php">
        🏠 Dashboard
    </a>

    <a href="data_umum.php">
        👤 Data Umum
    </a>

    <a href="status_pemasangan.php">
        📋 Status Pemasangan
    </a>

    <a href="input.php">
        ➕ Input
    </a>

    <a href="../logout.php">
        🚪 Logout
    </a>

</div>


<!-- HALAMAN UTAMA -->

<div class="main">

    <div class="card">

        <div class="card-body">

            <h3 class="mb-4">
                ➕ Input Data Pelanggan
            </h3>


            <form method="POST">


                <!-- NPA -->

                <div class="mb-3">

                    <label class="form-label">
                        NPA
                    </label>

                    <input
                        type="text"
                        name="no_pelanggan"
                        class="form-control"
                        required
                    >

                </div>


                <!-- NAMA PELANGGAN -->

                <div class="mb-3">

                    <label class="form-label">
                        Nama Pelanggan
                    </label>

                    <input
                        type="text"
                        name="nama_pelanggan"
                        class="form-control"
                        required
                    >

                </div>


                <!-- ALAMAT -->

                <div class="mb-3">

                    <label class="form-label">
                        Alamat
                    </label>

                    <textarea
                        name="alamat"
                        class="form-control"
                        rows="3"
                        required
                    ></textarea>

                </div>


                <!-- KELURAHAN -->

                <div class="mb-3">

                    <label class="form-label">
                        Kelurahan
                    </label>

                    <input
                        type="text"
                        name="kelurahan"
                        class="form-control"
                        required
                    >

                </div>


                <!-- KONDISI METER -->

                <div class="mb-3">

                    <label class="form-label">
                        Kondisi Meter
                    </label>

                    <select
                        name="Kondisi_Meter"
                        class="form-control"
                        required
                    >

                        <option value="">
                            -- Pilih Kondisi Meter --
                        </option>

                        <option value="Meter Hilang">
                            Meter Hilang
                        </option>

                        <option value="Meter Pecah">
                            Meter Pecah
                        </option>

                    </select>

                </div>


                <!-- JENIS PELANGGAN -->

                <div class="mb-3">

                    <label class="form-label">
                        Jenis Pelanggan
                    </label>

                    <select
                        name="jenis_pelanggan"
                        class="form-control"
                        required
                    >

                        <option value="">
                            -- Pilih Jenis Pelanggan --
                        </option>

                        <option value="Rumah Tangga">
                            Rumah Tangga
                        </option>

                        <option value="Niaga">
                            Niaga
                        </option>

                        <option value="Sosial">
                            Sosial
                        </option>

                        <option value="Instansi Pemerintah">
                            Instansi Pemerintah
                        </option>

                    </select>

                </div>


                <!-- NO HP -->

                <div class="mb-3">

                    <label class="form-label">
                        No HP
                    </label>

                    <input
                        type="text"
                        name="no_hp"
                        class="form-control"
                        required
                    >

                </div>


                <!-- TOMBOL -->

                <button
                    type="submit"
                    name="simpan"
                    class="btn btn-primary"
                >
                    💾 Simpan
                </button>

                <a
                    href="data_umum.php"
                    class="btn btn-secondary"
                >
                    Kembali
                </a>


            </form>

        </div>

    </div>

</div>

</body>

</html>
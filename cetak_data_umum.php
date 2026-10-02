<?php
session_start();
include "../koneksi.php";

$query = mysqli_query($koneksi, "
    SELECT
        id_pelanggan,
        no_pelanggan,
        nama_pelanggan,
        alamat,
        no_hp,
        Kelurahan,
        Kondisi_Meter,
        Jenis_Pelanggan,
        status_pemasangan
    FROM pelanggan
    ORDER BY id_pelanggan DESC
");

if (!$query) {
    die("Query gagal: " . mysqli_error($koneksi));
}

$tanggal_cetak = date("d-m-Y");
?>

<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Laporan Data Umum Pelanggan</title>

<style>

*{
    box-sizing:border-box;
}

body{
    margin:0;
    padding:0;
    font-family:Arial, sans-serif;
    background:white;
    color:#111;
}

.laporan{
    width:95%;
    margin:30px auto;
    position:relative;
}


/* =========================
   HEADER
========================= */

.header{
    position:relative;
    min-height:110px;
    border-bottom:2px solid #111;
    padding-bottom:10px;
}


/* LOGO TIRTANADI */

.logo{
    position:absolute;
    left:10px;
    top:0;
    width:90px;
    height:90px;
    object-fit:contain;
}


/* NAMA PERUSAHAAN */

.nama-perusahaan{
    text-align:center;
    margin-left:100px;
    padding-top:5px;
}

.nama-perusahaan h1{
    margin:0;
    font-size:25px;
    font-weight:bold;
}

.nama-perusahaan h2{
    margin:5px 0 8px;
    font-size:20px;
    font-weight:bold;
}

.nama-perusahaan p{
    margin:0;
    font-size:14px;
}


/* =========================
   LOGO SAMAR
========================= */

.logo-samar{
    position:absolute;

    width:350px;
    height:350px;

    top:55%;
    left:50%;

    transform:translate(-50%, -50%);

    opacity:0.10;

    object-fit:contain;

    z-index:0;

    pointer-events:none;
}


/* =========================
   JUDUL LAPORAN
========================= */

.judul-laporan{
    text-align:center;
    margin-top:25px;
    position:relative;
    z-index:1;
}

.judul-laporan h2{
    margin:0;
    font-size:20px;
    font-weight:bold;
}

.judul-laporan p{
    margin-top:8px;
    font-size:13px;
}


/* =========================
   TABEL
========================= */

.table-container{
    position:relative;
    z-index:1;
    margin-top:20px;
}

table{
    width:100%;
    border-collapse:collapse;
    font-size:10px;
}

th,
td{
    border:1px solid #555;
    padding:7px 4px;
    text-align:center;
    vertical-align:middle;
}

th{
    background:#d9eaf7;
    font-weight:bold;
}

td.alamat{
    text-align:left;
}


/* =========================
   TANDA TANGAN
========================= */

.tanda-tangan{
    position:relative;
    z-index:1;

    margin-top:35px;
    margin-left:auto;

    width:180px;

    text-align:center;
    font-size:13px;
}

.tanda-tangan .garis{
    margin-top:55px;
    border-bottom:1px solid #111;
}


/* =========================
   TOMBOL KEMBALI
========================= */

.tombol-kembali{
    text-align:center;
    margin:30px 0;

    position:relative;
    z-index:5;
}

.tombol-kembali a{
    display:inline-block;

    padding:10px 20px;

    background:#6c757d;

    color:white;

    text-decoration:none;

    border-radius:6px;

    font-size:14px;
}

.tombol-kembali a:hover{
    background:#5a6268;
}


/* =========================
   PRINT
========================= */

@media print{

    body{
        background:white;
    }

    .laporan{
        width:100%;
        margin:0;
    }

    .tombol-kembali{
        display:none;
    }

    .header{
        page-break-inside:avoid;
    }

    table{
        page-break-inside:auto;
    }

    tr{
        page-break-inside:avoid;
        page-break-after:auto;
    }

    thead{
        display:table-header-group;
    }

    @page{
        size:A4 landscape;
        margin:15mm;
    }

}

</style>

</head>


<body>


<div class="laporan">


    <!-- =========================
         HEADER
    ========================= -->

    <div class="header">

        <img
            src="../assets/logo-tirtanadi.jpg"
            class="logo"
            alt="Logo Tirtanadi"
        >


        <div class="nama-perusahaan">

            <h1>
                PERUMDA TIRTANADI
            </h1>

            <h2>
                CABANG MEDAN DENAI
            </h2>

            <p>
                Jalan Garuda Raya Nomor 107, Tegal Sari Mandala II,
                Kecamatan Medan Denai, Kota Medan
            </p>

        </div>

    </div>


    <!-- =========================
         LOGO SAMAR
    ========================= -->

    <img
        src="../assets/logo-tirtanadi.jpg"
        class="logo-samar"
        alt="Logo Tirtanadi"
    >


    <!-- =========================
         JUDUL LAPORAN
    ========================= -->

    <div class="judul-laporan">

        <h2>
            LAPORAN DATA UMUM PELANGGAN
        </h2>

        <p>
            Tanggal Cetak: <?= $tanggal_cetak; ?>
        </p>

    </div>


    <!-- =========================
         TABEL
    ========================= -->

    <div class="table-container">

        <table>

            <thead>

                <tr>

                    <th>No</th>

                    <th>NPA</th>

                    <th>Nama<br>Pelanggan</th>

                    <th>Alamat</th>

                    <th>No HP</th>

                    <th>Kelurahan</th>

                    <th>Kondisi<br>Meter</th>

                    <th>Jenis<br>Pelanggan</th>

                    <th>Status<br>Pemasangan</th>

                </tr>

            </thead>


            <tbody>

            <?php

            $no = 1;

            if (mysqli_num_rows($query) > 0) {

                while ($row = mysqli_fetch_assoc($query)) {

            ?>

                <tr>

                    <td>
                        <?= $no++; ?>
                    </td>

                    <td>
                        <?= htmlspecialchars($row['no_pelanggan']); ?>
                    </td>

                    <td>
                        <?= htmlspecialchars($row['nama_pelanggan']); ?>
                    </td>

                    <td class="alamat">
                        <?= htmlspecialchars($row['alamat']); ?>
                    </td>

                    <td>
                        <?= htmlspecialchars($row['no_hp']); ?>
                    </td>

                    <td>
                        <?= htmlspecialchars($row['Kelurahan']); ?>
                    </td>


                    <!-- KONDISI METER -->

                    <td>

                        <?php

                        if ($row['Kondisi_Meter'] == "Meter Hilang") {

                            echo "Meter Hilang";

                        } elseif ($row['Kondisi_Meter'] == "Meter Pecah") {

                            echo "Meter Pecah";

                        } else {

                            echo "-";

                        }

                        ?>

                    </td>


                    <!-- JENIS PELANGGAN -->

                    <td>
                        <?= htmlspecialchars($row['Jenis_Pelanggan']); ?>
                    </td>


                    <!-- STATUS PEMASANGAN -->

                    <td>

                        <?php

                        if ($row['status_pemasangan'] == "Menunggu") {

                            echo "Menunggu";

                        } elseif ($row['status_pemasangan'] == "Proses Pemasangan") {

                            echo "Proses Pemasangan";

                        } elseif ($row['status_pemasangan'] == "Sudah Dipasang") {

                            echo "Sudah Dipasang";

                        } else {

                            echo "Belum Ada Status";

                        }

                        ?>

                    </td>

                </tr>

            <?php

                }

            } else {

            ?>

                <tr>

                    <td colspan="9">
                        Tidak ada data pelanggan
                    </td>

                </tr>

            <?php

            }

            ?>

            </tbody>

        </table>

    </div>


    <!-- =========================
         TANDA TANGAN
    ========================= -->

    <div class="tanda-tangan">

        Medan, <?= $tanggal_cetak; ?>

        <br><br>

        Pimpinan

        <div class="garis"></div>

    </div>


    <!-- =========================
         TOMBOL KEMBALI
    ========================= -->

    <div class="tombol-kembali">

        <a href="data_umum.php">
            ← Kembali ke Data Umum
        </a>

    </div>


</div>


<!-- =========================
     OTOMATIS BUKA PRINT
========================= -->

<script>

window.onload = function(){

    window.print();

};

</script>


</body>

</html>
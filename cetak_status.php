<?php
session_start();
include "../koneksi.php";

/* =========================
   AMBIL FILTER STATUS
========================= */

$status_filter = "";

if (isset($_GET['status'])) {
    $status_filter = $_GET['status'];
}


/* =========================
   QUERY DATA
========================= */

if ($status_filter != "") {

    $status_filter = mysqli_real_escape_string(
        $koneksi,
        $status_filter
    );

    $query = mysqli_query($koneksi, "
        SELECT
            id_pelanggan,
            no_pelanggan,
            nama_pelanggan,
            alamat,
            Kelurahan,
            Kondisi_Meter,
            Jenis_Pelanggan,
            status_pemasangan
        FROM pelanggan
        WHERE status_pemasangan = '$status_filter'
        ORDER BY id_pelanggan DESC
    ");

} else {

    $query = mysqli_query($koneksi, "
        SELECT
            id_pelanggan,
            no_pelanggan,
            nama_pelanggan,
            alamat,
            Kelurahan,
            Kondisi_Meter,
            Jenis_Pelanggan,
            status_pemasangan
        FROM pelanggan
        ORDER BY id_pelanggan DESC
    ");

}


/* =========================
   CEK QUERY
========================= */

if (!$query) {

    die(
        "Query gagal: " .
        mysqli_error($koneksi)
    );

}


/* =========================
   TANGGAL
========================= */

$tanggal_cetak = date("d-m-Y");

?>

<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">

<meta name="viewport"
      content="width=device-width, initial-scale=1.0">

<title>
    Laporan Status Pemasangan Meter
</title>


<style>

/* =========================
   BODY
========================= */

body {

    margin: 0;

    padding: 0;

    font-family: Arial, sans-serif;

    background: white;

    color: #111;

}


/* =========================
   LAPORAN
========================= */

.laporan {

    width: 95%;

    margin: 30px auto;

    position: relative;

}


/* =========================
   HEADER
========================= */

.header {

    position: relative;

    min-height: 110px;

    border-bottom: 2px solid #111;

    padding-bottom: 10px;

}


/* =========================
   LOGO
========================= */

.logo {

    position: absolute;

    left: 10px;

    top: 0;

    width: 90px;

    height: 90px;

    object-fit: contain;

}


/* =========================
   NAMA PERUSAHAAN
========================= */

.nama-perusahaan {

    text-align: center;

    margin-left: 100px;

    padding-top: 5px;

}


.nama-perusahaan h1 {

    margin: 0;

    font-size: 25px;

    font-weight: bold;

}


.nama-perusahaan h2 {

    margin: 5px 0 8px;

    font-size: 20px;

    font-weight: bold;

}


.nama-perusahaan p {

    margin: 0;

    font-size: 14px;

}


/* =========================
   LOGO SAMAR
========================= */

.logo-samar {

    position: absolute;

    width: 350px;

    height: 350px;

    top: 50%;

    left: 50%;

    transform: translate(-50%, -50%);

    opacity: 0.10;

    object-fit: contain;

    z-index: 0;

    pointer-events: none;

}


/* =========================
   JUDUL
========================= */

.judul-laporan {

    text-align: center;

    margin-top: 25px;

    position: relative;

    z-index: 1;

}


.judul-laporan h2 {

    margin: 0;

    font-size: 20px;

    font-weight: bold;

}


.judul-laporan p {

    margin-top: 8px;

    font-size: 13px;

}


.filter {

    margin-top: 5px;

    font-size: 13px;

    font-weight: bold;

}


/* =========================
   TABEL
========================= */

.table-container {

    position: relative;

    z-index: 1;

    margin-top: 20px;

}


table {

    width: 100%;

    border-collapse: collapse;

    font-size: 11px;

}


th,
td {

    border: 1px solid #555;

    padding: 7px 5px;

    text-align: center;

    vertical-align: middle;

}


th {

    background: #d9eaf7;

    font-weight: bold;

}


td.alamat {

    text-align: left;

}


/* =========================
   TANDA TANGAN
========================= */

.tanda-tangan {

    position: relative;

    z-index: 1;

    margin-top: 35px;

    margin-left: auto;

    width: 180px;

    text-align: center;

    font-size: 13px;

}


.tanda-tangan .garis {

    margin-top: 55px;

    border-bottom: 1px solid #111;

}


/* =========================
   TOMBOL
========================= */

.tombol {

    text-align: center;

    margin: 30px 0;

    position: relative;

    z-index: 10;

}


.btn {

    display: inline-block;

    padding: 10px 18px;

    margin: 3px;

    border: none;

    border-radius: 6px;

    color: white;

    text-decoration: none;

    font-size: 14px;

    font-family: Arial, sans-serif;

    cursor: pointer;

}


/* =========================
   TOMBOL PRINT
========================= */

.btn-print {

    background: #0d6efd;

}


.btn-print:hover {

    background: #0b5ed7;

}


/* =========================
   TOMBOL KEMBALI
========================= */

.btn-kembali {

    background: #6c757d;

}


.btn-kembali:hover {

    background: #5a6268;

}


/* =========================
   PRINT
========================= */

@media print {

    body {

        background: white;

    }


    .laporan {

        width: 100%;

        margin: 0;

    }


    .tombol {

        display: none;

    }


    .header {

        page-break-inside: avoid;

    }


    table {

        page-break-inside: auto;

    }


    tr {

        page-break-inside: avoid;

        page-break-after: auto;

    }


    thead {

        display: table-header-group;

    }


    @page {

        size: A4 landscape;

        margin: 15mm;

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
                Jalan Garuda Raya Nomor 107,
                Tegal Sari Mandala II,
                Kecamatan Medan Denai,
                Kota Medan
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
            LAPORAN STATUS PEMASANGAN METER
        </h2>


        <p>
            Tanggal Cetak:
            <?= $tanggal_cetak; ?>
        </p>


        <?php if ($status_filter != "") { ?>

            <div class="filter">

                Status:
                <?= htmlspecialchars(
                    $status_filter
                ); ?>

            </div>

        <?php } else { ?>

            <div class="filter">

                Semua Status Pemasangan

            </div>

        <?php } ?>


    </div>



    <!-- =========================
         TABEL
========================= -->

    <div class="table-container">


        <table>


            <thead>

                <tr>

                    <th>
                        No
                    </th>

                    <th>
                        NPA
                    </th>

                    <th>
                        Nama<br>Pelanggan
                    </th>

                    <th>
                        Alamat
                    </th>

                    <th>
                        Kelurahan
                    </th>

                    <th>
                        Kondisi<br>Meter
                    </th>

                    <th>
                        Jenis<br>Pelanggan
                    </th>

                    <th>
                        Status<br>Pemasangan
                    </th>

                </tr>

            </thead>


            <tbody>


            <?php

            $no = 1;


            if (
                mysqli_num_rows($query) > 0
            ) {


                while (
                    $row =
                    mysqli_fetch_assoc($query)
                ) {

            ?>


                <tr>


                    <td>
                        <?= $no++; ?>
                    </td>


                    <td>
                        <?= htmlspecialchars(
                            $row['no_pelanggan']
                        ); ?>
                    </td>


                    <td>
                        <?= htmlspecialchars(
                            $row['nama_pelanggan']
                        ); ?>
                    </td>


                    <td class="alamat">
                        <?= htmlspecialchars(
                            $row['alamat']
                        ); ?>
                    </td>


                    <td>
                        <?= htmlspecialchars(
                            $row['Kelurahan']
                        ); ?>
                    </td>


                    <td>

                        <?php

                        if (
                            isset(
                                $row['Kondisi_Meter']
                            )
                            &&
                            $row['Kondisi_Meter'] != ""
                        ) {

                            echo htmlspecialchars(
                                $row['Kondisi_Meter']
                            );

                        } else {

                            echo "-";

                        }

                        ?>

                    </td>


                    <td>
                        <?= htmlspecialchars(
                            $row['Jenis_Pelanggan']
                        ); ?>
                    </td>


                    <td>

                        <?php

                        if (
                            $row['status_pemasangan']
                            == "Menunggu"
                        ) {

                            echo "Menunggu";

                        }

                        elseif (
                            $row['status_pemasangan']
                            == "Proses Pemasangan"
                        ) {

                            echo "Proses Pemasangan";

                        }

                        elseif (
                            $row['status_pemasangan']
                            == "Sudah Dipasang"
                        ) {

                            echo "Sudah Dipasang";

                        }

                        else {

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

                    <td colspan="8">

                        Tidak ada data pelanggan.

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


        Medan,
        <?= $tanggal_cetak; ?>


        <br><br>


        Admin


        <div class="garis"></div>


    </div>



    <!-- =========================
         TOMBOL
========================= -->

    <div class="tombol">


        <!-- TOMBOL PRINT -->

        <button
            type="button"
            onclick="window.print();"
            class="btn btn-print"
        >

            🖨️ Cetak / Print

        </button>



        <!-- TOMBOL KEMBALI -->

        <a
            href="status_pemasangan.php"
            class="btn btn-kembali"
        >

            ← Kembali

        </a>


    </div>


</div>


</body>

</html>
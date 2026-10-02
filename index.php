<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Login Sistem Pemasangan Meter</title>

<link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:Arial, sans-serif;
}

body{

    min-height:100vh;

    background:
        linear-gradient(
            135deg,
            #dff5ff 0%,
            #9edcff 45%,
            #eaf9ff 100%
        );

    display:flex;
    justify-content:center;
    align-items:center;

    overflow:hidden;

    position:relative;
}


/* =================================
   LOGO SAMAR BESAR BACKGROUND
================================= */

body::before{

    content:"";

    position:absolute;

    width:600px;
    height:600px;

    right:-80px;
    top:-100px;

    background:url("assets/logo-tirtanadi.jpg")
    center/contain no-repeat;

    opacity:0.10;

    filter:grayscale(20%);

    z-index:0;
}


/* =================================
   GELEMBUNG AIR
================================= */

.bubble{

    position:absolute;

    border-radius:50%;

    background:
        radial-gradient(
            circle at 30% 25%,
            rgba(255,255,255,.95),
            rgba(255,255,255,.25) 35%,
            rgba(255,255,255,.08) 70%
        );

    border:1px solid rgba(255,255,255,.7);

    box-shadow:
        inset 3px 3px 8px rgba(255,255,255,.7),
        0 5px 15px rgba(40,150,220,.15);

    z-index:0;
}


/* gelembung besar */

.bubble1{
    width:85px;
    height:85px;
    left:6%;
    top:10%;
}

.bubble2{
    width:55px;
    height:55px;
    left:20%;
    top:20%;
}

.bubble3{
    width:35px;
    height:35px;
    left:2%;
    top:34%;
}

.bubble4{
    width:65px;
    height:65px;
    right:8%;
    top:8%;
}

.bubble5{
    width:45px;
    height:45px;
    right:18%;
    top:27%;
}

.bubble6{
    width:75px;
    height:75px;
    right:5%;
    bottom:15%;
}

.bubble7{
    width:35px;
    height:35px;
    left:10%;
    bottom:17%;
}

.bubble8{
    width:50px;
    height:50px;
    left:28%;
    bottom:7%;
}

.bubble9{
    width:25px;
    height:25px;
    right:30%;
    bottom:13%;
}


/* =================================
   GELOMBANG AIR BAWAH
================================= */

.wave{

    position:absolute;

    left:-5%;
    bottom:-100px;

    width:110%;
    height:220px;

    background:#65bdf0;

    border-radius:50% 50% 0 0;

    transform:rotate(-3deg);

    opacity:.65;

    z-index:0;
}


.wave2{

    position:absolute;

    left:-5%;
    bottom:-135px;

    width:110%;
    height:180px;

    background:#bcecff;

    border-radius:50% 50% 0 0;

    transform:rotate(2deg);

    opacity:.9;

    z-index:0;
}


.wave3{

    position:absolute;

    right:-10%;
    bottom:-155px;

    width:80%;
    height:170px;

    background:#299ee5;

    border-radius:50% 50% 0 0;

    transform:rotate(-7deg);

    opacity:.8;

    z-index:0;
}


/* =================================
   CONTAINER UTAMA
================================= */

.container{

    width:1050px;

    max-width:92%;

    min-height:655px;

    display:grid;

    grid-template-columns:1fr 1fr;

    position:relative;

    z-index:5;

    border-radius:25px;

    overflow:hidden;

    box-shadow:
        0 20px 50px rgba(0,90,160,.22);

    background:white;
}


/* =================================
   BAGIAN KIRI
================================= */

.left{

    background:
        linear-gradient(
            145deg,
            #147ddc,
            #1599e8 55%,
            #54c5ef
        );

    color:white;

    display:flex;

    flex-direction:column;

    align-items:center;

    text-align:center;

    padding:65px 35px 35px;

    position:relative;

    overflow:hidden;
}


/* efek cahaya kiri */

.left::before{

    content:"";

    position:absolute;

    width:350px;
    height:350px;

    background:rgba(255,255,255,.08);

    border-radius:50%;

    left:-160px;
    top:-100px;
}


/* =================================
   LOGO
================================= */

.logo{

    width:155px;
    height:155px;

    object-fit:contain;

    background:white;

    border-radius:12px;

    padding:8px;

    margin-bottom:18px;

    box-shadow:
        0 8px 20px rgba(0,0,0,.15);

    position:relative;

    z-index:2;
}


/* =================================
   NAMA PDAM
================================= */

.left h1{

    font-size:29px;

    font-weight:bold;

    letter-spacing:.4px;

    margin-bottom:5px;

    position:relative;

    z-index:2;
}


.left h2{

    font-size:16px;

    letter-spacing:2px;

    font-weight:normal;

    margin-bottom:22px;

    position:relative;

    z-index:2;
}


/* garis */

.garis{

    width:60px;

    height:3px;

    background:white;

    margin-bottom:20px;

    border-radius:5px;

    position:relative;

    z-index:2;
}


/* =================================
   JUDUL SISTEM
================================= */

.judul{

    font-size:22px;

    line-height:1.35;

    font-weight:bold;

    position:relative;

    z-index:2;
}


/* =================================
   DEKORASI GELOMBANG DALAM PANEL
================================= */

.left-wave1{

    position:absolute;

    bottom:-55px;
    left:-20px;

    width:120%;
    height:120px;

    background:rgba(255,255,255,.18);

    border-radius:50%;

    transform:rotate(-5deg);
}


.left-wave2{

    position:absolute;

    bottom:-85px;
    left:-30px;

    width:125%;
    height:120px;

    background:rgba(255,255,255,.12);

    border-radius:50%;

    transform:rotate(5deg);
}


/* =================================
   BAGIAN KANAN
================================= */

.right{

    background:
        linear-gradient(
            135deg,
            #ffffff,
            #f5fbff
        );

    padding:70px 65px;

    display:flex;

    align-items:center;

    position:relative;
}


/* =================================
   KOTAK LOGIN
================================= */

.login-box{

    width:100%;

    position:relative;

    z-index:3;
}


/* =================================
   JUDUL LOGIN
================================= */

.login-box h3{

    color:#1767c5;

    font-size:34px;

    margin-bottom:12px;

    font-weight:bold;
}


.subjudul{

    color:#6c7f96;

    font-size:16px;

    line-height:1.6;

    margin-bottom:34px;
}


/* =================================
   LABEL
================================= */

label{

    display:block;

    color:#19365c;

    font-weight:bold;

    font-size:15px;

    margin-bottom:8px;
}


/* =================================
   INPUT
================================= */

.input-box{

    position:relative;

    margin-bottom:22px;
}


.input-box i{

    position:absolute;

    left:17px;

    top:50%;

    transform:translateY(-50%);

    color:#7893b1;

    font-size:20px;

    z-index:2;
}


.input-box input{

    width:100%;

    height:58px;

    border-radius:12px;

    border:1px solid #c6dce9;

    background:#f5faff;

    padding:0 50px;

    font-size:15px;

    color:#334e68;

    outline:none;

    transition:.2s;
}


.input-box input:focus{

    border-color:#299ce4;

    box-shadow:
        0 0 0 3px rgba(41,156,228,.12);

    background:white;
}


/* =================================
   MATA PASSWORD
================================= */

.eye{

    position:absolute !important;

    left:auto !important;

    right:17px;

    color:#7893b1 !important;

    cursor:pointer;

}


/* =================================
   TOMBOL LOGIN
================================= */

button{

    width:100%;

    height:58px;

    border:none;

    border-radius:12px;

    background:
        linear-gradient(
            90deg,
            #168be4,
            #0875dc
        );

    color:white;

    font-size:18px;

    font-weight:bold;

    cursor:pointer;

    box-shadow:
        0 7px 16px rgba(20,130,220,.22);

    transition:.2s;
}


button:hover{

    transform:translateY(-2px);

    box-shadow:
        0 10px 20px rgba(20,130,220,.28);
}


/* =================================
   AIR UNTUK KEHIDUPAN
================================= */

.bottom-text{

    text-align:right;

    color:#1676cf;

    font-size:17px;

    font-weight:bold;

    font-style:italic;

    margin-top:28px;

    padding-right:8px;

    line-height:1.25;
}


/* =================================
   RESPONSIVE HP
================================= */

@media(max-width:800px){

    body{

        overflow:auto;

        padding:20px 0;
    }

    .container{

        grid-template-columns:1fr;

        min-height:auto;

        max-width:92%;
    }

    .left{

        padding:40px 20px;

        min-height:430px;
    }

    .right{

        padding:40px 30px;
    }

    .logo{

        width:125px;
        height:125px;
    }

    .left h1{

        font-size:24px;
    }

    .judul{

        font-size:19px;
    }

    .login-box h3{

        font-size:28px;
    }

}

</style>

</head>


<body>


<!-- =================================
     GELEMBUNG AIR
================================= -->

<div class="bubble bubble1"></div>
<div class="bubble bubble2"></div>
<div class="bubble bubble3"></div>
<div class="bubble bubble4"></div>
<div class="bubble bubble5"></div>
<div class="bubble bubble6"></div>
<div class="bubble bubble7"></div>
<div class="bubble bubble8"></div>
<div class="bubble bubble9"></div>


<!-- =================================
     GELOMBANG BACKGROUND
================================= -->

<div class="wave"></div>
<div class="wave2"></div>
<div class="wave3"></div>


<!-- =================================
     CONTAINER
================================= -->

<div class="container">


    <!-- =============================
         KIRI
    ============================== -->

    <div class="left">


        <img
            src="assets/logo-tirtanadi.jpg"
            class="logo"
            alt="Logo Tirtanadi"
        >


        <h1>
            PDAM TIRTANADI
        </h1>


        <h2>
            PROVINSI SUMATERA UTARA
        </h2>


        <div class="garis"></div>


        <div class="judul">

            Sistem Informasi<br>
            Pemasangan Meter

        </div>


        <!-- GELOMBANG PANEL -->

        <div class="left-wave1"></div>
        <div class="left-wave2"></div>


    </div>


    <!-- =============================
         KANAN
    ============================== -->

    <div class="right">


        <div class="login-box">


            <h3>
                Selamat Datang
            </h3>


            <p class="subjudul">

                Silakan login untuk mengakses<br>
                Sistem Informasi Pemasangan Meter.

            </p>


            <form
                action="proses_login.php"
                method="POST"
            >


                <!-- USERNAME -->

                <label>
                    Username
                </label>


                <div class="input-box">

                    <i class="bi bi-person-fill"></i>

                    <input
                        type="text"
                        name="username"
                        placeholder="Masukkan username"
                        required
                    >

                </div>


                <!-- PASSWORD -->

                <label>
                    Password
                </label>


                <div class="input-box">

                    <i class="bi bi-lock-fill"></i>

                    <input
                        type="password"
                        name="password"
                        id="password"
                        placeholder="Masukkan password"
                        required
                    >

                    <i
                        class="bi bi-eye eye"
                        id="eye"
                        onclick="lihatPassword()"
                    ></i>

                </div>


                <!-- LOGIN -->

                <button type="submit">

                    Login
                    &nbsp; →

                </button>


            </form>


            <div class="bottom-text">

                Air Untuk<br>
                Kehidupan

            </div>


        </div>


    </div>


</div>


<script>

function lihatPassword(){

    const password =
        document.getElementById("password");

    const eye =
        document.getElementById("eye");


    if(password.type === "password"){

        password.type = "text";

        eye.classList.remove("bi-eye");

        eye.classList.add("bi-eye-slash");

    }else{

        password.type = "password";

        eye.classList.remove("bi-eye-slash");

        eye.classList.add("bi-eye");

    }

}

</script>


</body>

</html>
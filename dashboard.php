<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard | Digital Signature Kriptografi</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f2f4f7;
        }

        .hero {
            background: linear-gradient(135deg, #0d6efd, #084298);
            color: white;
            padding: 30px 20px;
            border-radius: 15px;
        }

        .hero h1 {
            font-size: 1.4rem;
        }

        .profile-img {
            width: 120px;
            height: 120px;
            object-fit: cover;
            border-radius: 50%;
            border: 3px solid #0d6efd;
        }

        footer {
            font-size: 0.8rem;
        }
    </style>
</head>
<body>

<!-- NAVBAR -->
<nav class="navbar navbar-dark bg-primary shadow-sm">
    <div class="container-fluid">
        <span class="navbar-brand mb-0 h6">
            Digital Signature | Kriptografi
        </span>
    </div>
</nav>

<!-- CONTENT -->
<div class="container mt-4">

    <!-- LOGO -->
    <div class="text-center mb-3">
        <img src="assets/img/logo_upb.png" alt="Logo UPB" width="120">
    </div>

    <!-- HERO -->
    <div class="hero text-center shadow mb-4">
        <h1 class="fw-bold">DIGITAL SIGNATURE BERBASIS KRIPTOGRAFI</h1>
        <p class="mb-1">Mata Kuliah: <b>Kriptografi</b></p>
        <p class="mb-1">Universitas Pelita Bangsa</p>
        <p class="mb-0">Tahun Akademik 2025</p>
    </div>

    <!-- DOSEN -->
    <div class="card shadow-sm mb-3">
        <div class="card-body text-center">
            <img src="assets/img/dosen.jpg" class="profile-img mb-2" alt="Dosen">
            <h6 class="fw-bold mb-1">Dosen Pengampu</h6>
            <p class="mb-0">
                Hemdani Rahendra Herlianto, S.Kom, M.Kom
            </p>
        </div>
    </div>

    <!-- MAHASISWA -->
    <div class="card shadow-sm mb-4">
        <div class="card-body text-center">
            <img src="assets/img/riyadi.jpg" class="profile-img mb-2" alt="Mahasiswa">
            <h6 class="fw-bold mb-1">Mahasiswa</h6>
            <p class="mb-0">
                Riyadi<br>
                NIM: 312310262<br>
                Kelas: TI.23.C4
            </p>
        </div>
    </div>

    <!-- BUTTON -->
    <div class="d-grid gap-2 mb-4">
        <a href="index.php" class="btn btn-success btn-lg">
            ➜ Masuk ke Sistem Digital Signature
        </a>
    </div>






</div>





<!-- FOOTER -->
<footer class="bg-primary text-white text-center py-3">
    © 2025<br>
    Website Mata Kuliah Kriptografi<br>
    TI.23.C4 – Universitas Pelita Bangsa
</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

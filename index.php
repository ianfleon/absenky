<?php session_start(); ?>

<?php

require_once('api.php');

$api = new AbsenkyAPI();

$result = $api->absenToday();
// var_dump($result);

// exit;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once('components/head.php'); ?>
    <title>Absenky</title>
</head>

<body>

    <div class="container mt-4">
        <div class="d-flex">
            <?php if (isset($_SESSION['ADMIN_LOGINED'])) : ?>
                <a href="logout.php" class="btn btn-danger me-auto">Logout</a>
                <a href="dashboard.php" class="btn btn-light ms-auto">Dashboard</a>
            <?php else : ?>
                <a href="login.php" class="btn btn-primary me-auto">Login</a>
            <?php endif; ?>
        </div>
    </div>

    <div class="container mt-4">
        <div class="m-auto">
            <div class="row">
                <div class="col-lg-6">
                    <div id="reader"></div>
                </div>
                <div class="col-lg-6">
                    <div class="col-lg-12">
                        <div class="card mb-3">
                            <div class="row g-0">
                                <div class="col-lg-3">
                                    <img src="/assets/images/nophoto.jpg" id="foto_staff" class="img-fluid rounded-start photo-user" />
                                </div>
                                <div class="col-lg-9 d-flex align-items-center">
                                    <div class="card-body">
                                        <h5 id="nama_staff" class="fw-bold">-</h5>
                                        <p class="card-text" id="posisi_staff">-</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 mb-4">
                        <div class="card">
                            <div class="card-body text-center">
                                <h2 class="m-0 fw-bold" id="waktu-live">-</h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="card">
                            <table class="table m-0">
                                <tbody>
                                    <?php foreach ($result as $val) : ?>
                                    <tr>
                                        <th scope="row">
                                            <img src="/assets/icons/arrow.svg" alt="">
                                        </th>
                                        <td class="text-muted">( <?= date('H:i:s', $val['waktu_tmsp_absen']); ?> ) - <b><?= $val['nama_staff']; ?></b></td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="/assets/js/main.js"></script>

    <script>

        const waktuLive = document.getElementById('waktu-live');

        const waktuLiveInterval = setInterval(function() {
            const today = new Date();
            waktuLive.innerText = today.getHours() + " : " + today.getMinutes() + " : " + today.getSeconds();
        }, 1000);

    </script>

</body>

</html>
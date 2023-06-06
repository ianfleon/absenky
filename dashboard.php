<?php require_once('helper/view.php'); ?>

<?php

$staff = [
    [
        'id' => 12,
        'nama' => 'Yusril Ikhsa Mahulauw',
        'posisi' => 'Staff IT'
    ]
];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once('components/head.php'); ?>
    <title>Dashboard - Absenky</title>
</head>

<body>
    <div class="container mt-4">
        <div class="d-flex">
            <a href="index.php" class="btn btn-light border">Home</a>
            <a href="adduser.php" class="btn btn-light border ms-auto me-4">Tambah User</a>
        </div>
    </div>

    <div class="container">
        <div class="row mt-4">
            <div class="col-lg-8 mb-4">
                <div class="card p-4">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <td class="fw-bold">Nama</td>
                                <td class="fw-bold">Posisi</td>
                                <td class="fw-bold">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" viewBox="0 0 32 32" id="option">
                                        <g data-name="Layer 2">
                                            <circle cx="5.11" cy="16" r="3.11"></circle>
                                            <circle cx="16" cy="16" r="3.11"></circle>
                                            <circle cx="26.89" cy="16" r="3.11"></circle>
                                        </g>
                                    </svg>
                                </td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($staff as $s) : ?>
                                <?= components('list-staff', $s); ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="row mb-4">
                    <div class="col-lg-6">
                        <div class="card p-4 bg-warning fw-bold text-white">
                            24 Karyawan
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card p-4 fw-bold bg-primary text-white">
                            4 Absen
                        </div>
                    </div>
                </div>
                <div class="card p-4">
                    <div class="my-2"><span class="text-muted">08:11AM</span> - <b>Huzaimal Ollong</b></div>
                    <div class="my-2"><span class="text-muted">08:11AM</span> - <b>Nacut Soulisa</b></div>
                    <div class="my-2"><span class="text-muted">08:11AM</span> - <b>Inka Ely Mustika</b></div>
                    <div class="my-2"><span class="text-muted">08:11AM</span> - <b>Sity Tatawalat</b></div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
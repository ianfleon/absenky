<?php

session_start();

if (!isset($_SESSION['ADMIN_LOGINED'])) {
    header('Location: /login.php');
}

require_once('helper/view.php');

require_once('api.php');

$api = new AbsenkyAPI();

$absenToday = $api->absenToday();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once('components/head.php'); ?>
    <script src="assets/js/jquery.dataTables.min.js"></script>
    <script src="assets/js/dataTables.buttons.min.js"></script>
    <script src="assets/js/jszip.min.js"></script>
    <script src="assets/js/buttons.html5.min.js"></script>
    <script src="assets/js/buttons.print.min.js"></script>
    <title>Dashboard - Absenky</title>
</head>

<body>

    <!-- Modal -->
    <div class="modal fade" id="modalqr" tabindex="-1" aria-labelledby="modalqr" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="label_modal">QRCode - Nama Pegawai</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img src="" id="img_qr" width="100%" alt="">
                </div>
                <div class="modal-footer">
                    <a href="#" download id="btn_download_qr" class="btn btn-primary">Download</a>
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-4">
        <div class="d-flex">
            <a href="index.php" class="btn btn-light border me-4">Home</a>
            <a href="laporan-absen.php" class="btn btn-light border">Laporan Absen</a>
            <div class="ms-auto">
                <a href="#" id="btn_ganti_pw" class="btn btn-outline-danger border ms-auto">Ganti Password</a>
                <a href="form-staff.php" class="btn btn-light border ms-auto">Tambah User</a>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row mt-4">
            <div class="col-lg-12 mb-4">
                <div class="card p-4">
                    <table class="table table-hover" id="table-absen">
                        <thead>
                            <tr>
                                <td class="fw-bold">ID</td>
                                <td class="fw-bold">Nama</td>
                                <td class="fw-bold">Posisi</td>
                                <td class="fw-bold">Tanggal</td>
                                <td class="fw-bold">Waktu</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($absenToday as $absen) : ?>
                            <tr>
                                <td><?= $absen['id_staff']; ?></td>
                                <td><?= $absen['nama_staff']; ?></td>
                                <td><?= $absen['posisi_staff']; ?></td>
                                <td><?= date('d-m-Y', $absen['waktu_tmsp_absen']); ?></td>
                                <td><?= date('H:i:s', $absen['waktu_tmsp_absen']); ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            
        </div>
    </div>

    <script src="/assets/bs5/js/bootstrap.bundle.min.js"></script>

    <script>
        // new DataTable('#table-absen');
        $(document).ready(function() {
            $('#table-absen').DataTable( {
                dom: 'Bfrtip',
                buttons: [
                'excel', 'print'
            ]
        } );
} );
    </script>
 
</body>

</html>
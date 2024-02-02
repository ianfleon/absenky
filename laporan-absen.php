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
    <div class="modal fade" id="modal-absen" tabindex="-1" aria-labelledby="modal-absen" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="label_modal">Keterangan Absen</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img src="" id="img-bukti" width="100%" alt="">
                </div>
                <div class="modal-footer" id="ket-absen">
                    Lagi ada acara
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
                            <?php foreach ($absenToday as $absen) : ?>
                            <tr>
                                <td><?= $absen['id_staff']; ?></td>
                                <td><?= $absen['nama_staff']; ?></td>
                                <td><?= $absen['posisi_staff']; ?></td>
                                <td><?= date('d-m-Y', $absen['waktu_tmsp_absen']); ?></td>
                                <td><?= date('H:i:s', $absen['waktu_tmsp_absen']); ?></td>
                                <td>
                                    <?php if ($absen['status_absen'] < 1): ?>
                                        <a href="#" class="text-decoration-none" onclick="izinReport('<?= $absen['bukti_absen']; ?>', '<?= $absen['keterangan_absen']; ?>')" data-bs-toggle="modal" data-bs-target="#modal-absen">
                                        <svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd"><path d="M4.348 21.241l4.185-7.249 5.67 9.806c-.714.133-1.45.202-2.203.202-2.907 0-5.575-1.036-7.652-2.759zm18.97-5.247c-1.182 3.345-3.806 6.012-7.124 7.252l-4.187-7.252h11.311zm-14.786-6l-5.656 9.797c-1.793-2.097-2.876-4.819-2.876-7.791 0-.684.057-1.354.167-2.006h8.365zm12.583-5.795c1.798 2.098 2.885 4.824 2.885 7.801 0 .679-.057 1.345-.165 1.994h-8.373l5.653-9.795zm-11.305-3.999c.71-.131 1.442-.2 2.19-.2 2.903 0 5.566 1.033 7.642 2.751l-4.18 7.24-5.652-9.791zm2.19 7.794h-11.314c1.186-3.344 3.812-6.008 7.132-7.244l4.182 7.244z"/></svg>
                                    </a>
                                    <?php endif; ?>

                                </td>
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
            });

        });

            function izinReport(bukti, ket) {
                console.log("Report Absen");
                $("#img-bukti").attr('src', '/public/absen/' + bukti);
                $("#ket-absen").html(ket);
            }  

        


    </script>
 
</body>

</html>
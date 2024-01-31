<?php

session_start();

if (!isset($_SESSION['ADMIN_LOGINED'])) {
    header('Location: /login.php');
}

?>

<?php require_once('helper/view.php'); ?>

<?php

$db = new SQLite3('absenky.db');

$staff = [];

$result = $db->query("SELECT * FROM staffs_tb");
while ($row = $result->fetchArray()) {
    $staff[] = $row;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once('components/head.php'); ?>
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
            <a href="index.php" class="btn btn-light border">Home</a>
            <div class="ms-auto">
                <a href="#" id="btn_ganti_pw" class="btn btn-outline-danger border ms-auto">Ganti Password</a>
                <a href="form-staff.php" class="btn btn-light border ms-auto">Tambah User</a>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row mt-4">
            <div class="col-lg-8 mb-4">
                <div class="card p-4">
                    <table class="table table-hover" id="table_staff">
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
                        <div class="card p-4 bg-success fw-bold text-white">
                            <?= count($staff); ?> Staff
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

    <script src="/assets/bs5/js/bootstrap.bundle.min.js"></script>
    <script>
        $(function() {

            $("#table_staff").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false
            });

        });
    </script>

    <script>
        function showQR(id, nama) {
            $("#label_modal").html('QRCode: ' + nama);
            $("#img_qr").attr('src', '/public/qr/' + id + '.png');
            $("#btn_download_qr").attr('download', nama + ' - QRCode.png');
            $("#btn_download_qr").attr('href', '/public/qr/' + id + '.png');
        }
    </script>

    <script>
        $(function() {

            function gantiPassword(pw) {

                $.ajax({
                    method: 'POST',
                    url: 'api.php?ep=gantipw',
                    data: {
                        pw: pw
                    },
                    success: function(res) {

                        res = JSON.parse(res);

                        console.log(res);

                        let txtAlert, iconAlert;

                        if (res.status == 200) {
                            txtAlert = 'BERHASIL';
                            iconAlert = 'success';
                        } else {
                            txtAlert = 'ERROR';
                            iconAlert = 'error';
                        }

                        swal({
                            title: res.message,
                            text: txtAlert,
                            icon: iconAlert,
                            button: "OK",
                        });

                    }
                });
            }

            $("#btn_ganti_pw").click(function() {
                swal("Masukan Password Baru:", {
                    content: "input",
                    buttons: {
                        cancel: "Batal",
                        submit: true
                    }
                }).then((value) => {
                    switch (value) {
                        case 'submit':
                            gantiPassword($('.swal-content__input').val());
                            break;
                        default:
                            break;
                    }
                });
            });

        });
    </script>

    <script>
        function deleteStaff(id, nama, el) {
            swal("Ingin hapus data: " + nama, {
                    buttons: {
                        cancel: "Kembali",
                        yes: true,
                    },
                })
                .then((value) => {
                    switch (value) {
                        case "yes":
                            execDeleteStaff(id, el.parentElement.parentElement);
                            break;
                        default:
                            break;
                    }
                });
        }

        function execDeleteStaff(id, el) {

            $.ajax({
                method: 'POST',
                url: 'api.php?ep=delete_staff',
                data: {
                    id_staff: id
                },
                success: function(res) {

                    res = JSON.parse(res);

                    console.log(res);

                    let txtAlert, iconAlert;

                    if (res.status == 200) {
                        txtAlert = 'BERHASIL';
                        iconAlert = 'success';
                    } else {
                        txtAlert = 'ERROR';
                        iconAlert = 'error';
                    }

                    swal({
                        text: txtAlert,
                        icon: iconAlert,
                        button: "OK",
                    });

                    el.remove();

                }
            });
        }
    </script>

</body>

</html>
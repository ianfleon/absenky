<?php

session_start();

if (!isset($_SESSION['ADMIN_LOGINED'])) {
    header('Location: /login.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once('components/head.php'); ?>
    <title>Tambah User - Absenky</title>
</head>

<body>

    <div class="container mt-4">
        <div class="d-flex">
            <a href="dashboard.php" class="btn btn-light border">Back</a>
        </div>
    </div>

    <div class="container">
        <div class="col-lg-6 m-auto">

            <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                </symbol>
                <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z" />
                </symbol>
                <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                </symbol>
            </svg>

            <div class="card p-4">
                <form action="" id="form_izin">

                    <!-- Dummy ID Staff -->
                    <input type="hidden" value="<?= $_GET['id']; ?>" name="idx_staff" id="idx_staff" />

                    <div class="d-flex align-align-items-center">
                        <button class="btn btn-primary ms-auto" id="btn_submit">Submit</button>
                    </div>

                    <div class="mb-3">
                        <label for="keterangan_absen" class="form-label">Keterangan</label>
                        <input type="text" class="form-control" id="keterangan_absen" name="keterangan_absen">
                    </div>

                    <div class="mb-3">
                        <label for="bukti_absen" class="form-label">Bukti (Wajib)</label>
                        <input class="form-control" name="bukti_absen" type="file" id="bukti_absen">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        const BtnAdd = $('#btn_submit').click(function(btn) {

            btn.preventDefault();

            const formDataIzin = new FormData(document.getElementById('form_izin'));

            $.ajax({
                method: 'POST',
                url: 'api.php?ep=izin',
                cache: false,
                processData: false,
                contentType: false,
                data: formDataIzin,
                success: function(res) {

                    $('#form_izin').trigger('reset');

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
                        title: "Absen Izin",
                        text: txtAlert,
                        icon: iconAlert,
                        button: "OK",
                    });
                }
            });



        });
    </script>

</body>

</html>
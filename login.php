<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once('components/head.php'); ?>
    <title>Login - Absenky</title>
</head>

<body>

    <div class="container mt-4">
        <div class="d-flex">
            <a href="index.php" class="btn btn-light border">Back</a>
        </div>
    </div>

    <div class="container">
        <div class="d-flex my-4">
            <div class="col-lg-4 m-auto">
                <div class="card p-4">
                    <form>
                        <div class="input-group">
                            <input type="password" class="form-control" name="pw" id="pw" placeholder="Password">
                            <button class="btn btn-outline-secondary" type="button" id="btn_login">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(function() {
            $('#btn_login').click(function() {
                $.ajax({
                    url: 'api.php?ep=login',
                    method: 'POST',
                    data: {
                        pw: $('#pw').val()
                    },
                    success: function(res) {

                        let txtAlert, iconAlert;
                        res = JSON.parse(res);

                        switch (res.status) {
                            case 200:
                                txtAlert = 'BERHASIL';
                                iconAlert = 'success';
                                setTimeout(() => {
                                    location.replace('/dashboard.php');
                                }, 2000);
                                break;
                            case 500:
                                txtAlert = 'EROR';
                                iconAlert = 'error';
                            default:
                                break;
                        }

                        swal({
                            title: 'Status Login',
                            text: txtAlert,
                            icon: iconAlert,
                            button: "OK",
                        });
                    }
                });
            });
        });
    </script>

</body>

</html>
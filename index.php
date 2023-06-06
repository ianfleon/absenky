<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once('components/head.php'); ?>
    <title>Absenky</title>
</head>

<body>

    <div class="container mt-4">
        <div class="d-flex">
            <a href="login.php" class="btn btn-primary">Login</a>
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
                                    <img src="/public/photos/1.jpg" class="img-fluid rounded-start photo-user" />
                                </div>
                                <div class="col-lg-9 d-flex align-items-center">
                                    <div class="card-body">
                                        <h5>Yusril Ikhsa Mahulauw</h5>
                                        <p class="card-text">Staff IT</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 mb-4">
                        <div class="card">
                            <div class="card-body text-center">
                                <h2 class="m-0 fw-bold">08 : 12 PM</h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="card">
                            <table class="table m-0">
                                <tbody>
                                    <tr>
                                        <th scope="row">
                                            <img src="/assets/icons/arrow.svg" alt="">
                                        </th>
                                        <td>Huzaimal Ollong</td>
                                        <td class="text-muted">12-03-2023 | 08:12AM</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">
                                            <img src="/assets/icons/arrow.svg" alt="">
                                        </th>
                                        <td>Siti Tatawalat</td>
                                        <td class="text-muted">12-03-2023 | 08:12AM</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">
                                            <img src="/assets/icons/arrow.svg" alt="">
                                        </th>
                                        <td>Gerardus Kormomolin</td>
                                        <td class="text-muted">12-03-2023 | 08:12AM</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php require_once('components/scriptjs.php'); ?>
</body>

</html>
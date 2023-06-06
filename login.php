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
                    <form action="dashboard.php">
                        <!-- <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Password</label>
                            <input type="password" class="form-control" id="exampleInputPassword1">
                        </div>
                        <button type="submit" class="btn btn-primary">Login</button> -->
                        <div class="input-group">
                            <input type="password" class="form-control" placeholder="Password">
                            <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php require_once('components/scriptjs.php'); ?>
</body>

</html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
    <script defer src="/assets/js/bootstrap.bundle.min.js"></script>
    <title>My Profile</title>
    <link rel="stylesheet" href="/assets/css/styles.css">
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
</head>
<body class="d-flex justify-content-center align-items-center">
    <div class="parallax"></div>
    <main class="container container-uh-huh">
        <div class="row g-4 justify-content-center align-items-start my-lg-5 py-lg-5 my-2 py-2">
            <div class="d-flex justify-content-center align-items-center col-lg-3 col-12">
                <img src="<?= "/" . $image ?>" class="img shadow">
            </div>
            <div class="d-flex col-lg-9 col-12">
                <div class="flex-fill card shadow c-b">
                    <div class="card-body">
                        <h5 class="card-title">
                            <?= $name ?>
                        </h5>
                        <h6 class="card-subtitle mb-2 text-nord-muted">
                            <?= $email . " | @" . $uname ?>
                        </h6>
                        <p class="text-nord my-0 p-0">
                            <strong>NIM</strong>
                        </p>
                        <p class="mt-0 p-0">
                            <?= $nim ?>
                        </p>
                        <p class="text-nord my-0 p-0">
                            <strong>FAKULTAS</strong>
                        </p>
                        <p class="mt-0 p-0">
                            <?= $faculty ?>
                        </p>
                        <p class="text-nord my-0 p-0">
                            <strong>PRODI</strong>
                        </p>
                        <p class="mt-0 p-0">
                            <?= $major ?>
                        </p>
                        <p class="text-nord my-0 p-0">
                            <strong>DESKRIPSI</strong>
                        </p>
                        <p class="mt-0 p-0 mb-0">
                            <?= $description ?>
                        </p>
                    </div>
                    <div class="container-fluid px-0 py-0">
                        <a href="/edit" class="btn btn-light bg-nord-accent float-start m-4 mt-0">Edit Profil</a>
                        <a href="/logout" class="btn btn-light bg-nord-accent-red float-end m-4 mt-0">Logout</a>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>
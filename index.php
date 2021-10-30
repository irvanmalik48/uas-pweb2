<?php

session_start();

if (!isset($_SESSION['user'])) {
    header('Location: /pages/login');
    exit;
}

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
    <script defer src="./assets/js/bootstrap.bundle.min.js"></script>
    <title>My Profile</title>
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body class="parallax vh-100 d-flex justify-content-center align-items-center">
    <main class="container container-uh-huh">
        <div class="row g-4">
            <div class="d-flex justify-content-center align-items-center col-lg-3 col-12">
                <img src="<?= $_SESSION['user']['image'] ?>" class="img shadow">
            </div>
            <div class="d-flex col-lg-9 col-12">
                <div class="flex-fill card shadow c-b">
                    <div class="card-body">
                        <h5 class="card-title">
                            <?= $_SESSION['user']['name'] ?>
                        </h5>
                        <h6 class="card-subtitle mb-2 text-nord-muted">
                            <?= $_SESSION['user']['email'] . " | @" . $_SESSION['user']['uname'] ?>
                        </h6>
                        <p>
                            NIM: <?= $_SESSION['user']['nim'] ?>
                        </p>
                        <p>
                            Fakultas: <?= $_SESSION['user']['faculty'] ?>
                        </p>
                        <p>
                            Prodi: <?= $_SESSION['user']['major'] ?>
                        </p>
                        <p>
                            <?= $_SESSION['user']['description'] ?>
                        </p>
                    </div>
                    <div class="row p-3 pt-0 gx-2">
                        <div class="col-auto">
                            <a href="/pages/edit" class="btn btn-light bg-nord-accent">Edit Profil</a>
                        </div>
                        <div class="col-auto">
                            <a href="/pages/logout" class="btn btn-light bg-nord-accent">Logout</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>
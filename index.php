<?php

session_start();

if (!isset($_SESSION['loggedin'])) {
    header('Location: /pages/login/');
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
    <style>
        body {
            background-color: #434b5f;
            color: #FFFFFF;
        }
        
        .parallax {
            overflow: hidden;
            position: relative;
        }
        
        .parallax::before {
            content: "";
            position: fixed;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            background: url("./assets/img/bg.svg") no-repeat center center;
            background-size: cover;
            will-change: transform;
            z-index: -1;
        }
        
        .img {
            width: 200px;
            height: 200px;
            border-radius: 50%;
        }

        .container-uh-huh {
            max-width: 900px;
        }

        .c-b {
            background-color: #3B425255;
            backdrop-filter: blur(12px);
            border: 3px #88C0CF solid;
            border-radius: 13px;
        }

        .bg-nord-accent {
            background-color: #88C0CF;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            color: #3B4252;
        }

        .bg-nord-accent:hover {
            background-color: #434b5f;
            color: #88C0CF;
        }

        .bg-nord-accent:active {
            background-color: #3B4252;
            color: #88C0CF;
        }

        .text-nord-muted {
            color: #88C0CFAA;
        }
    </style>
</head>
<body class="parallax vh-100 d-flex justify-content-center align-items-center">
    <main class="container container-uh-huh">
        <div class="row g-4">
            <div class="d-flex justify-content-center align-items-center col-lg-3 col-12">
                <img src="assets/img/default.jpg" class="img shadow">
            </div>
            <div class="d-flex col-lg-9 col-12">
                <div class="flex-fill card shadow c-b">
                    <div class="card-body">
                        <h5 class="card-title">
                            <?= $data['name'] ?>
                        </h5>
                        <h6 class="card-subtitle mb-2 text-nord-muted">
                            <?= $data['motto'] ?>
                        </h6>
                        <p>
                            <?= $data['uni'] . " | " . $data['major'] ?>
                        </p>
                        <p>
                            <?= $data['desc'] ?>
                        </p>
                    </div>
                    <div class="row p-3 pt-0 gx-2">
                        <div class="col-auto">
                            <a href="/pages/edit/" class="btn btn-light bg-nord-accent">Edit Profil</a>
                        </div>
                        <div class="col-auto">
                            <a href="/" class="btn btn-light bg-nord-accent">Logout</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>
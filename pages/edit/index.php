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
    <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../assets/css/styles.css">
    <script defer src="../../assets/js/bootstrap.bundle.min.js"></script>
    <title>Edit Profile</title>
</head>
<body>
    <div class="parallax"></div>
    <div class="container container-uh-huh pt-5 pb-5">
        <div class="card c-b mt-5 shadow">
            <div class="card-body">
                <h5 class="card-title text-center">
                    Edit Profile
                </h5>
                <form class="mb-5 pb-3" action="../../lib/edit/index.php" method="post" enctype="multipart/form-data">
                    <div class="mb-3 mt-4">
                        <label for="image" class="form-label h6">Atur Foto Profil</label>
                        <input type="text" id="fallbackimg" name="fallbackimg" value="<?= $_SESSION['user']['image'] ?>" hidden/>
                        <input type="text" id="uname" name="uname" value="<?= $_SESSION['user']['uname'] ?>" hidden/>
                        <input class="form-control" type="file" accept="image/*" id="image" name="image" aria-describedby="imageSection"/>
                        <div class="form-text" id="imageSection">Foto profil anda.</div>
                        <button type="submit" name="editImage" class="btn btn-light bg-nord-accent float-end">Save Image</button>
                    </div>
                </form>
                <form action="../../lib/edit/index.php" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="name" class="form-label h6">Nama</label>
                        <input type="text" class="form-control" id="name" name="name" aria-describedby="nameSection" value="<?= $_SESSION['user']['name'] ?>" required/>
                        <div class="form-text" id="nameSection">Isilah dengan nama asli anda.</div>
                    </div>
                    <div class="mb-3">
                        <label for="nim" class="form-label h6">NIM</label>
                        <input type="text" class="form-control" id="nim" name="nim" aria-describedby="nimSection" value="<?= $_SESSION['user']['nim'] ?>"/>
                        <div class="form-text" id="nimSection">Isilah dengan NIM anda.</div>
                    </div>
                    <div class="mb-3">
                        <label for="faculty" class="form-label h6">Fakultas</label>
                        <input type="text" class="form-control" id="faculty" name="faculty" aria-describedby="facultySection" value="<?= $_SESSION['user']['faculty'] ?>"/>
                        <div class="form-text" id="facultySection">Fakultas anda sekarang.</div>
                    </div>
                    <div class="mb-3">
                        <label for="major" class="form-label h6">Prodi</label>
                        <input type="text" class="form-control" id="major" name="major" aria-describedby="majorSection" value="<?= $_SESSION['user']['major'] ?>"/>
                        <div class="form-text" id="majorSection">Prodi yang anda jalani.</div>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label h6">Deskripsi</label>
                        <input type="text" class="form-control" id="description" name="description" aria-describedby="descriptionSection" value="<?= $_SESSION['user']['description'] ?>"/>
                        <div class="form-text" id="descriptionSection">Deskripsikan mengenai diri anda.</div>
                    </div>
                    <input type="text" id="img" name="img" value="<?= $_SESSION['user']['image'] ?>" hidden/>
                    <input type="text" id="uname" name="uname" value="<?= $_SESSION['user']['uname'] ?>" hidden/>
                    <div class="container-fluid p-0">
                        <button type="submit" name="edit" class="btn btn-light bg-nord-accent float-end">Save</button>
                    </div>
                </form>
                <a href="/" class="btn btn-light bg-nord-accent float-start">Cancel</a>
            </div>
        </div>
    </div>
</body>
</html>
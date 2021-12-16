<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../assets/css/styles.css">
    <script defer src="../../assets/js/bootstrap.bundle.min.js"></script>
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
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
                <form action="/edit/image" method="post" enctype="multipart/form-data">
                    <div class="mb-3 mt-4">
                        <input type="text" name="<?= csrf_token() ?>" id="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" hidden/>
                        <label for="imagefile" class="form-label text-white h6">Atur Foto Profil</label>
                        <input class="form-control" type="file" accept="image/*" id="imagefile" name="imagefile" aria-describedby="imageSection"/>
                        <div class="form-text" id="imageSection">Foto profil anda.</div>
                        <?php if (session()->has("image_error")) { ?>
                        <p class="text-center bg-nord-accent-red-nohover text-white px-1 py-2">
                            <?= session()->get("image_error") ?>
                        </p>
                        <?php session()->remove("image_error");} ?>
                        <button type="submit" name="editImage" class="btn btn-light bg-nord-accent float-end">Save Image</button>
                    </div>
                </form>
                <form class="pt-5" action="/edit/user" method="post" enctype="multipart/form-data">
                    <input type="text" name="id" id="id" value="<?= $id ?>" hidden/>
                    <?php if (session()->has("uname_error")) { ?>
                    <div class="margin-btm bg-nord-accent-red-nohover text-white px-1 py-2">
                        <ul>
                    <?php foreach (
                        session()->get("uname_error")
                        as $key => $val
                    ) { ?>
                        <li><?= $val ?></li>
                    <?php } ?>
                        </ul>
                    </div>
                    <?php session()->remove("uname_error");} ?>
                    <input type="text" name="<?= csrf_token() ?>" id="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" hidden/>
                    <input type="text" name="id" id="id" value="<?= session()->get(
                        "user_id"
                    ) ?>" hidden/>
                    <div class="mb-3">
                        <label for="username" class="form-label text-white h6">Username</label>
                        <input type="text" class="form-control" id="uname" name="uname" aria-describedby="usernameSection" value="<?= $uname ?>" />
                        <div class="form-text" id="usernameSection">Isilah dengan username anda.</div>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label text-white h6">Email</label>
                        <input type="text" class="form-control" id="email" name="email" aria-describedby="emailSection" value="<?= $email ?>" />
                        <div class="form-text" id="emailSection">Isilah dengan username anda.</div>
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label text-white h6">Nama</label>
                        <input type="text" class="form-control" id="name" name="name" aria-describedby="nameSection" value="<?= $name ?>" />
                        <div class="form-text" id="nameSection">Isilah dengan nama asli anda.</div>
                    </div>
                    <div class="mb-3">
                        <label for="nim" class="form-label text-white h6">NIM</label>
                        <input type="text" class="form-control" id="nim" name="nim" aria-describedby="nimSection" value="<?= $nim ?>" />
                        <div class="form-text" id="nimSection">Isilah dengan NIM anda.</div>
                    </div>
                    <div class="mb-3">
                        <label for="faculty" class="form-label text-white h6">Fakultas</label>
                        <input type="text" class="form-control" id="faculty" name="faculty" aria-describedby="facultySection" value="<?= $faculty ?>" />
                        <div class="form-text" id="facultySection">Fakultas anda sekarang.</div>
                    </div>
                    <div class="mb-3">
                        <label for="major" class="form-label text-white h6">Prodi</label>
                        <input type="text" class="form-control" id="major" name="major" aria-describedby="majorSection" value="<?= $major ?>" />
                        <div class="form-text" id="majorSection">Prodi yang anda jalani.</div>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label text-white h6">Deskripsi</label>
                        <input type="text" class="form-control" id="description" name="description" aria-describedby="descriptionSection" value="<?= $description ?>" />
                        <div class="form-text" id="descriptionSection">Deskripsikan mengenai diri anda.</div>
                    </div>
                    <div class="container-fluid p-0">
                        <button type="submit" name="edit" class="btn btn-light bg-nord-accent float-end">Save</button>
                    </div>
                </form>
                <form class="pt-5" action="/edit/pass" method="post" enctype="multipart/form-data">
                    <input type="text" name="<?= csrf_token() ?>" id="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" hidden/>
                    <div class="mb-3">
                        <label for="pass" class="form-label text-white h6">Password</label>
                        <input type="password" class="form-control" id="pass" name="pass" aria-describedby="passSection" />
                        <div class="form-text" id="passSection">Isilah dengan password baru anda.</div>
                    </div>
                    <div class="mb-3">
                        <label for="confpass" class="form-label text-white h6">Confirm Password</label>
                        <input type="password" class="form-control" id="confpass" name="confpass" aria-describedby="confpassSection" />
                        <div class="form-text" id="confpassSection">Konfirmasikan password baru anda.</div>
                    </div>
                    <?php if (session()->has("pass_error")) { ?>
                    <div class="margin-btm bg-nord-accent-red-nohover text-white px-1 py-2">
                        <ul>
                    <?php foreach (
                        session()->get("pass_error")
                        as $key => $val
                    ) { ?>
                        <li><?= $val ?></li>
                    <?php } ?>
                        </ul>
                    </div>
                    <?php session()->remove("pass_error");} ?>
                    <div class="container-fluid p-0">
                        <button type="submit" name="editPassword" class="btn btn-light bg-nord-accent float-end">Save</button>
                    </div>
                    <a href="/" class="btn btn-light bg-nord-accent-red float-start">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
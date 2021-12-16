<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/styles.css">
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <script defer src="/assets/js/bootstrap.bundle.min.js"></script>
    <title>Register</title>
</head>
<body>
    <div class="parallax"></div>
    <div class="container container-lr pt-5 pb-5">
        <div class="py-5"></div>
        <div class="card c-b mt-5 shadow">
            <div class="card-body">
                <h5 class="card-title text-center">
                    Register
                </h5>
                <form action="/register/save" method="post" enctype="multipart/form-data">
                    <input type="text" name="<?= csrf_token() ?>" id="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" hidden/>
                    <div class="mb-3">
                        <label for="name" class="form-label text-white h6">Nama Lengkap</label>
                        <input type="text" class="form-control" id="name" name="name" aria-describedby="nameSection" />
                        <div class="form-text" id="nameSection">Isilah dengan nama lengkap anda.</div>
                    </div>
                    <div class="mb-3">
                        <label for="uname" class="form-label text-white h6">Username</label>
                        <input type="text" class="form-control" id="uname" name="uname" aria-describedby="unameSection" />
                        <div class="form-text" id="unameSection">Isilah dengan username anda.</div>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label text-white h6">Email</label>
                        <input type="text" class="form-control" id="email" name="email" aria-describedby="emailSection" />
                        <div class="form-text" id="emailSection">Isilah dengan email anda.</div>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label text-white h6">Password</label>
                        <input type="password" class="form-control" id="password" name="password" aria-describedby="passwordSection" />
                        <div class="form-text" id="passwordSection">Isilah dengan password pilihan anda.</div>
                    </div>
                    <?php if (session()->has("msg")) { ?>
                    <div class="margin-btm bg-nord-accent-red-nohover text-white px-1 py-2">
                        <ul>
                    <?php foreach (session()->get("msg") as $key => $val) { ?>
                        <li><?= $val ?></li>
                    <?php } ?>
                        </ul>
                    </div>
                    <?php session()->remove("msg");} ?>
                    <div class="container-fluid p-0">
                        <button type="submit" name="register" class="btn btn-light bg-nord-accent float-end">Register</button>
                    </div>
                    <a href="../login/" class="btn btn-light bg-nord-accent float-start">Sudah punya akun?</a>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
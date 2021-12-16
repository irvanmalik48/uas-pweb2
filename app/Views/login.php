<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/styles.css">
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <script defer src="/assets/js/bootstrap.bundle.min.js"></script>
    <title>Login</title>
</head>
<body>
    <div class="parallax"></div>
    <div class="container container-lr pt-5 pb-5">
        <div class="py-5"></div>
        <div class="card c-b mt-5 shadow">
            <div class="card-body">
                <h5 class="card-title text-center">
                    Login
                </h5>
                <form action="/login/auth" method="post" enctype="multipart/form-data">
                    <input type="text" name="<?= csrf_token() ?>" id="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" hidden/>
                    <div class="mb-3">
                        <label for="uname" class="form-label text-white h6">Username/Email</label>
                        <input type="text" class="form-control" id="uname" name="uname" aria-describedby="unameSection" />
                        <div class="form-text" id="unameSection">Isilah dengan username atau email anda.</div>
                    </div>
                    <div class="mb-3">
                        <label for="pass" class="form-label text-white h6">Password</label>
                        <input type="password" class="form-control" id="pass" name="pass" aria-describedby="passSection" />
                        <div class="form-text" id="passSection">Isilah dengan password anda.</div>
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
                        <button type="submit" name="login" class="btn btn-light bg-nord-accent float-end">Login</button>
                    </div>
                    <a href="/register" class="btn btn-light bg-nord-accent float-start">Belum punya akun?</a>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
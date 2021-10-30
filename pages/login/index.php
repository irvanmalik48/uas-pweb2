<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../assets/css/styles.css">
    <script defer src="../../assets/js/bootstrap.bundle.min.js"></script>
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
                <form action="../../lib/auth/index.php" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="uname" class="form-label h6">Username/Email</label>
                        <input type="text" class="form-control" id="uname" name="uname" aria-describedby="unameSection" required/>
                        <div class="form-text" id="unameSection">Isilah dengan username atau email anda.</div>
                    </div>
                    <div class="mb-3">
                        <label for="pass" class="form-label h6">Password</label>
                        <input type="password" class="form-control" id="pass" name="pass" aria-describedby="passSection" required/>
                        <div class="form-text" id="passSection">Isilah dengan password anda.</div>
                    </div>
                    <div class="container-fluid p-0">
                        <button type="submit" name="login" class="btn btn-light bg-nord-accent float-end">Login</button>
                    </div>
                    <a href="/pages/register" class="btn btn-light bg-nord-accent float-start">Belum punya akun?</a>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
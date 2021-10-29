<?php
include "../../lib/db/index.php";




?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
    <script defer src="../../assets/js/bootstrap.bundle.min.js"></script>
    <title>Edit Profile</title>
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
            background: url("../../assets/img/bg.svg") no-repeat center center;
            background-size: cover;
            will-change: transform;
            z-index: -1;
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
        
        .form-text {
            color: #88C0CF;
        }
    </style>
</head>
<body>
    <div class="parallax"></div>
    <div class="container container-uh-huh pt-5 pb-5">
        <div class="card c-b mt-5 shadow">
            <div class="card-body">
                <h5 class="card-title text-center">
                    Edit Profile
                </h5>
                <form action="../../lib/edit.php" method="post" enctype="multipart/form-data">
                    <div class="mb-3 mt-4">
                        <label for="file" class="form-label h6">Upload image</label>
                        <input class="form-control" type="file" accept="image/*" id="file" name="file" aria-describedby="fileSection"/>
                        <div class="form-text" id="fileSection">This will be your profile image.</div>
                        <button type="submit" name="image" class="btn btn-light bg-nord-accent mb-3" value="success-image">Save Image</button>
                    </div>
                </form>
                <form action="../../lib/edit.php" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="name" class="form-label h6">Name</label>
                        <input type="text" class="form-control" id="name" name="name" aria-describedby="nameSection" value="" required/>
                        <div class="form-text" id="nameSection">This will be your name.</div>
                    </div>
                    <div class="mb-3">
                        <label for="nim" class="form-label h6">NIM</label>
                        <input type="text" class="form-control" id="nim" name="nim" aria-describedby="nimSection" value="" required/>
                        <div class="form-text" id="nimSection">This will be your current NIM.</div>
                    </div>
                    <div class="mb-3">
                        <label for="faculty" class="form-label h6">Faculty</label>
                        <input type="text" class="form-control" id="faculty" name="faculty" aria-describedby="facultySection" value="" required/>
                        <div class="form-text" id="facultySection">This will be your current faculty.</div>
                    </div>
                    <div class="mb-3">
                        <label for="major" class="form-label h6">Major</label>
                        <input type="text" class="form-control" id="major" name="major" aria-describedby="majorSection" value="" required/>
                        <div class="form-text" id="majorSection">This will be your current major.</div>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label h6">Description</label>
                        <input type="text" class="form-control" id="description" name="description" aria-describedby="descriptionSection" value="" required/>
                        <div class="form-text" id="descriptionSection">This will be your description.</div>
                    </div>
                    <input type="text" id="profimg" name="profimg" value="" hidden/>
                    <div class="container-fluid p-0">
                        <button type="submit" name="submit" class="btn btn-light bg-nord-accent float-end" value="success">Save</button>
                    </div>
                </form>
                <a href="/" class="btn btn-light bg-nord-accent float-start">Cancel</a>
            </div>
        </div>
    </div>
</body>
</html>
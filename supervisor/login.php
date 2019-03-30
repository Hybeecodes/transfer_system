<?php
/**
 * Created by PhpStorm.
 * User: Megacodes
 * Date: 11/15/2018
 * Time: 11:16 AM
 */?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Automated Staff Transfer System - login </title>
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <!-- CSS Files -->
    <link href="../assets/css/material-dashboard.css?v=2.1.1" rel="stylesheet" />
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="../assets/demo/demo.css" rel="stylesheet" />
</head>
<body>
    <div class="container" style="width: 50%; margin: auto; padding-top: 10%;">
        <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title">Supervisor Login</h4>
                <p class="card-category">Please fill the form to login</p>
            </div>
            <div class="card-body">
                <form id="loginForm">
                    <div class="alert">

                    </div>
                    <div class="form-group">
                        <label class="bmd-label-floating">Email Address</label>
                        <input type="email" name="email" id="email" class="form-control">
                    </div>

                    <div class="form-group">
                        <label class="bmd-label-floating">Password</label>
                        <input type="password" name="password" id="password" class="form-control">
                    </div>
                    <div class="form-group">
                        <button type="submit" id="submit" class="btn btn-primary">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="../assets/js/core/jquery.min.js"></script>
    <script src="../assets/js/core/popper.min.js"></script>
    <script src="../assets/js/core/bootstrap-material-design.min.js"></script>
    <script src="../assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
    <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="../assets/js/material-dashboard.js?v=2.1.1" type="text/javascript"></script>
    <!-- Material Dashboard DEMO methods, don't include it in your project! -->
    <script src="../assets/demo/demo.js"></script>

    <script>
        function validateInput(){
            let email = $('#email').val();
            let password = $('#password').val();
            if(email === '' || password === ''){
                $('.alert').addClass('alert-danger').removeClass('alert-success').text("Please Fill In All Fields !!");
                return false;
            }
            return true;
        }
        $('#loginForm').submit(function(e){
            e.preventDefault();
            if(!validateInput())
                return false;
            let form = new FormData(this);
            form.append('supervisor_login','');
            $('#submit').text('Please wait...').attr('disabled',true);
            $.ajax({
                type: 'POST',
                url: 'parser.php',
                data: form,
                cache:false,
                processData: false,
                contentType: false,
                success: function (res) {
                    console.log(res);
                    res = JSON.parse(res);
                    let status = res['status'];
                    let message = res['message'];
                    if(status == 1){
                        $('.alert').addClass('alert-success').removeClass('alert-danger').text(message);
                        setTimeout(()=>{
                            window.location = 'index.php';
                        },2000);
                    }else{
                        $('.alert').addClass('alert-danger').removeClass('alert-success').text(message);
                        $('#submit').text('Login').attr('disabled',false);
                    }
                },
                error: function (xhr) {
                    alert(xhr.statusText);
                }
            })
        })
    </script>
</body>
</html>


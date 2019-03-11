<?php
/**
 * Created by PhpStorm.
 * User: hybeecodes
 * Date: 2/17/19
 * Time: 1:59 PM
 */

include '../app/init.php';
include '../middleware/ensureLoggedIn.php';
$admin = new Admin($db_conn);
$settings = $admin->get_settings();
//exit(var_dump($settings));
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../assets/img/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>
        Automated Staff Transfer System - Settings
    </title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <!-- CSS Files -->
    <link href="../assets/css/material-dashboard.css?v=2.1.1" rel="stylesheet" />
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="../assets/demo/demo.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.css"/>
</head>

<body class="">
<div class="wrapper ">
    <?php include 'includes/sidebar.php' ?>
    <div class="main-panel">
        <!-- Navbar -->
        <?php include 'includes/header.php' ?>
        <!-- End Navbar -->
        <div class="content">
            <div class="container-fluid">
                <div class="row" style="width: 60%; margin: auto;">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header card-header-primary">
                                <h4 class="card-title ">Transfer Settings</h4>
                                <p class="card-category"></p>
                            </div>
                            <div class="card-body">
                                <form action="" id="settingsForm">
                                    <div class="form-group">
                                        <input type="number" name="interval" value="<?= @$settings['transfer_interval']
                                        ?>"
                                               placeholder="TransferInterval"
                                               class="form-control" min="0" id="interval">
                                    </div>
                                    <input type="hidden" name="update_settings" value="1">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary" id="update_settings">Update
                                            Settings</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--      Footer-->
        <?php include 'includes/footer.php' ?>
        <!--        End Footer-->
    </div>
</div>

<?php include 'includes/scripts.php' ?>
<script>
    $('#settingsForm').submit(function (e) {
        e.preventDefault();
        const data = new FormData(this);

        $.ajax({
            type: 'POST',
            url:'parser.php',
            data,
            cache: false,
            contentType: false,
            processData: false,
            success: function(data) {
                data = JSON.parse(data);
                if(data['status']){
                    swal("Great!",data['message'],'success').then(()=>{
                        location.reload(true);
                    })
                }else{
                    swal("Huh!",data['message'],'error');
                }
            },
            error: function(xhr){
                console.log(xhr);
            }
        })
    })
</script>

</body>

</html>

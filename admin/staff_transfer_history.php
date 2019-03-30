<?php
/**
 * Created by PhpStorm.
 * User: Megacodes
 * Date: 3/20/2019
 * Time: 2:49 PM
 */

include '../app/init.php';
include '../middleware/ensureLoggedIn.php';
$admin = new Admin($db_conn);
if(!isset($_GET['staff'])){
    header('location: transfer_history.php');
}
$staff_id = base64_decode(@$_GET['staff']);
$staff_history = $admin->get_staff_transfer_history($staff_id);
//var_dump($staff);
//exit;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../assets/img/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>
        Automated Staff Transfer System
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
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header card-header-primary">
                                <h4 class="card-title ">Transfer Records Of <?= @$staff_name ?></h4>
                                <p class="card-category"> This is a list of all staff </p>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table" id="staff">
                                        <thead class=" text-primary">
                                        <tr>
                                            <th>
                                                S/N
                                            </th>
                                            <th>
                                                Name
                                            </th>
                                            <th>
                                                Faculty
                                            </th>
                                            <th>
                                                Location
                                            </th>
                                            <th>
                                                Transfer Date
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        if(!empty($staff_history) && count($staff_history) > 0){
                                            foreach ($staff_history as $record){
                                                ?>
                                                <tr>
                                                    <td>
                                                        <?= @$record['name'] ?>
                                                    </td>
                                                    <td>
                                                        <?= @$record['faculty'] ?>
                                                    </td>
                                                    <td>
                                                        <?= @$record['location'] ?>
                                                    </td>
                                                    <td>
                                                        <?= @$record['created_at'] ?>
                                                    </td>
                                                </tr>
                                            <?php   }
                                        } ?>
                                        </tbody>
                                    </table>
                                </div>
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
    $('#staff').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ]
    });
</script>

</body>

</html>


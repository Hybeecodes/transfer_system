<?php
/**
 * Created by PhpStorm.
 * User: Megacodes
 * Date: 11/15/2018
 * Time: 3:06 PM
 */
include '../app/init.php';
include '../middleware/ensureLoggedIn.php';
$admin = new Admin($db_conn);
$staff = $admin->get_staff_to_be_transfererd();
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
                                <h4 class="card-title ">All Transferable Staff</h4>
                                <p class="card-category"> This is a list of staff due for transfer </p>
                            </div>
                            <div class="card-body">
                                <button class="btn btn-primary" id="init_transfer">Initiate Transfer Process</button>
                                <div class="table-responsive">
                                    <table class="table" id="staff">
                                        <thead class=" text-primary">
                                        <th>
                                            ID
                                        </th>
                                        <th>
                                            Firstname
                                        </th>
                                        <th>
                                            Lastname
                                        </th>
                                        <th>
                                            Gender
                                        </th>
                                        <th>
                                            Current Location
                                        </th>
                                        <th>
                                            Last Transfer Date
                                        </th>
                                        </thead>
                                        <tbody>
                                        <?php
                                        if(!empty($staff) && count($staff) > 0){
                                            foreach ($staff as $st){
                                                ?>
                                                <tr>
                                                    <td>
                                                        1
                                                    </td>
                                                    <td>
                                                        <?php if(isset($st['firstname'])) echo $st['firstname'] ?>
                                                    </td>
                                                    <td>
                                                        <?php if(isset($st['lastname'])) echo $st['lastname'] ?>
                                                    </td>
                                                    <td class="text-primary">
                                                        <?php if(isset($st['gender'])) echo $st['gender'] ?>
                                                    </td>
                                                    <td>
                                                        <?php if(isset($st['location_id'])) echo $admin->get_location_name($st['location_id']) ?>
                                                    </td>
                                                    <td class="text-primary">
                                                        <?php if(isset($st['last_transfer_date'])) echo date('D,d M, Y',strtotime($st['last_transfer_date'])) ?>
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
    $('#init_transfer').click(function () {
        $.ajax({
            type:'GET',
            url: 'parser.php?transfer_all=1',
            cache:false,
            contentType: false,
            processData: false,
            success: function (res) {
                const data = JSON.parse(res);
                if(data['status']){
                    swal("Great!",data['message'],'success').then(()=>{
                        location.reload(true);
                    })
                }else{
                    swal("Huh!",data['message'],'error');
                }
            },
            error:function (xhr) {
                console.log(xhr);
            }
        })
    })
</script>

</body>

</html>

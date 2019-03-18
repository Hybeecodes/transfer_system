<?php
/**
 * Created by PhpStorm.
 * User: hybeecodes
 * Date: 12/16/18
 * Time: 8:05 PM
 */
include '../app/init.php';
include '../middleware/ensureLoggedIn.php';
$admin = new Admin($db_conn);
$positions = $admin->get_all_positions();
//var_dump($positions);
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
        Automated Staff Transfer System | Positions
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
                                <h4 class="card-title ">All Positions</h4>
                                <p class="card-category"> This is all available positions </p>
                            </div>
                            <div class="card-body">
                                <h3>Add New Position</h3>
                                <form action="" id="newPosition" class="row">
                                    <div class="form-gorup col-8">
                                        <input type="text" name="name" placeholder="Position Name" class="form-control">
                                    </div>
                                    <input type="hidden" name="new_pos" value="1">
                                    <div class="col-3">
                                        <button type="submit" class="btn btn-primary">Add Position</button>
                                    </div>

                                </form>
                                <div class="table-responsive">
                                    <table class="table" id="staff">
                                        <thead class=" text-primary">
                                        <th>
                                            S/N
                                        </th>
                                        <th>
                                            Name
                                        </th>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $count = 0;
                                        if(!empty($positions) && count($positions) > 0){
                                            foreach ($positions as $position){
                                                ?>
                                                <tr>
                                                    <td>
                                                        <?= ++$count; ?>
                                                    </td>
                                                    <td>
                                                        <?php if(isset($position['name'])) echo $position['name'] ?>
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
    $('table').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ]
    });

    $('#newPosition').submit(function (e) {
        e.preventDefault();
        let form = new FormData(this);
        $.ajax({
            type: 'POST',
            url: 'parser.php',
            data: form,
            cache: false,
            contentType: false,
            processData: false,
            success: function(data){
                console.log(data);
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

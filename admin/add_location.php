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
// get all faculties
$faculties = $admin->get_faculties();
$positions = $admin->get_all_positions();
// var_dump($faculties);
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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css"/>
    <!-- CSS Files -->
    <link href="../assets/css/material-dashboard.css?v=2.1.1" rel="stylesheet" />
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="../assets/demo/demo.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.css"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />

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
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title ">Add New Location</h4>
                        <p class="card-category"> Please Fill in the Form to add New Location </p>
                    </div>
                    <div class="card-body">
                        <form id="locationForm">
                            <div class="alert">

                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">Name</label>
                                        <input type="text" class="form-control" name="name" id="name">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">Faculty</label>
                                        <select name="faculty_id" class="form-control" id="faculty">
                                        <?php 
                                            if(!empty($faculties) && count($faculties) > 0){
                                                foreach ($faculties as $faculty) { ?>
                                                    <option value="<?php if(isset($faculty['faculty_id'])) echo $faculty['faculty_id'] ?>"><?php if(isset($faculty['name'])) echo $faculty['name'] ?></option>
                                            <?php    }
                                            }
                                        ?>
                                            
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">Available Positions</label>
                                        <select name="positions[]" class="form-control" multiple id="positions">
                                            <option value=""></option>
                                            <?php
                                            if(!empty($positions) && count($positions) > 0){
                                                foreach ($positions as $position) { ?>
                                                    <option value="<?php if(isset($position['position_id'])) echo $position['position_id'] ?>"><?php if(isset($position['name'])) echo $position['name'] ?></option>
                                                <?php    }
                                            }
                                            ?>

                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary" id="submit" >Add Location</button>
                            </div>
                        </form>
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
    $('#positions').select2({
        placeholder:"Select Available Positions"
    });
    function validateInput(){
        let email = $('#name').val();
        if(email === ''){
            $('.alert').addClass('alert-danger').removeClass('alert-success').text("Please Fill In All Fields !!");
            return false;
        }
        return true;
    }


    $('#locationForm').submit(function(e){
        e.preventDefault();
        let form = new FormData(this);
        form.append('add_location',"");
        $('#submit').text('Please wait...').attr('disabled',true);
        $.ajax({
            type: 'POST',
            url: 'parser.php',
            data: form,
            cache: false,
            contentType: false,
            processData: false,
            success: function (res) {
                console.log(res);
                res = JSON.parse(res);
                let status = res['status'];
                let message = res['message'];
                if(status == 1){
                    $('.alert').addClass('alert-success').removeClass('alert-danger').text(message);
                    setTimeout(()=>{
                        window.location = "locations.php";
                    },2000);
                }else{
                    $('.alert').addClass('alert-danger').removeClass('alert-success').text(message);
                    $('#submit').text('Add Location').attr('disabled',false);
                }
            },
            error:function (xhr) {
                alert(xhr.statusText);
            }
        })

    })

</script>

</body>

</html>


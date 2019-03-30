<?php
/**
 * Created by PhpStorm.
 * User: Megacodes
 * Date: 3/20/2019
 * Time: 2:34 PM
 */

include '../app/init.php';
include '../middleware/ensureLoggedIn.php';
$admin = new Admin($db_conn);
// get all faculties
$staff = $admin->get_all_staff();
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
                        <h4 class="card-title ">Transfer History</h4>
                    </div>
                    <div class="card-body">
                        <form action="staff_transfer_history.php">

                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">Select Staff</label>
                                        <select name="staff" id="staff" class="form-control">
                                            <option value=""></option>
                                            <?php
                                                if (!empty($staff)):
                                                    foreach ($staff as $staff):
                                            ?>
                                                        <option value="<?= base64_encode(@$staff['staff_id']) ?>"><?= @$staff['firstname'] ?> <?= @$staff['lastname'] ?></option>
                                            <?php
                                                    endforeach;
                                                endif;
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary" id="submit" >View Staff Transfer Records</button>
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
    $('#staff').select2({
        placeholder:"Select A Staff"
    });
    function validateInput(){
        let email = $('#name').val();
        if(email === ''){
            $('.alert').addClass('alert-danger').removeClass('alert-success').text("Please Fill In All Fields !!");
            return false;
        }
        return true;
    }
    $('#location').select2({
        placeholder: "Select Location"
    });
    $('#faculty').select2({
        placeholder: "Select Faculty"
    });

    $('#faculty').change(function () {
        $('.new_locs').remove();
        let faculty = $(this).val();
        console.log(faculty);
        // fetch locations in faculty
        $.get(`parser.php?get_fac_locs=1&fac_id=${faculty}`,function (res) {
            console.log(res);
            data= JSON.parse(res);
            data.forEach((d)=>{
                $('#location').append(`<option class="new_locs" value="${d.location_id}">${d.name}</option>`);
            });
        });
    });

    $('#supervisorForm').submit(function(e){
        e.preventDefault();
        let form = new FormData(this);
        form.append('add_supervisor',"");
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
                // data = JSON.parse(data);
                if(status){
                    swal("Great!",message,'success').then(()=>{
                        location.reload(true);
                    })
                }else{
                    swal("Huh!",message,'error').then(function(){
                        $('#submit').text('Add Supervisor').attr('disabled',false);
                    })
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


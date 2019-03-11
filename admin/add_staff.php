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

$locations = $admin->get_all_locations();
$faculties = $admin->get_faculties();
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
                        <h4 class="card-title ">Add New Staff</h4>
                        <p class="card-category"> Please Fill in the Form to add New Staff </p>
                    </div>
                    <div class="card-body">
                        <form id="staffForm">
                            <div class="alert">

                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label class="bmd-label-">Firstname</label>
                                        <input type="text" class="form-control" name="firstname" id="firstname">
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="form-group">
                                        <label class="bmd-label-">Lastname</label>
                                        <input type="text" class="form-control" name="lastname" id="lastname">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label class="bmd-label-">Email</label>
                                        <input type="email" class="form-control" name="email" id="email">
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="form-group">
                                        <label class="bmd-label-">Phone</label>
                                        <input type="tel" class="form-control" name="phone" id="phone">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label class="bmd-label-">Year Of Employment</label>
                                        <input type="number" class="form-control"  min="1900" max="2099" step="1" name="employment_year" id="employment_year">
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="form-group">
                                        <label class="bmd-label-">Date Of Birth</label>
                                        <input type="date" class="form-control" name="dob" id="dob">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label class="bmd-label-">Qualification</label>
                                        <input type="text" class="form-control" name="qualification" id="qualification">
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="form-group">
                                        <label class="bmd-label-">Last Transfer Date</label>
                                        <input type="date" class="form-control" name="transfer_date" id="transfer_date">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label class="bmd-label-">Gender</label>
                                        <select name="gender" id="gender" class="form-control">
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="form-group">
                                        <label class="bmd-label-">Faculty</label>
                                        <select name="faculty" id="faculty" class="form-control">
                                            <option value=""></option>
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
                                        <label class="bmd-label-">Location</label>
                                        <select name="location" id="location" class="form-control">
                                            <option value=""></option>

                                        </select>
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="form-group">
                                        <label class="bmd-label-">Position</label>
                                        <select name="position" id="position" class="form-control">
                                            <option value=""></option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary" id="submit" >Add Staff</button>
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
    $('#staff').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ]
    });
    $('#location').select2({
        placeholder: "Select Location"
    });
    $('#faculty').select2({
        placeholder: "Select Faculty"
    });
    $('#position').select2({
        placeholder: "Select Position"
    });

    function validateInput(){
        let email = $('#email').val();
        let password = $('#password').val();
        if(email === '' || password === ''){
            $('.alert').addClass('alert-danger').removeClass('alert-success').text("Please Fill In All Fields !!");
            return false;
        }
        return true;
    }

    $('#faculty').change(function () {
        $('.new_locs').remove();
        let faculty = $(this).val();
        // console.log(faculty);
        // fetch locations in faculty
        $.get(`parser.php?get_fac_locs=1&fac_id=${faculty}`,function (res) {
            // console.log(res);
            data= JSON.parse(res);
            data.forEach((d)=>{
                $('#location').append(`<option class="new_locs" value="${d.location_id}">${d.name}</option>`);
            });
        });
    });

    $('#location').change(function () {
        $('.new_pos').remove();
        let location = $(this).val();
        // console.log(faculty);
        // fetch locations in faculty
        $.get(`parser.php?get_loc_pos=1&loc_id=${location}`,function (res) {
            // console.log(res);
            data= JSON.parse(res);
            data.forEach((d)=>{
                $('#position').append(`<option class="new_pos" value="${d.position_id}">${d.name}</option>`);
            });
        });
    });

    $('#staffForm').submit(function(e){
        e.preventDefault();
        let form = new FormData(this);
        form.append('add_staff',"");
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
                        window.location = "all_staff.php";
                    },2000);
                }else{
                    $('.alert').addClass('alert-danger').removeClass('alert-success').text(message);
                    $('#submit').text('Add Staff').attr('disabled',false);
                }
            },
            error:function (xhr) {
                alert(xhr.statusText);
            }
        });

    });

</script>

</body>

</html>


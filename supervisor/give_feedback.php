<?php
/**
 * Created by PhpStorm.
 * User: Megacodes
 * Date: 11/15/2018
 * Time: 3:06 PM
 */
include '../app/init.php';
include 'middleware/ensureLoggedIn.php';
$supervisor = new Supervisor($db_conn);
$supervisor_location = $_SESSION['supervisor_location'];
$supervisor_id = $_SESSION['supervisor_id'];
$staff = $supervisor->get_my_staff($supervisor_location);
// get all faculties
// exit(var_dump($staff));
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
                        <h4 class="card-title ">Give Feedback</h4>
                        <p class="card-category"> Give Feedback About A Staff </p>
                    </div>
                    <div class="card-body">
                        <form action="" class="feedbackForm">
                            <div class="form-group">
                                <label for="title" class="bmd-label-floating">Feedback Title</label>
                                <input type="text" name="title" class="form-control" id="title">
                            </div>
                            <div class="form-group">
                                <label for="title" class="bmd-label-floating">Concerned Staff</label>
                                <select name="staff" class="form-control" id="staff">
                                    <option value="">Select Staff</option>
                                    <?php
                                        if(!empty($staff)):
                                            foreach ($staff as $st):
                                    ?>
                                                <option value="<?= @$st['staff_id'] ?>"><?= @$st['firstname'] ?> <?= @$st['lastname'] ?></option>
                                    <?php
                                            endforeach;
                                        endif;
                                    ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="detail" class="bmd-label-floating">Feddback Detail</label>
                                <textarea name="detail" id="detail" cols="30" class="form-control" rows="10"></textarea>
                            </div>

                            <div class="form-group">
                                <button type="submit" id="submit" class="btn btn-outline-primary">Submit</button>
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
        placeholder:"Select Concerned Staff"
    });
    function validateInput(){
        let email = $('#name').val();
        if(email === ''){
            $('.alert').addClass('alert-danger').removeClass('alert-success').text("Please Fill In All Fields !!");
            return false;
        }
        return true;
    }


    $('.feedbackForm').submit(function(e){
        e.preventDefault();
        let form = new FormData(this);
        form.append('give_feedback',"");
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
                        $('#submit').text('Submit').attr('disabled',false);
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


<?php
include '../app/init.php';
include 'middleware/ensureLoggedIn.php';
/**
 * Created by PhpStorm.
 * User: Megacodes
 * Date: 11/15/2018
 * Time: 12:36 PM
 */
$admin = new Admin($db_conn);
$feedbacks = $admin->get_feeedbacks();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../assets/img/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>
        Automated Staff Transfer System | Admin
    </title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <!-- CSS Files -->
    <link href="../assets/css/material-dashboard.css?v=2.1.1" rel="stylesheet" />
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="../assets/demo/demo.css" rel="stylesheet" />
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
                    <div class="col-lg-36 col-md-6 col-sm-6">
                        <div class="card card-stats">
                            <div class="card-header card-header-warning card-header-icon">
                                <div class="card-icon">
                                    <i class="material-icons">content_copy</i>
                                </div>
                                <p class="card-category">Total Staff</p>
                                <h3 class="card-title">100
                                    <small></small>
                                </h3>
                            </div>
                            <div class="card-footer">
                                <div class="stats">
                                    <i class="material-icons text-danger">warning</i>
                                    <a href="#pablo"></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="card card-stats">
                            <div class="card-header card-header-success card-header-icon">
                                <div class="card-icon">
                                    <i class="material-icons">store</i>
                                </div>
                                <p class="card-category">Staff Due For Transfer</p>
                                <h3 class="card-title">20</h3>
                            </div>
                            <div class="card-footer">
                                <div class="stats">
                                    <i class="material-icons">date_range</i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="card">
                            <div class="card-header card-header-primary">
                                <h4 class="card-title">Feedback</h4>
                                <p class="card-category">Recent Feedback From Supervisors</p>
                            </div>
                            <div class="card-body table-responsive">
                                <table class="table table-hover">
                                    <thead class="text-primary">
                                    <th>S/N</th>
                                    <th>Supervisor</th>
                                    <th>Location</th>
                                    <th>Title</th>
                                    <th>Action</th>
                                    </thead>

                                    <?php
                                        if(!empty($feedbacks)): ?>
                                    <tbody>
                                    <?php
                                            $count = 0;
                                            foreach ($feedbacks as $feedback):
                                    ?>
                                    <tr>
                                        <td><?= @++$count ?></td>
                                        <td><?= $feedback['supervisor_name'] ?></td>
                                        <td><?= $admin->get_location_name($feedback['location_id']) ?></td>
                                        <td><?= $feedback['title'] ?></td>
                                        <td>
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal<?= $feedback['feedback_id'] ?>">View Details</button>
                                        </td>
                                       
                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModal<?= $feedback['feedback_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel<?= $feedback['feedback_id'] ?>" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Feedback From <?= $admin->get_location_name($feedback['location_id']) ?></h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <p>
                                                    <b>Supervisor:</b> <?= $feedback['supervisor_name'] ?>
                                                </p>

                                                <p>
                                                    <b>Concerned Staff:</b> <?= $admin->get_staff_name($feedback['staff_id']) ?>
                                                </p>

                                                <p>
                                                    <b>Title:</b> <?= $feedback['title'] ?>
                                                </p>

                                                <p>
                                                    <b>Body:</b> <?= $feedback['details'] ?>
                                                </p>

                                                <p>
                                                    <b>Date Sent:</b> <?= $feedback['created_at'] ?>
                                                </p>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            </div>
                                            </div>
                                        </div>
                                        </div>
                                    </tr>
                                    <?php
                                            endforeach;
                                            else:
                                            echo "<p>No Recent Request Yet</p>";
                                        endif;
                                    ?>
                                    </tbody>
                                </table>
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
</body>

</html>

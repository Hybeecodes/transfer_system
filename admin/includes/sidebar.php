<?php
/**
 * Created by PhpStorm.
 * User: Megacodes
 * Date: 11/15/2018
 * Time: 12:09 PM
 */

$page_url = $_SERVER['PHP_SELF'];
$pageArr = explode('/',$page_url);
$page = $pageArr[count($pageArr)-1];
//var_dump($pageArr);
//exit($page);
?>
<div class="sidebar" data-color="purple" data-background-color="white" data-image="../assets/img/sidebar-1.jpg">
    <!--
      Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

      Tip 2: you can also add an image using data-image tag
  -->
    <div class="logo">
        <a href="/admin" class="simple-text logo-normal">
            Administrator
        </a>
    </div>
    <div class="sidebar-wrapper">
        <ul class="nav">
            <li class="nav-item <?php if($page == 'index.php') echo 'active'; ?>  ">
                <a class="nav-link" href="index.php">
                    <i class="material-icons">dashboard</i>
                    <p>Dashboard</p>
                </a>
            </li>
            <li class="nav-item ">
                <a class="nav-link <?php if($page == 'levels.php') echo 'active'; ?>" href="levels.php">
                    <i class="material-icons">content_paste</i>
                    <p>Levels</p>
                </a>
            </li>
            <li class="nav-item ">
                <a class="nav-link <?php if($page == 'positions.php') echo 'active'; ?>" href="positions.php">
                    <i class="material-icons">content_paste</i>
                    <p>Positions</p>
                </a>
            </li>
           <li class="nav-item ">
               <a class="nav-link <?php if($page == 'faculties.php') echo 'active'; ?>" href="faculties.php">
                   <i class="material-icons">content_paste</i>
                   <p>Faculties</p>
               </a>
            </li>

            <li class="nav-item ">
               <a class="nav-link <?php if($page == 'locations.php') echo 'active'; ?>" href="locations.php">
                   <i class="material-icons">content_paste</i>
                   <p>Locations</p>
               </a>
            </li>

            <li class="nav-item ">
               <a class="nav-link <?php if($page == 'add_location.php') echo 'active'; ?>" href="add_location.php">
                   <i class="material-icons">content_paste</i>
                   <p>Add Location</p>
               </a>
            </li>
            <li class="nav-item <?php if($page == 'add_staff.php') echo 'active'; ?> ">
                <a class="nav-link" href="add_staff.php">
                    <i class="material-icons">content_paste</i>
                    <p>Add Staff</p>
                </a>
            </li>
            <li class="nav-item <?php if($page == 'all_staff.php') echo 'active'; ?> ">
                <a class="nav-link" href="all_staff.php">
                    <i class="material-icons">content_paste</i>
                    <p>All Staff</p>
                </a>
            </li>

            <li class="nav-item ">
                <a class="nav-link" href="transfer_history.php">
                    <i class="material-icons">library_books</i>
                    <p>Transfer History</p>
                </a>
            </li>
            <li class="nav-item <?php if($page == 'transferable_staff.php') echo 'active'; ?> ">
                <a class="nav-link" href="transferable_staff.php">
                    <i class="material-icons">library_books</i>
                    <p>Transferable Staff</p>
                </a>
            </li>

            <li class="nav-item <?php if($page == 'recent_transfers.php') echo 'active'; ?> ">
                <a class="nav-link" href="supervisors.php">
                    <i class="material-icons">library_books</i>
                    <p>Supervisors</p>
                </a>
            </li>

            <li class="nav-item ">
                <a class="nav-link" href="change_password.php">
                    <i class="material-icons">library_books</i>
                    <p>Change Password</p>
                </a>
            </li>

<!--            <li class="nav-item ">-->
<!--                <a class="nav-link" href="change_password.php">-->
<!--                    <i class="material-icons">library_books</i>-->
<!--                    <p>Change Password</p>-->
<!--                </a>-->
<!--            </li>-->

        </ul>
    </div>
</div>

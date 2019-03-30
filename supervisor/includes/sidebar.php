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
        <a href="http://www.creative-tim.com" class="simple-text logo-normal">
            Transfer System
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

            <li class="nav-item <?php if($page == 'staff.php') echo 'active'; ?> ">
                <a class="nav-link" href="staffs.php">
                    <i class="material-icons">content_paste</i>
                    <p>Staffs</p>
                </a>
            </li>

            <li class="nav-item <?php if($page == 'all_staff.php') echo 'active'; ?> ">
                <a class="nav-link" href="give_feedback.php">
                    <i class="material-icons">content_paste</i>
                    <p>Give Feedback</p>
                </a>
            </li>

        </ul>
    </div>
</div>

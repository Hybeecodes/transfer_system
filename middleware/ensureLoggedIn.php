<?php
/**
 * Created by PhpStorm.
 * User: Megacodes
 * Date: 11/15/2018
 * Time: 4:14 PM
 */
if(!isset($_SESSION['admin_session'])){
    header('location: ../login.php');
}
?>
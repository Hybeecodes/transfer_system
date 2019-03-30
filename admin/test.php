<?php
/**
 * Created by PhpStorm.
 * User: hybeecodes
 * Date: 12/28/18
 * Time: 7:24 AM
 */
include '../app/init.php';

$admin = new Admin($db_conn);

//$locs = $admin->get_faculty_locations('faculty_id5bfa97d25b16c');
$new_transfer = $admin->transfer_staff('staffs5c92a4e1813cc');
var_dump($new_transfer);